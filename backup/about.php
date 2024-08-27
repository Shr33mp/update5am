<!-- about.php -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Beer-Tual - About Us</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Manrope:wght@200..800&family=Poppins:wght@100..900&display=swap');

        /* General Body Styling */
        body {
            font-family: 'Poppins', sans-serif;
            color: #f8f9fa;
            background-color: #2c2c2c;
        }

        /* Section Styling */
        .content-section {
            padding: 3rem 1rem;
        }

        .content-section h1 {
            font-weight: 400;
            margin-bottom: 1.5rem;
            color: #eaeaea;
            text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.6);
        }

        .content-section h3 {
            font-weight: 300;
            line-height: 1.6;
            color: #eaeaea;
        }

        .image-container img {
            width: 100%;
            height: auto;
            object-fit: cover;
            aspect-ratio: 1/1; /* Ensures square image */
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.5);
        }

        .bg-dark-gray {
            background-color: #1e1b1b;
            position: relative;
            overflow: hidden;
        }

        .bg-dark-gray::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 5px;
            background: linear-gradient(90deg, #ff0080, #00ffff, #ff8c00, #00ff00, #ff0080);
            background-size: 400% 100%;
            animation: neonBorder 10s linear infinite;
        }

        .bg-deep-purple {
            background-color: #281127;
            position: relative;
            overflow: hidden;
        }

        .bg-deep-purple::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 5px;
            background: linear-gradient(90deg, #ff0080, #00ffff, #ff8c00, #00ff00, #ff0080);
            background-size: 400% 100%;
            animation: neonBorder 10s linear infinite;
        }

        @keyframes neonBorder {
            0% {
                background-position: 0% 0%;
            }
            50% {
                background-position: 100% 0%;
            }
            100% {
                background-position: 0% 0%;
            }
        }

        /* Responsive Adjustments */
        @media (max-width: 768px) {
            .content-section h3 {
                font-size: 1rem;
            }
        }
    </style>
</head>

<body>

    <?php include 'navbar.php'; ?>

    <!-- ROW 1 -->
    <section class="content-section bg-dark-gray">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-3 col-md-6 col-sm-12 mb-4 mb-lg-0 image-container">
                    <img src="assets/newpic1.jpg" class="img-fluid" alt="Background Story Image 1">
                </div>
                <div class="col-lg-9 col-md-6 col-sm-12">
                    <h1 class="text-center text-lg-start">Background Story</h1>
                    <h3 class="text-center text-lg-start">The idea for "Beer-tual" emerged from the growing popularity of online purchasing and the demand for a consolidated platform specialized to beverages. The existing market lacks a centralized location for discovering and purchasing varied drinks, forcing customers to browse multiple websites or physical storefronts. "Beer-tual" bridges this gap by providing a user-friendly interface, a diverse variety, and a simple ordering process...</h3>
                </div>
            </div>
        </div>
    </section>

    <!-- ROW 2 -->
    <section class="content-section bg-deep-purple">
        <div class="container">
            <div class="row align-items-center flex-lg-row-reverse">
                <div class="col-lg-3 col-md-6 col-sm-12 mb-4 mb-lg-0 image-container">
                    <img src="assets/newpic2.jpg" class="img-fluid" alt="Our Vision Image 2">
                </div>
                <div class="col-lg-9 col-md-6 col-sm-12">
                    <h1 class="text-center text-lg-start">Our Vision</h1>
                    <h3 class="text-center text-lg-start">At "Beer-tual," we envision a world where beverage enthusiasts have access to a diverse range of drinks at their fingertips. Our platform aims to inspire creativity, exploration, and social connection through the sharing of unique beverage experiences...</h3>
                </div>
            </div>
        </div>
    </section>
    <?php include 'footer.php'; ?>
    <script src="scripts.js"></script>
</body>

</html>
