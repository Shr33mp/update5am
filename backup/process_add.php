<?php
session_start();
include 'db_connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $stock = $_POST['stock'];
    $category = $_POST['category']; // Added category field

    // Handle image upload
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["image"]["name"]);
    move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);

    $image = $target_file;

    // Insert product into the database
    $query = "INSERT INTO products (name, description, price, stock, image, category) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ssdsss", $name, $description, $price, $stock, $image, $category);

    if ($stmt->execute()) {
        header('Location: products.php'); // Redirect to products page
    } else {
        echo "Error adding product: " . $conn->error;
    }

    $stmt->close();
    $conn->close();
}
?>
