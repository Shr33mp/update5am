<!DOCTYPE html>
<html lang="en">
<head>
    <!-- adds producsts -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Product - Beer-Tual</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="styles.css">
    <style>
        @keyframes neon-border {
            0%, 50%, 100% {
                border-color: #ff00ff;
                box-shadow: 0 0 10px #ff00ff, 0 0 20px #ff00ff, 0 0 30px #ff00ff, 0 0 40px #ff00ff;
            }
            25%, 75% {
                border-color: #00ffff;
                box-shadow: 0 0 10px #00ffff, 0 0 20px #00ffff, 0 0 30px #00ffff, 0 0 40px #00ffff;
            }
        }

        body {
            background-image: url('assets/bgproducts.jpg');
            background-size: cover;
            background-position: center;
            backdrop-filter: blur(5px);
            color: white;
        }
        .add-product-form {
            max-width: 600px;
            background-color: rgba(0, 0, 0, 0.7);
            padding: 20px;
            border-radius: 10px;
            border: 3px solid;
            animation: neon-border 5s infinite;
            box-shadow: 0px 0px 20px rgba(255, 255, 255, 0.8);
        }
        .add-product-form h2 {
            font-weight: bold;
            margin-bottom: 20px;
            color: #ffc107;
        }
        .add-product-form .form-label {
            color: #e0e0e0;
        }
        .add-product-form .form-control {
            background-color: rgba(255, 255, 255, 0.1);
            border: 1px solid #ffc107;
            color: white;
        }
        .add-product-form .form-control:focus {
            background-color: rgba(255, 255, 255, 0.2);
            border-color: #ff5733;
            box-shadow: none;
            color: white;
        }
        .add-product-form .btn-primary {
            background-color: #ff5733;
            border: none;
        }
        .add-product-form .btn-primary:hover {
            background-color: #FF3131;
        }
        .btn-close {
            background-color: #ff3131;
            color: white;
            border: none;
            padding: 10px 15px;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <div class="container my-5">
        <div class="add-product-form">
            <h2 class="text-center">Add a New Product</h2>
            <form action="process_add.php" method="post" enctype="multipart/form-data">
                <div class="mb-3">
                    <label for="name" class="form-label">Product Name</label>
                    <input type="text" class="form-control" id="name" name="name" required>
                </div>
                <div class="mb-3">
                    <label for="description" class="form-label">Product Description</label>
                    <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
                </div>
                <div class="mb-3">
                    <label for="price" class="form-label">Product Price</label>
                    <input type="number" step="0.01" class="form-control" id="price" name="price" required>
                </div>
                <div class="mb-3">
                    <label for="stock" class="form-label">Product Stock</label>
                    <input type="number" class="form-control" id="stock" name="stock" required>
                </div>
                <div class="mb-3">
                    <label for="category" class="form-label">Product Category</label>
                    <input type="text" class="form-control" id="category" name="category" required>
                </div>
                <div class="mb-3">
                    <label for="image" class="form-label">Product Image</label>
                    <input type="file" class="form-control" id="image" name="image" required>
                </div>
                <button type="submit" class="btn btn-primary">Add Product</button>
                <button type="button" class="btn btn-close" onclick="window.history.back();"></button>
            </form>
        </div>
    </div>
</body>
</html>
