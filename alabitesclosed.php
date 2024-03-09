<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="css/style.css">
    <style>
        /* Reset some default styles */
        body, html {
            margin: 0;
            padding: 0;
            height: 100%;
        }

        /* Banner Styles */
        .banner {
            background-color: #ff0000;
            color: #ffffff;
            text-align: center;
            padding: 20px;
            animation: fade-in 1s ease-in; /* Add a fade-in animation */
        }

        .banner h3 {
            font-size: 36px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 2px;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.6);
            margin: 0;
        }

        .banner p {
            font-size: 18px;
            margin-top: 10px;
        }

        /* Additional Content Styles */
        .additional-content {
            background-color: #fff;
            color: #000;
            text-align: center;
            padding: 20px;
        }

        .additional-content h4 {
            font-size: 24px;
            font-weight: 500;
            margin-top: 20px;
        }

        .additional-content p {
            font-size: 18px;
            margin-top: 10px;
        }

        /* Add a pulse animation to the "Stay Connected" section */
        .additional-content h4.stay-connected {
            animation: pulse 1s infinite;
        }

        /* Timer Styles */
        #countdown {
            font-size: 24px;
            font-weight: 700;
            text-align: center; /* Center-align the timer text */
            margin-top: 20px;
        }

        #timer {
            font-size: 32px;
            color: #ff0000; /* Red color for emphasis */
            display: inline-block; /* Display the timer as an inline block */
        }

        /* Animation for Countdown Timer */
        @keyframes countdown-fade {
            0% {
                opacity: 0;
                transform: scale(0.8);
            }
            100% {
                opacity: 1;
                transform: scale(1);
            }
        }

        #timer {
            animation: countdown-fade 1s forwards; /* Apply the fade-in animation */
        }
        .open-times {
            color: red; 
        }

    </style>
</head>
<body>
    <div class="banner">
        <h3>Website Closed</h3>
        <p>We apologize for the inconvenience. All stalls are closed right now. Please come back between 7am and 5pm.</p>
    </div>

    <div class="additional-content">
        <h4>Why Are We Closed?</h4>
        <p>Our dedicated food concessionaires are currently preparing fresh and delicious meals to serve you between 7am and 5pm. We are committed to providing you with the best dining experience, and that's why we need some time to prepare.</p>

        <h4 class="stay-connected">Stay Connected</h4>
        <p>Follow us on social media to stay updated with our latest offerings, special promotions, and opening hours. We look forward to serving you soon!</p>
        <h3 class="open-times">We are Open during 7am to 5pm Monday-Saturday/Sunday:CLOSED</h3>
    </div>
    <?php include('partials-front/footer.php'); ?>
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    <!-- <div id="countdown">
        <h4>Website Reopens In Approximately:</h4>
        <div id="timer">Calculating...</div>
    </div>-->





<!-- <script>
        // JavaScript for Countdown Timer
        const openingTime = 7; // 7:00 AM
        const closingTime = 17; // 5:00 PM
        const daysToOpen = [1, 2, 3, 4, 5]; // Monday to Friday
        const timeZoneOffset = 8; // Philippines Standard Time (UTC+8)

        const timerElement = document.getElementById("timer");

        function calculateNextOpening() {
            const now = new Date(new Date().getTime() + timeZoneOffset * 60 * 60 * 1000); // Adjust to Philippines time
            const currentDay = now.getDay(); // 0 for Sunday, 1 for Monday, ...

            if (daysToOpen.includes(currentDay)) {
                // Today is a valid opening day
                if (now.getHours() < openingTime) {
                    // The website opens today, before opening hours
                    return new Date(now.getFullYear(), now.getMonth(), now.getDate(), openingTime, 0, 0);
                } else if (now.getHours() < closingTime) {
                    // The website opens today, after opening hours
                    return new Date(now.getFullYear(), now.getMonth(), now.getDate(), closingTime, 0, 0);
                }
            }

            // Find the next valid opening day
            let nextOpeningDay = currentDay;
            while (!daysToOpen.includes(nextOpeningDay)) {
                nextOpeningDay = (nextOpeningDay + 1) % 7; // Move to the next day
            }

            return new Date(now.getFullYear(), now.getMonth(), now.getDate() + (nextOpeningDay - currentDay), openingTime, 0, 0);
        }

        function updateCountdown() {
            const nextOpeningTime = calculateNextOpening();
            const timeDifference = nextOpeningTime - new Date();

            if (timeDifference > 0) {
                const hours = Math.floor(timeDifference / (1000 * 60 * 60));
                const minutes = Math.floor((timeDifference % (1000 * 60 * 60)) / (1000 * 60));

                const countdownText = `${hours} hours ${minutes} minutes left`;
                timerElement.innerHTML = countdownText;
            } else {
                timerElement.innerHTML = "We're Open Now!";
            }
        }

        // Call the function initially and then every second
        updateCountdown();
        setInterval(updateCountdown, 1000);
    </script> -->

</body>
</html>
