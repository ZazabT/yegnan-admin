<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin Login</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f4f4f4;
            margin: 0;
        }

        .login-container {
            background-color: #fff;
            padding: 2rem;
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
        }

        h2 {
            text-align: center;
            margin-bottom: 1.5rem;
            font-weight: 600;
        }

        .form-group {
            margin-bottom: 1.2rem;
        }

        .form-group label {
            font-weight: 500;
            font-size: 0.9rem;
            color: #333;
        }

        .form-group input {
            width: 100%;
            padding: 10px;
            font-size: 0.9rem;
            border: 1px solid #ccc;
            border-radius: 5px;
            margin-top: 0.5rem;
            transition: border-color 0.3s;
        }

        .form-group input:focus {
            border-color: #3498db;
        }

        .error-message {
            color: #e74c3c;
            font-size: 0.85rem;
            margin-top: 0.5rem;
        }

        .submit-btn {
            width: 100%;
            background-color: #3498db;
            color: #fff;
            padding: 10px;
            border: none;
            border-radius: 5px;
            font-size: 1rem;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .submit-btn:hover {
            background-color: #2980b9;
        }

        .login-container .links {
            text-align: center;
            margin-top: 1rem;
        }

        .login-container .links a {
            color: #3498db;
            text-decoration: none;
            font-size: 0.9rem;
        }

        .login-container .links a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

<div class="login-container">
    <h2>Admin Login</h2>

    <!-- Login Form -->
    <form action="{{ route('login') }}" method="POST">
        @csrf

        <!-- Email Input -->
        <div class="form-group">
            <label for="email">Email Address</label>
            <input type="email" name="email" id="email" value="{{ old('email') }}" required>
            @error('email')
                <div class="error-message">{{ $message }}</div>
            @enderror
        </div>

        <!-- Password Input -->
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" name="password" id="password" required>
            @error('password')
                <div class="error-message">{{ $message }}</div>
            @enderror
        </div>

        <!-- Submit Button -->
        <button type="submit" class="submit-btn">Login</button>

        <!-- Error Handling for Login -->
        @if(session('error'))
            <div class="error-message" style="margin-top: 1rem;">
                {{ session('error') }}
            </div>
        @endif
    </form>

    <div class="links">
        <a href="#">Forgot Password?</a>
    </div>
</div>

</body>
</html>
