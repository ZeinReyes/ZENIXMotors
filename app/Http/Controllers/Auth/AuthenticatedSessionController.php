<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Aws\CognitoIdentityProvider\CognitoIdentityProviderClient;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        // Initialize Cognito client
        $cognito = new CognitoIdentityProviderClient([
            'region' => env('AWS_COGNITO_REGION'),
            'version' => 'latest',
            'credentials' => [
                'key' => env('AWS_ACCESS_KEY_ID'),
                'secret' => env('AWS_SECRET_ACCESS_KEY'),
            ],
        ]);

        try {
            // Authenticate user in Cognito
            $response = $cognito->adminInitiateAuth([
                'UserPoolId' => env('AWS_COGNITO_USER_POOL_ID'),
                'ClientId' => env('AWS_COGNITO_APP_CLIENT_ID'),
                'AuthFlow' => 'ADMIN_NO_SRP_AUTH',
                'AuthParameters' => [
                    'USERNAME' => $request->email,
                    'PASSWORD' => $request->password,
                ],
            ]);

            // Extract tokens from the response (if needed later)
            $accessToken = $response['AuthenticationResult']['AccessToken'] ?? null;
            $idToken = $response['AuthenticationResult']['IdToken'] ?? null;

            // Check if the user exists locally
            $user = Auth::getProvider()->retrieveByCredentials([
                'email' => $request->email,
            ]);

            if (!$user) {
                return back()->withErrors(['email' => 'User not found in our records.']);
            }

            // Log the user in locally
            Auth::login($user);

            $request->session()->regenerate();

            // Custom redirection logic
            if ($user->email === 'admin@admin.com') {
                return redirect('/admin/dashboard');
            }

            return redirect('/');
        } catch (\Exception $e) {
            return back()->withErrors(['email' => 'Invalid credentials or user does not exist.']);
        }
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        // Initialize Cognito client
        $cognito = new CognitoIdentityProviderClient([
            'region' => env('AWS_COGNITO_REGION'),
            'version' => 'latest',
            'credentials' => [
                'key' => env('AWS_ACCESS_KEY_ID'),
                'secret' => env('AWS_SECRET_ACCESS_KEY'),
            ],
        ]);

        try {
            // Log out from Cognito
            $cognito->globalSignOut([
                'AccessToken' => $request->user()->cognito_access_token,
            ]);
        } catch (\Exception $e) {
            // Log or handle logout failure (optional)
        }

        // Log out from Laravel
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
