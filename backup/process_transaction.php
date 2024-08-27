<?php
include 'session_start.php';
header('Content-Type: application/json');

include 'db_connect.php'; // Ensure this points to your database connection file

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);

    if (!isset($data['cart']) || !is_array($data['cart'])) {
        echo json_encode(['error' => 'Invalid cart data']);
        exit;
    }

    $cart = $data['cart'];
    $userEmail = isset($_SESSION['email']) ? $_SESSION['email'] : null;

    if (!$userEmail) {
        echo json_encode(['error' => 'User not logged in']);
        exit;
    }

    // Begin transaction
    $conn->begin_transaction();

    try {
        // Generate a unique transaction number
        $transactionNumber = uniqid();

        foreach ($cart as $productName => $item) {
            $id = $item['id'];
            $price = $item['price'];
            $quantity = $item['quantity'];

            // Check stock
            $result = $conn->query("SELECT stock FROM products WHERE id = $id");
            $row = $result->fetch_assoc();

            if ($row['stock'] < $quantity) {
                throw new Exception("Not enough stock for $productName");
            }

            // Insert transaction
            $stmt = $conn->prepare("INSERT INTO transactions (transaction_number, user_email, transaction_time) VALUES (?, ?, NOW())");
            $stmt->bind_param('ss', $transactionNumber, $userEmail);
            $stmt->execute();

            // Insert transaction details
            $stmt = $conn->prepare("INSERT INTO transaction_details (transaction_number, product_name, product_price, quantity) VALUES (?, ?, ?, ?)");
            $stmt->bind_param('ssdi', $transactionNumber, $productName, $price, $quantity);
            $stmt->execute();

            // Update stock
            $newStock = $row['stock'] - $quantity;
            $stmt = $conn->prepare("UPDATE products SET stock = ? WHERE id = ?");
            $stmt->bind_param('ii', $newStock, $id);
            $stmt->execute();
        }

        // Commit transaction
        $conn->commit();

        echo json_encode(['transaction_number' => $transactionNumber]);
    } catch (Exception $e) {
        // Rollback transaction
        $conn->rollback();
        echo json_encode(['error' => $e->getMessage()]);
    } finally {
        $conn->close();
    }
} else {
    echo json_encode(['error' => 'Invalid request method']);
}
?>
