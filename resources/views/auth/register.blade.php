<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Register</title>
    <link rel="stylesheet" href="{{ asset('assets/css/student.css') }}">
</head>

<body>

    <div class="auth-wrapper">
        <div class="auth-card">
            <h2 class="auth-title">Create New Account</h2>

            <form action="register" method="POST">
                @csrf
                <div class="form-group">
                    <label>Full Name</label>
                    <input type="text" name="name" placeholder="Enter your name">
                    @error('name')
                        <div style="color:red">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label>User Role</label>
                    <input type="number" name="role" placeholder="Enter your Role">
                    {{-- <input type="email" name="email" value="{{ old('email') }}"> --}}
                    @error('role')
                        <div style="color:red">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label>Email Address</label>
                    <input type="email" name="email" placeholder="Enter your email">
                    {{-- <input type="email" name="email" value="{{ old('email') }}"> --}}
                    @error('email')
                        <div style="color:red">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label>Password</label>
                    <input type="password" name="password" placeholder="Create password">
                    {{-- <input type="email" name="email" value="{{ old('email') }}"> --}}
                    @error('password')
                        <div style="color:red">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label>Confirm Password</label>
                    <input type="password" name="password_confirmation" placeholder="Confirm password">
                    {{-- <input type="email" name="email" value="{{ old('email') }}"> --}}
                    @error('password_confirmation')
                        <div style="color:red">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="btn-primary full-width" style="justify-content: center">
                    Register
                </button>

                <p class="auth-footer-text">
                    Already have an account?
                    <a href="login.html">Login</a>
                </p>
            </form>
        </div>
    </div>

</body>

</html>
