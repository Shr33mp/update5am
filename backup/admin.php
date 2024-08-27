<?php
include 'db_connect.php';

// Fetch data from tables
function fetchData($conn, $query) {
    $stmt = $conn->prepare($query);
    $stmt->execute();
    return $stmt->get_result();
}

// Fetch products
$products = fetchData($conn, "SELECT * FROM products");

// Fetch transactions with location data
$transactions = fetchData($conn, "SELECT * FROM transactions");

// Fetch transaction details
$transaction_details = fetchData($conn, "SELECT * FROM transaction_details");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - Beer-Tual</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#">Beer-Tual Admin Panel</a>
        <div class="collapse navbar-collapse">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link" href="#products">Products</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#transactions">Transactions</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#transaction-details">Transaction Details</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="logout.php">Log Out</a>
                </li>
            </ul>
        </div>
    </nav>

    <div class="container mt-4">
        <!-- Products Section -->
        <section id="products">
            <h2>Manage Products</h2>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Price</th>
                        <th>Image</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $products->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($row['id']); ?></td>
                        <td><?php echo htmlspecialchars($row['name']); ?></td>
                        <td><?php echo htmlspecialchars($row['description']); ?></td>
                        <td><?php echo htmlspecialchars($row['price']); ?></td>
                        <td><img src="uploads/<?php echo htmlspecialchars($row['image']); ?>" alt="<?php echo htmlspecialchars($row['name']); ?>" style="width: 100px;"></td>
                        <td>
                            <a href="edit.php?id=<?php echo $row['id']; ?>" class="btn btn-warning btn-sm">Edit</a>
                            <form action="delete_product.php" method="POST" style="display:inline;">
                                <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                            </form>
                        </td>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
            <a href="add_product.php" class="btn btn-primary">Add New Product</a>
        </section>

        <!-- Transactions Section -->
        <section id="transactions" class="mt-4">
            <h2>Manage Transactions</h2>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Transaction ID</th>
                        <th>Transaction Number</th>
                        <th>User Email</th>
                        <th>City</th>
                        <th>Municipality</th>
                        <th>Zipcode</th>
                        <th>House Number</th>
                        <th>Transaction Time</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $transactions->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($row['transaction_id']); ?></td>
                        <td><?php echo htmlspecialchars($row['transaction_number']); ?></td>
                        <td><?php echo htmlspecialchars($row['user_email']); ?></td>
                        <td><?php echo htmlspecialchars($row['city']); ?></td>
                        <td><?php echo htmlspecialchars($row['municipality']); ?></td>
                        <td><?php echo htmlspecialchars($row['zipcode']); ?></td>
                        <td><?php echo htmlspecialchars($row['house_number']); ?></td>
                        <td><?php echo htmlspecialchars($row['transaction_time']); ?></td>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </section>

        <!-- Transaction Details Section -->
        <section id="transaction-details" class="mt-4">
            <h2>Manage Transaction Details</h2>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Detail ID</th>
                        <th>Transaction Number</th>
                        <th>Product Name</th>
                        <th>Product Price</th>
                        <th>Quantity</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $transaction_details->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($row['detail_id']); ?></td>
                        <td><?php echo htmlspecialchars($row['transaction_number']); ?></td>
                        <td><?php echo htmlspecialchars($row['product_name']); ?></td>
                        <td><?php echo htmlspecialchars($row['product_price']); ?></td>
                        <td><?php echo htmlspecialchars($row['quantity']); ?></td>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </section>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
