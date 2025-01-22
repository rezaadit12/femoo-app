<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container d-flex align-items-center justify-content-center min-vh-100">
        <div class="card shadow p-4" style="width: 100%; max-width: 500px;">
            <div class="text-center mb-4">
                <h3 class="mb-1">Create Account</h3>
                <p class="text-muted">Fill in the form to create your account</p>
            </div>
            <form method="post" action="{{ route('register.proses') }}">
                @csrf
                <!-- Full Name Input -->
                <div class="mb-3">
                    <label for="name" class="form-label">Username</label>
                    <input type="text" name="name"  class="form-control" id="name" placeholder="Enter your full name" required>
                </div>
                <!-- Email Input -->
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" placeholder="Enter your email" name="email" required>
                </div>
                <!-- Password Input -->
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" name="password" id="password" placeholder="Create a password" required>
                </div>
                <!-- Confirm Password Input -->
                <div class="mb-3">
                    <label for="confirm-password" class="form-label">Confirm Password</label>
                    <input type="password" class="form-control" name="confirmPassword" id="confirm-password" placeholder="Confirm your password" required>
                </div>

                <!-- Register Button -->
                <div class="d-grid">
                    <button type="submit" class="btn btn-primary">Register</button>
                </div>
                <!-- Links -->
                <div class="text-center mt-3">
                    <p>Already have an account? <a href="{{ route('login') }}" class="text-decoration-none">Login here</a></p>
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
