<?php
session_start(); // Directly start the session at the top of the file
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Beer-Tual - Home</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Tilt+Neon&display=swap');
        
        .hero {
            position: relative;
            overflow: hidden;
            color: white;
            padding: 0;
            background: rgba(0, 0, 0, 0.5); /* Semi-transparent background */
        }

        .hero .info {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            text-align: center;
            z-index: 10;
        }

        .hero .info h2 {
            font-family: "Tilt Neon", sans-serif;
            font-size: 3rem; /* Adjusted font size for better visibility */
            font-weight: 700; /* Bold text for impact */
            color: #fff;
            text-shadow: 0 0 5px rgba(0, 255, 255, 0.7), 0 0 10px rgba(0, 255, 255, 0.5); /* Neon glow effect */
            margin-bottom: 1rem;
            animation: neon 1.5s ease-in-out infinite; /* Animation for neon effect */
        }

        .hero .info p {
            font-size: 1.5rem;
            color: #eee;
            text-shadow: 0 0 3px rgba(0, 0, 0, 0.6); /* Subtle shadow for readability */
        }

        .hero .info .btn-get-started {
            margin-top: 20px;
            padding: 10px 20px;
            font-size: 1rem;
            color: #fff;
            background: linear-gradient(90deg, #ff0080, #00ffff); /* Gradient button */
            border: none;
            border-radius: 5px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.5);
        }

        .hero .carousel-item img {
            width: 100%;
            height: auto;
            object-fit: cover;
        }

        @keyframes neon {
            0% {
                text-shadow: 0 0 5px rgba(0, 255, 255, 0.7), 0 0 10px rgba(0, 255, 255, 0.5);
            }
            50% {
                text-shadow: 0 0 10px rgba(0, 255, 255, 1), 0 0 20px rgba(0, 255, 255, 0.8);
            }
            100% {
                text-shadow: 0 0 5px rgba(0, 255, 255, 0.7), 0 0 10px rgba(0, 255, 255, 0.5);
            }
        }
    </style>
</head>

<body class="vh-100 flex-column">

    <?php include 'navbar.php'; // Include the navbar ?>

    <!-- Hero Section -->
    <section id="hero" class="hero section dark-background">
        <div class="info d-flex align-items-center">
            <div class="container">
                <div class="row justify-content-center" data-aos="fade-up" data-aos-delay="100">
                    <div class="col-lg-6 text-center">
                        <h2>Welcome to Beer-Tual</h2>
                        <p>Discover a wide variety of beverages and enjoy a seamless shopping experience.</p>
                        <a href="products.php" class="btn-get-started">Get Started</a>
                    </div>
                </div>
            </div>
        </div>

        <div id="hero-carousel" class="carousel slide" data-bs-ride="carousel" data-bs-interval="5000">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="slides/slide1.jpg" alt="Slide 1">
                </div>
                <div class="carousel-item">
                    <img src="slides/slide2.jpg" alt="Slide 2">
                </div>
                <div class="carousel-item">
                    <img src="slides/slide3.jpg" alt="Slide 3">
                </div>
                <div class="carousel-item">
                    <img src="slides/slide4.jpg" alt="Slide 4">
                </div>
                <a class="carousel-control-prev" href="#hero-carousel" role="button" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </a>
                <a class="carousel-control-next" href="#hero-carousel" role="button" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </a>
            </div>
        </div>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <?php include 'footer.php'; ?>
</body>

</html>
