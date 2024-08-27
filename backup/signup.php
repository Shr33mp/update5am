<?php
// Retrieve error message and form data from the query parameters
$error = isset($_GET['error']) ? htmlspecialchars($_GET['error']) : '';
$name = isset($_GET['name']) ? htmlspecialchars($_GET['name']) : '';
$username = isset($_GET['username']) ? htmlspecialchars($_GET['username']) : '';
$email = isset($_GET['email']) ? htmlspecialchars($_GET['email']) : '';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="styles.css">
    <style>
        @keyframes neon-border {
            0% {
                border-color: #ff00ff;
                box-shadow: 0 0 10px #ff00ff, 0 0 20px #ff00ff, 0 0 30px #ff00ff, 0 0 40px #ff00ff;
            }
            25% {
                border-color: #00ffff;
                box-shadow: 0 0 10px #00ffff, 0 0 20px #00ffff, 0 0 30px #00ffff, 0 0 40px #00ffff;
            }
            50% {
                border-color: #ff00ff;
                box-shadow: 0 0 10px #ff00ff, 0 0 20px #ff00ff, 0 0 30px #ff00ff, 0 0 40px #ff00ff;
            }
            75% {
                border-color: #00ffff;
                box-shadow: 0 0 10px #00ffff, 0 0 20px #00ffff, 0 0 30px #00ffff, 0 0 40px #00ffff;
            }
            100% {
                border-color: #ff00ff;
                box-shadow: 0 0 10px #ff00ff, 0 0 20px #ff00ff, 0 0 30px #ff00ff, 0 0 40px #ff00ff;
            }
        }
        
        body {
            background-image: url('assets/bgproducts.jpg');
            background-size: cover;
            background-position: center;
            backdrop-filter: blur(5px);
            color: white;
        }
        .signup-form {
            max-width: 500px;
            background-color: rgba(0, 0, 0, 0.7);
            padding: 20px;
            border-radius: 10px;
            border: 3px solid;
            animation: neon-border 5s infinite;
            box-shadow: 0px 0px 20px rgba(255, 255, 255, 0.8);
        }
        .signup-form h2 {
            font-weight: bold;
            margin-bottom: 20px;
            color: #ffc107;
        }
        .signup-form .form-label {
            color: white; /* Change label text to white */
        }
        .signup-form .form-control {
            background-color: rgba(255, 255, 255, 0.1);
            border: 1px solid #ffc107;
            color: white; /* White text in inputs */
        }
        .signup-form .form-control:focus {
            background-color: rgba(255, 255, 255, 0.2);
            border-color: #ff5733;
            box-shadow: none;
            color: white; /* White text when focused */
        }
        .signup-form .btn-primary {
            background-color: #ff5733;
            border: none;
        }
        .signup-form .btn-primary:hover {
            background-color: #FF3131;
        }
        .signup-form .btn-secondary {
            background-color: #007bff; /* Blue background */
            border: none;
            color: white;
            text-decoration: underline; /* Underlined text */
        }
        .signup-form .btn-secondary:hover {
            background-color: #0056b3;
            text-decoration: underline;
        }
        #error-message {
            font-weight: bold;
            text-align: center;
            margin-bottom: 10px;
            color: #ffcccc; /* Light red for error message */
        }
        .btn-group-custom {
            display: flex;
            justify-content: space-between;
        }
    </style>
</head>
<body class="vh-100 d-flex justify-content-center align-items-center">
    <div class="signup-form container">
        <h2 class="text-center">Sign Up</h2>
        <form action="process_signup.php" method="post">
            <div class="mb-3">
                <label for="name" class="form-label">Full Name</label>
                <input type="text" class="form-control" name="name" id="name" value="<?php echo $name; ?>" required>
            </div>
            <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" class="form-control" name="username" id="username" value="<?php echo $username; ?>" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email address</label>
                <input type="email" class="form-control" name="email" id="email" value="<?php echo $email; ?>" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" name="password" id="password" required>
            </div>
            <div class="mb-3">
                <label for="confirm_password" class="form-label">Confirm Password</label>
                <input type="password" class="form-control" name="confirm_password" id="confirm_password" required>
            </div>
            <div class="mb-3">
                <div class="text-danger" id="error-message">
                    <?php if ($error) { echo $error; } ?>
                </div>
            </div>
            <div class="btn-group-custom">
                <button type="submit" class="btn btn-primary w-50">Sign Up</button>
                <a href="login.php" class="btn btn-secondary w-50 text-center">Already have an account?</a>
            </div>
        </form>
    </div>
</body>
</html>
