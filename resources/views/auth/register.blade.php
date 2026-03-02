<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Register</title>
    <link rel="shortcut icon" href="{{ asset('assets/image/fabicon.png') }}" type="image/x-icon" />
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
                    <label>User Role</label><br>

                    <label>
                        <input type="radio" name="role" value="1" checked onclick="toggleStudentForm()">
                        Admin (1)
                    </label>

                    <label>
                        <input type="radio" name="role" value="3" onclick="toggleStudentForm()">
                        Student (3)
                    </label>

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
                <div id="studentFields" style="display:none; margin-top:20px;">

                    <h3>Student Details</h3>

                    <div class="form-group">
                        <label>Roll No</label>
                        <input type="text" name="roll_no">
                    </div>

                    <div class="form-group">
                        <label>Course ID</label>
                        <input type="text" name="course_id">
                    </div>

                    <div class="form-group">
                        <label>Semester ID</label>
                        <input type="text" name="semester_id">
                    </div>

                    <div class="form-group">
                        <label>Phone</label>
                        <input type="text" name="phone">
                    </div>

                    <div class="form-group">
                        <label>Address</label>
                        <textarea name="address"></textarea>
                    </div>

                    <div class="form-group">
                        <label>Admission Date</label>
                        <input type="date" name="admission_date">
                    </div>

                    <div class="form-group">
                        <label>Status</label>
                        <select name="status">
                            <option value="1">Active</option>
                            <option value="0">Inactive</option>
                        </select>
                    </div>

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
    <script>
        function toggleStudentForm() {
            let role = document.querySelector('input[name="role"]:checked').value;
            let studentSection = document.getElementById('studentFields');

            if (role == "3") {
                studentSection.style.display = "block";
            } else {
                studentSection.style.display = "none";
            }
        }
    </script>
</body>

</html>
