<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.0.3/dist/tailwind.min.css" rel="stylesheet">
    <style>
        body, html {
            height: 100%;
            margin: 0;
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
        }

        .login-container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100%;
            padding: 20px;
        }

        .login-form {
            background-color: #fff;
            padding: 40px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
        }

        .login-form h2 {
            text-align: center;
            margin-bottom: 20px;
            font-size: 24px;
            color: #333;
        }

        .input-label {
            font-size: 14px;
            color: #333;
            margin-bottom: 6px;
        }

        .input-field {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 14px;
            color: #333;
        }

        .input-field:focus {
            border-color: #3490dc;
            outline: none;
        }

        .form-action {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .remember-me {
            font-size: 14px;
        }

        .forgot-password {
            font-size: 14px;
            color: #3490dc;
            text-decoration: none;
        }

        .forgot-password:hover {
            text-decoration: underline;
        }

        .login-btn {
            background-color: #3490dc;
            color: white;
            padding: 12px 20px;
            border-radius: 5px;
            border: none;
            width: 100%;
            cursor: pointer;
            font-size: 16px;
        }

        .login-btn:hover {
            background-color: #2779bd;
        }
    </style>
</head>
<body>

<div class="login-container">
    <div class="login-form">
        <h2>Admin Login</h2>

        <!-- Session Status (if any) -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <form method="POST" action="{{ route('admin.store') }}">
            @csrf

            <!-- Email Address -->
            <div>
                <label for="email" class="input-label">{{ __('Email') }}</label>
                <x-text-input id="email" class="input-field" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <label for="password" class="input-label">{{ __('Password') }}</label>
                <x-text-input id="password" class="input-field" type="password" name="password" required autocomplete="current-password" />
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <!-- Remember Me -->
            <div class="block mt-4">
                <label for="remember_me" class="inline-flex items-center remember-me">
                    <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                    <span class="ms-2">{{ __('Remember me') }}</span>
                </label>
            </div>

            <div class="form-action mt-4">
                @if (Route::has('password.request'))
                    <a class="forgot-password" href="{{ route('password.request') }}">{{ __('Forgot your password?') }}</a>
                @endif

                <x-primary-button class="login-btn">
                    {{ __('Log in') }}
                </x-primary-button>
            </div>
        </form>
    </div>
</div>

</body>
</html>
