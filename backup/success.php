<?php
if (isset($_GET['transaction_number'])) {
    $transaction_number = $_GET['transaction_number'];
    echo "<h1>Transaction Successful</h1>";
    echo "<p>Your transaction number is $transaction_number</p>";
} else {
    header('Location: index.php');
}
?>
