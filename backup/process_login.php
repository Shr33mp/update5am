<?php
include 'session_start.php';

include 'db_connect.php'; // Ensure this points to your database connection file

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Prepare and execute query to get user details
    $stmt = $conn->prepare("SELECT id, password FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        // Fetch user data
        $user = $result->fetch_assoc();
        $hashed_password = $user['password'];

        // Verify password
        if (password_verify($password, $hashed_password)) {
            // Password is correct, start session and redirect to home
            $_SESSION['user_email'] = $email; // Store email in session
            header('Location: home.php');
            exit();
        } else {
            // Incorrect password
            header('Location: login.php?error=invalid');
            exit();
        }
    } else {
        // Email not found
        header('Location: login.php?error=invalid');
        exit();
    }

    $stmt->close();
    $conn->close();
}
