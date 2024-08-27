<?php
session_start();
include 'db_connect.php';

$user_email = $_SESSION['email']; // Assuming user is logged in

$query = "SELECT * FROM transactions WHERE user_email = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("s", $user_email);
$stmt->execute();
$result = $stmt->get_result();

$transactions = [];
while ($row = $result->fetch_assoc()) {
    $transactions[] = $row;
}
$stmt->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transaction History - Beer-Tual</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container my-5">
        <h2>Transaction History</h2>
        <?php if (!empty($transactions)): ?>
            <div class="list-group">
                <?php foreach ($transactions as $transaction): ?>
                    <a href="transaction_details.php?transaction_number=<?php echo $transaction['transaction_number']; ?>" class="list-group-item list-group-item-action">
                        Transaction #<?php echo $transaction['transaction_number']; ?> - <?php echo $transaction['transaction_time']; ?>
                    </a>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <p>No transactions found.</p>
        <?php endif; ?>
    </div>
</body>
</html>
