<?php
session_start();
include 'db_connect.php'; // Include your database connection file

$user_email = $_SESSION['username'] ?? '';

// Fetch purchase history for the logged-in user
$query = "SELECT t.transaction_number, t.transaction_time, td.product_name, td.product_price, td.quantity 
          FROM transactions t 
          JOIN transaction_details td ON t.transaction_number = td.transaction_number
          WHERE t.user_email = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param('s', $user_email);
$stmt->execute();
$result = $stmt->get_result();

$transactions = [];
while ($row = $result->fetch_assoc()) {
    $transactions[] = $row;
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Beer-Tual - Purchase History</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .table-container {
            background-color: #f8f9fa;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .table thead th {
            background-color: #343a40;
            color: #ffffff;
            text-align: center;
        }
        .table tbody tr:nth-child(even) {
            background-color: #e9ecef;
        }
        .table tbody tr:hover {
            background-color: #f1f3f5;
        }
        .table td, .table th {
            vertical-align: middle;
        }
        .table td {
            text-align: center;
        }
    </style>
</head>
<body>
    <?php include 'navbar.php'; ?>
    <div class="container my-5">
        <h1 class="mb-4">Purchase History</h1>
        <div class="table-container">
            <?php if (!empty($transactions)): ?>
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>Transaction Number</th>
                            <th>Date</th>
                            <th>Product Name</th>
                            <th>Price</th>
                            <th>Quantity</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($transactions as $transaction): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($transaction['transaction_number']); ?></td>
                                <td><?php echo htmlspecialchars($transaction['transaction_time']); ?></td>
                                <td><?php echo htmlspecialchars($transaction['product_name']); ?></td>
                                <td>$<?php echo number_format($transaction['product_price'], 2); ?></td>
                                <td><?php echo htmlspecialchars($transaction['quantity']); ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php else: ?>
                <p class="text-center">You have no purchase history.</p>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>
