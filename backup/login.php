<?php
include 'db_connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT id, username, password FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($id, $username, $hashed_password);
    $stmt->fetch();

    if ($stmt->num_rows > 0 && password_verify($password, $hashed_password)) {
        session_start(); // Ensure this is called at the beginning
        $_SESSION['user_id'] = $id; // Store user ID in session
        $_SESSION['username'] = $username;
        $_SESSION['email'] = $email;
        header('Location: home.php');
        exit;
    } else {
        header('Location: login.php?error=invalid');
        exit;
    }

    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Beer-Tual - Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        @keyframes neon-border {
            0% { border-color: #ff00ff; box-shadow: 0 0 10px #ff00ff, 0 0 20px #ff00ff, 0 0 30px #ff00ff, 0 0 40px #ff00ff; }
            25% { border-color: #00ffff; box-shadow: 0 0 10px #00ffff, 0 0 20px #00ffff, 0 0 30px #00ffff, 0 0 40px #00ffff; }
            50% { border-color: #ff00ff; box-shadow: 0 0 10px #ff00ff, 0 0 20px #ff00ff, 0 0 30px #ff00ff, 0 0 40px #ff00ff; }
            75% { border-color: #00ffff; box-shadow: 0 0 10px #00ffff, 0 0 20px #00ffff, 0 0 30px #00ffff, 0 0 40px #00ffff; }
            100% { border-color: #ff00ff; box-shadow: 0 0 10px #ff00ff, 0 0 20px #ff00ff, 0 0 30px #ff00ff, 0 0 40px #ff00ff; }
        }
        
        body {
            background-image: url('assets/bgproducts.jpg');
            background-size: cover;
            background-position: center;
            backdrop-filter: blur(5px);
            color: white;
        }
        .container {
            max-width: 500px;
            background-color: rgba(0, 0, 0, 0.7);
            padding: 20px;
            border-radius: 10px;
            border: 3px solid;
            animation: neon-border 5s infinite;
            box-shadow: 0px 0px 20px rgba(255, 255, 255, 0.8);
        }
        h2 {
            font-weight: bold;
            margin-bottom: 20px;
            color: #ffc107;
        }
        .form-label {
            color: #e0e0e0; 
        }
        .form-control {
            background-color: rgba(255, 255, 255, 0.1);
            border: 1px solid #ffc107;
            color: white; /* White text in inputs */
        }
        .form-control:focus {
            background-color: rgba(255, 255, 255, 0.2);
            border-color: #ff5733;
            box-shadow: none;
            color: white; /* White text when focused */
        }
        .btn-primary {
            background-color: #ff5733;
            border: none;
        }
        .btn-primary:hover {
            background-color: #FF3131;
        }
        .alert-danger {
            font-weight: bold;
            text-align: center;
            margin-bottom: 10px;
            color: #ffcccc; /* Light red for error message */
        }
    </style>
</head>
<body class="vh-100 d-flex justify-content-center align-items-center">
    <div class="container">
        <h2 class="text-center">Log In</h2>
        <?php if (isset($_GET['error']) && $_GET['error'] == 'invalid'): ?>
            <div class="alert alert-danger" role="alert">
                Invalid email or password.
            </div>
        <?php endif; ?>
        <form method="post" action="login.php">
            <div class="mb-3">
                <label for="email" class="form-label">Email address</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <button type="submit" class="btn btn-primary">Login</button>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
a