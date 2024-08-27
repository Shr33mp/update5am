<?php
session_start();
include 'db_connect.php';

$transaction_number = $_GET['transaction_number'];

$query = "SELECT * FROM transaction_details WHERE transaction_number = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("s", $transaction_number);
$stmt->execute();
$result = $stmt->get_result();

$details = [];
while ($row = $result->fetch_assoc()) {
    $details[] = $row;
}
$stmt->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transaction Details - Beer-Tual</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container my-5">
        <h2>Transaction Details</h2>
        <?php if (!empty($details)): ?>
            <ul class="list-group">
                <?php foreach ($details as $detail): ?>
                    <li class="list-group-item">
                        <?php echo $detail['product_name']; ?> - $<?php echo $detail['product_price']; ?> x <?php echo $detail['quantity']; ?>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php else: ?>
            <p>No details found for this transaction.</p>
        <?php endif; ?>
        <a href="transaction_history.php" class="btn btn-primary mt-3">Back to Transaction History</a>
    </div>
</body>
</html>
