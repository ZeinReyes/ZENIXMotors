<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card p-4">
                    <h3 class="card-title text-center">Forgot Your Password?</h3>

                    <!-- Session Status -->
                    @if (session('status'))
                        <div class="alert alert-info mb-4">{{ session('status') }}</div>
                    @endif

                    <div class="mb-4 text-sm text-gray-600">
                        {{ __('No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
                    </div>

                    <form method="POST" action="{{ route('password.email') }}" class="d-flex justify-content-center align-items-center flex-column">
                        @csrf

                        <!-- Email Address -->
                        <div class="mb-3 w-100">
                            <label for="email" class="form-label">Email</label>
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autofocus>
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="w-100 d-flex justify-content-center">
                            <button type="submit" class="btn btn-dark w-75">Email Password Reset Link</button>
                        </div>
                    </form>

                    <div class="mt-3 text-center">
                        <p>Remembered your password? <a href="{{ route('login') }}" class="text-decoration-none">Login</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
