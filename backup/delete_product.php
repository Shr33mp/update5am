<?php
// delete_product.php
session_start();
include 'db_connect.php';

if (isset($_POST['id'])) {
    $id = $_POST['id'];

    // Delete the product from the database
    $query = "DELETE FROM products WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        header("Location: admin.php?message=Product deleted successfully!");
        exit();
    } else {
        echo "Error deleting product!";
    }
} else {
    echo "No product ID received!";
    exit();
}
?>
