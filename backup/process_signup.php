<?php
// Include database connection
include 'db_connect.php';

// Retrieve POST data
$name = $_POST['name'];
$username = $_POST['username'];
$email = $_POST['email'];
$password = $_POST['password'];
$confirm_password = $_POST['confirm_password'];

// Basic validation
if ($password !== $confirm_password) {
    header("Location: signup.php?error=Passwords do not match&name=$name&username=$username&email=$email");
    exit();
}

// Check if email already exists
$stmt = $conn->prepare("SELECT id FROM users WHERE email = ?");
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    header("Location: signup.php?error=Email already exists&name=$name&username=$username&email=$email");
    exit();
}

// Insert new user
$stmt = $conn->prepare("INSERT INTO users (name, username, email, password) VALUES (?, ?, ?, ?)");
$hashed_password = password_hash($password, PASSWORD_DEFAULT);
$stmt->bind_param("ssss", $name, $username, $email, $hashed_password);

if ($stmt->execute()) {
    session_start();
    $_SESSION['username'] = $username;
    $_SESSION['email'] = $email;
    header("Location: home.php");
} else {
    header("Location: signup.php?error=An error occurred, please try again&name=$name&username=$username&email=$email");
}

$stmt->close();
$conn->close();
?>
