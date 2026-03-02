<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="shortcut icon" href="{{ asset('assets/image/fabicon.png') }}" type="image/x-icon" />
    <link rel="stylesheet" href="{{ asset('assets/css/student.css') }}">
</head>

<body>

    <div class="auth-wrapper">
        <div class="auth-card">
            <h2 class="auth-title">Login to Your Account</h2>
            @if (session('error'))
                <div style="color: red; margin-bottom: 10px; text-align: center;">
                    {{ session('error') }}
                </div>
            @endif

            <form action="login" method="POST">
                @csrf
                <div class="form-group">
                    <label>Email Address</label>
                    <input type="email" name="email" placeholder="Enter your email">
                </div>

                <div class="form-group">
                    <label>Password</label>
                    <input type="password" name="password" placeholder="Enter your password" required>
                </div>

                <button type="submit" class="btn-primary full-width">
                    Login
                </button>

                <p class="auth-footer-text">
                    Don’t have an account?
                    <a href="register.html">Register</a>
                </p>
            </form>
        </div>
    </div>

</body>

</html>
