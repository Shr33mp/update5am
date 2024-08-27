<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Neon Box with Confetti Button</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body, html {
            height: 100%;
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: #000; /* Dark background to enhance neon effect */
            overflow: hidden;
        }
        .neon-box {
            width: 250px;
            height: 250px;
            border: 5px solid #ff6b6b;
            animation: changeNeonColor 3s infinite alternate;
            box-sizing: border-box;
            border-radius: 10px;
            box-shadow: 0 0 20px #ff6b6b, 0 0 40px #ff6b6b, 0 0 60px #ff6b6b;
            display: flex;
            justify-content: center;
            align-items: center;
            position: relative;
            z-index: 1;
        }
        @keyframes changeNeonColor {
            0% { 
                border-color: #ff6b6b; 
                box-shadow: 0 0 20px #ff6b6b, 0 0 40px #ff6b6b, 0 0 60px #ff6b6b;
            }
            25% { 
                border-color: #feca57;
                box-shadow: 0 0 20px #feca57, 0 0 40px #feca57, 0 0 60px #feca57;
            }
            50% { 
                border-color: #48dbfb;
                box-shadow: 0 0 20px #48dbfb, 0 0 40px #48dbfb, 0 0 60px #48dbfb;
            }
            75% { 
                border-color: #1dd1a1;
                box-shadow: 0 0 20px #1dd1a1, 0 0 40px #1dd1a1, 0 0 60px #1dd1a1;
            }
            100% { 
                border-color: #5f27cd;
                box-shadow: 0 0 20px #5f27cd, 0 0 40px #5f27cd, 0 0 60px #5f27cd;
            }
        }
        .neon-button {
            background-color: transparent;
            border: 2px solid #fff;
            color: #fff;
            padding: 10px 20px;
            font-size: 18px;
            text-transform: uppercase;
            border-radius: 5px;
            box-shadow: 0 0 5px #fff, 0 0 10px #fff, 0 0 15px #fff;
            cursor: pointer;
            position: relative;
            transition: all 0.3s ease;
            z-index: 10;
        }
        .confetti {
            position: fixed;
            top: 0;
            width: 10px;
            height: 10px;
            background-color: #ff6b6b;
            opacity: 0;
            animation: scatterFall var(--duration) ease-out forwards;
        }
        @keyframes scatterFall {
            0% {
                opacity: 1;
                transform: translateY(0) translateX(0) rotate(0deg);
            }
            100% {
                opacity: 0;
                transform: translateY(100vh) translateX(calc(var(--direction, 0) * 100px)) rotate(720deg);
            }
        }
    </style>
</head>
<body>
    <div class="neon-box">
        <button class="neon-button" onclick="sparkConfetti()">Click Me</button>
    </div>
    <div class="mb-5">
    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2733.5745003960783!2d120.86147763950923!3d14.319672087875023!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x33962bfa6112cadf%3A0xc59d4bb65cb9d151!2sBELVEDERE%20PARK!5e0!3m2!1sen!2sph!4v1724598519965!5m2!1sen!2sph" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
      </div><!-- End Google Maps -->
      


    <script>
        function sparkConfetti() {
            for (let i = 0; i < 100; i++) {
                const confetti = document.createElement('div');
                confetti.classList.add('confetti');
                confetti.style.left = `${Math.random() * 100}vw`;
                confetti.style.backgroundColor = getRandomColor();
                confetti.style.setProperty('--direction', `${Math.random() * 2 - 1}`);
                confetti.style.setProperty('--duration', `${Math.random() * 2 + 2}s`); // Random duration between 2s and 4s
                document.body.appendChild(confetti);
                setTimeout(() => {
                    confetti.remove();
                }, 4000); // Match the maximum duration
            }
        }

        function getRandomColor() {
            const colors = ['#ff6b6b', '#feca57', '#48dbfb', '#1dd1a1', '#5f27cd'];
            return colors[Math.floor(Math.random() * colors.length)];
        }
    </script>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"></script>
</body>
</html>
