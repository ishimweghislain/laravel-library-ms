<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - XYZ TSS</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .login-container {
            background: white;
            padding: 2rem;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0,0,0,0.1);
            width: 100%;
            max-width: 400px;
        }

        .school-name {
            text-align: center;
            color: #2c3e50;
            margin-bottom: 2rem;
            font-size: 1.5rem;
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        label {
            display: block;
            margin-bottom: 0.5rem;
            color: #2c3e50;
        }

        input {
            width: 100%;
            padding: 0.75rem;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 1rem;
        }

        input:focus {
            outline: none;
            border-color: #3498db;
        }

        .btn-login {
            width: 100%;
            padding: 0.75rem;
            background: #3498db;
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 1rem;
            cursor: pointer;
            transition: background 0.3s ease;
        }

        .btn-login:hover {
            background: #2980b9;
        }

        .error {
            color: #e74c3c;
            font-size: 0.875rem;
            margin-top: 0.5rem;
        }

        .alert-error {
            background-color: #ffebee;
            color: #e74c3c;
            padding: 0.75rem;
            border-radius: 5px;
            margin-bottom: 1.5rem;
            border-left: 4px solid #e74c3c;
        }

        .register-link {
            text-align: center;
            margin-top: 1rem;
            color: #3498db;
            text-decoration: none;
        }

        .register-link:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <h1 class="school-name">XYZ TSS</h1>
        
        @if ($errors->any())
            <div class="alert-error">
                @if ($errors->has('login_error'))
                    {{ $errors->first('login_error') }}
                @else
                    Please check the form and try again.
                @endif
            </div>
        @endif
        
        <form method="POST" action="{{ route('login.submit') }}">
            @csrf
            <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" value="{{ old('username') }}" required>
                @error('username')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
                @error('password')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>
            
            <button type="submit" class="btn-login" style="margin-top:20px">Login</button>
            <a href="{{ route('register') }}" class="register-link">Don't have an account? Register here</a>
        </form>
    </div>
</body>
</html>