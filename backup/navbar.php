<?php
include 'session_start.php';
include 'db_connect.php'; // Ensure this points to your database connection file
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <style>
        /* Navbar Styling */
        .navbar-dark .navbar-brand img {
            width: 150px; /* Adjust logo size */
        }

        /* Offcanvas Sidebar Styling */
        .offcanvas-start {
            background: rgba(0, 0, 0, 0.8); /* Dark, semi-transparent background */
            color: white; /* White text */
        }

        .offcanvas-header,
        .offcanvas-body {
            color: white;
        }

        .offcanvas-header h5 {
            color: white;
        }

        .offcanvas a.nav-link {
            color: white; /* White link text */
        }

        .offcanvas a.nav-link:hover {
            color: #007bff; /* Optional: Change color on hover */
        }

        .btn-close-white {
            filter: brightness(0) invert(1); /* Ensure the close button is visible against dark background */
        }
    </style>

    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container">
            <a class="navbar-brand fs-4" href="home.php"><img src='assets/logo.png' class='logo'></a>
            <button class="navbar-toggler shadow-none border-0" type="button" data-bs-toggle="offcanvas"
                data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="sidebar offcanvas offcanvas-start" tabindex="-1" id="offcanvasNavbar"
                aria-labelledby="offcanvasNavbarLabel">
                <div class="offcanvas-header border-bottom">
                    <h5 class="offcanvas-title" id="offcanvasNavbarLabel">MENU</h5>
                    <button type="button" class="btn-close btn-close-white shadow-none" data-bs-dismiss="offcanvas"
                        aria-label="Close"></button>
                </div>
                <div class="offcanvas-body d-flex flex-column flex-lg-row p-4">
                    <ul class="navbar-nav justify-content-center align-items-center fs-5 flex-grow-1 pe-3"
                        id="navbarNav">
                        <li class="nav-item mx-2">
                            <a class="nav-link home" href="home.php">Home</a>
                        </li>
                        <li class="nav-item mx-2">
                            <a class="nav-link about" href="about.php">About us</a>
                        </li>
                        <li class="nav-item mx-2">
                            <a class="nav-link ourteam" href="ourteam.php">Our Team</a>
                        </li>
                        <li class="nav-item mx-2">
                            <a class="nav-link products" href="products.php">Products</a>
                        </li>
                        <li class="nav-item mx-2">
                            <a class="nav-link products" href="transaction_history.php">History</a>
                        </li>
                    </ul>
                    <div class="d-flex justify-content-center flex-lg-row align-items-center gap-3">
                        <?php if (isset($_SESSION['email'])): ?>
                        <a href="logout.php" class="text-white text-decoration-none px-3 py-1 rounded-4"
                            style="background-color: red">Log Out</a>
                        <?php else: ?>
                        <a href="login.php" class="text-white">Log In</a>
                        <a href="signup.php" class="text-white text-decoration-none px-3 py-1 rounded-4"
                            style="background-color: red">Sign Up</a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </nav>
</body>

</html>
