<?php
session_start(); // Directly start the session at the top of the file
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Beer-Tual - Our Team</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="styles.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Tilt+Neon&display=swap');
        
        .team-member {
            border: 2px solid #007bff;
            border-radius: 15px;
            background-color: #1e1b1b;
            color: #fff;
            text-align: center;
            padding: 15px;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            height: 400px; /* Adjust this height to your preference */
            overflow: hidden;
        }

        .team-member:hover {
            transform: translateY(-10px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.3);
        }

        .team-member img {
            border-radius: 50%;
            width: 150px;
            height: 150px;
            object-fit: cover;
            border: 3px solid #007bff;
            margin: 0 auto; /* Center the image */
            display: block;
        }

        .team-member h3 {
            font-family: "Tilt Neon", sans-serif;
            color: #007bff;
            margin: 15px 0 10px;
        }

        .team-member p {
            font-size: 1rem;
            margin: 0;
            flex-grow: 1;
        }

        .team-section {
            
            padding: 50px 0;
        }

        .team-section h2 {
            font-family: "Tilt Neon", sans-serif;
            color: #fff;
            text-align: center;
            margin-bottom: 30px;
        }
    </style>
</head>

<body class="vh-100 overflow-hidden">
    <?php include 'navbar.php'; ?>

    <!-- Team Section -->
    <section class="team-section">
        <div class="container">
            <h2>Meet Our Team</h2>
            <div class="row">
                <!-- Team Member 1 -->
                <div class="col-md-3 mb-4">
                    <div class="team-member">
                        <img src="assets/mark.jpg" alt="Team Member 1">
                        <div>
                            <h3>Mark Javis Mateo</h3>
                            <h4>Lead Developer</h4>
                            <p>Mark is a skilled programmer who brings innovative solutions to life, ensuring our products are always cutting-edge.
                            <br>-Loves to drink and play games.
                            </p>
                        </div>
                    </div>
                </div>
                <!-- Team Member 2 -->
                <div class="col-md-3 mb-4">
                    <div class="team-member">
                        <img src="https://via.placeholder.com/150" alt="Team Member 2">
                        <div>
                            <h3>Crystal Nable</h3>
                            <p>Co-developer</p>
                        </div>
                    </div>
                </div>
                <!-- Team Member 3 -->
                <div class="col-md-3 mb-4">
                    <div class="team-member">
                        <img src="https://via.placeholder.com/150" alt="Team Member 3">
                        <div>
                            <h3>Lj</h3>
                            <p>Product Manager. Emily oversees product development and ensures quality in every bottle.</p>
                        </div>
                    </div>
                </div>
                <!-- Team Member 4 -->
                <div class="col-md-3 mb-4">
                    <div class="team-member">
                        <img src="https://via.placeholder.com/150" alt="Team Member 4">
                        <div>
                            <h3>Angel</h3>
                            <p>Head of Marketing. Jane creates engaging campaigns to spread the word about our unique offerings.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="toast-container position-fixed bottom-0 end-0 p-3">
        <div id="toast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-header">
                <strong class="me-auto">Notification</strong>
                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            <div id="toast-body" class="toast-body">
                Product added to cart!
            </div>
        </div>
    </div>
    <?php include 'footer.php'; ?>
    <script src="scripts.js"></script>
</body>

</html>
