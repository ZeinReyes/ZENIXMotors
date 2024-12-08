<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use Aws\CognitoIdentityProvider\CognitoIdentityProviderClient;
use Aws\CognitoIdentityProvider\Exception\CognitoIdentityProviderException;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        // Validate request
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:255', 'unique:users'], // Added username
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        // Extract username
        $username = $request->username;

        // Initialize Cognito client
        $cognito = new CognitoIdentityProviderClient([
            'region' => env('AWS_COGNITO_REGION'),
            'version' => 'latest',
            'credentials' => [
                'key' => env('AWS_ACCESS_KEY_ID'),
                'secret' => env('AWS_SECRET_ACCESS_KEY'),
            ],
        ]);

        // Calculate the SECRET_HASH
        $secretHash = $this->generateSecretHash($username);

        try {
            // Register the user in Cognito
            $response = $cognito->signUp([
                'ClientId' => env('AWS_COGNITO_APP_CLIENT_ID'),
                'Username' => $username, // Use the unique username
                'Password' => $request->password,
                'UserAttributes' => [
                    ['Name' => 'name', 'Value' => $request->name],
                    ['Name' => 'email', 'Value' => $request->email], // Include email as an attribute
                ],
                'SecretHash' => $secretHash,
            ]);

            // Create the user in the local database
            $user = User::create([
                'name' => $request->name,
                'username' => $username,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'cognito_sub' => $response['UserSub'], // Store Cognito's UserSub
            ]);

            // Fire Registered event
            event(new Registered($user));

            // Log in the user
            Auth::login($user);

            return redirect('/');
        } catch (CognitoIdentityProviderException $e) {
            // Log the error and return back with an error message
            \Log::error('Cognito SignUp Error: ' . $e->getAwsErrorMessage());
            return back()->withErrors(['email' => 'Unable to register. ' . $e->getAwsErrorMessage()]);
        }
    }

    /**
     * Generate the SECRET_HASH for Cognito sign-up request.
     */
    private function generateSecretHash(string $username): string
    {
        $clientSecret = env('AWS_COGNITO_APP_CLIENT_SECRET');
        $clientId = env('AWS_COGNITO_APP_CLIENT_ID');
        
        return base64_encode(hash_hmac('sha256', $username . $clientId, $clientSecret, true));
    }
}
