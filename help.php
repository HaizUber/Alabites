<?php include('partials-front/menu.php'); ?>

<!DOCTYPE html>
<html>

<head>
    <title>Policy</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f7f7f7;
            margin: 0;
            padding: 0;
        }

        .header {
            background-color: lightgray;
            color: #fff;
            padding: 20px 0;
            text-align: center;
        }

        .container {
            max-width: 800px;
            background-color: #ffffff;
            margin: 20px auto;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 5px;
            animation: fadeIn 2s; /* Animation for the entire container */
        }

        h1 {
            font-size: 24px;
            margin-bottom: 20px;
        }

        h2 {
            font-size: 20px;
            margin-top: 20px;
        }

        p {
            line-height: 1.6;
            margin-bottom: 15px;
        }

        ol {
            padding-left: 20px;
        }

        ul {
            padding-left: 20px;
        }

        .question {
            cursor: pointer;
            margin-bottom: 15px;
            padding: 10px;
            animation: fadeIn 2s; /* Animation for each question */
        }

        .terms {
            border-top: 1px solid #ddd;
            padding-top: 20px;
            animation: fadeIn 2s; /* Animation for terms section */
        }

        .video-container {
            text-align: center;
            margin: 20px 0;
            animation: fadeIn 2s; /* Animation for video section */
        }

        video {
            max-width: 45%;
            animation: fadeIn 2s; /* Animation for the video element */
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }
            to {
                opacity: 1;
            }
        }

        /* Media query for smaller screens */
@media (max-width: 768px) {
    .video-container {
        text-align: center;
    }

    video {
        max-width: 100%; /* Make the video element 100% of the container width */
    }
}
    </style>
</head>

<body>
    <div class="header">
        <div class="video-container"><br><br><br><br><br><br>
            <video controls>
                <source src="Alabites AVP.mp4" type="video/mp4">
                Your browser does not support the video tag.
            </video>
        </div>
    </div>

    <div class="container">
        <div class="question">
            <h2>How to Use Alabites?</h2>
            <ol>
                <li><strong>Order Your Meal:</strong>
                    <ul>
                        <li>Visit our website and browse through our 3 Food Concessionaires.</li>
                        <li>Select the meal of your choice and input your details accurately.</li>
                    </ul>
                </li>
                <li><strong>Stub Generated:</strong>
                    <ul>
                        <li>A unique reference number will appear after you hit Order; make sure to screenshot this.</li>
                        <li>Your unique reference number is required to verify your order.</li>
                    </ul>
                </li>
                <li><strong>Order Verification:</strong>
                    <ul>
                        <li>Once you're ready, head to the food concessionaire (R2K, Graciously, Chef In Action) you ordered from and present your Stub.</li>
                    </ul>
                </li>
                <li><strong>Collect and Enjoy Your Meal:</strong>
                    <ul>
                        <li>Thanks for using our service! Enjoy your meal.</li>
                    </ul>
                </li>
            </ol>
        </div>

        <div class="terms">
            <h2>Terms and Conditions</h2>
            <p>By using the Alabites service, you agree to the following terms and conditions:</p>
            <ol>
                <li>Your information will be stored confidentially in our database.</li>
                <li>Orders placed through the Alabites service are valid until 5 PM of the same day, concessionaires reserve the right to cancel all reserved and/or unclaimed food after this time. No refunds will be allowed.</li>
                <li>Alabites reserves the right to modify or terminate the service at any time without prior notice.</li>
                <li>You are responsible for ensuring the accuracy of your order details. Alabites is not responsible for errors in your order.</li>
                <li>Alabites does not guarantee the availability of any specific meal or concessionaire at any given time.</li>
                <li>Any disputes or concerns should be directed to Alabites customer support: <a
                        href="mailto:alabitessupport@gmail.com">alabitessupport@gmail.com</a></li>
            </ol>
        </div>
        <div id="bottom"></div>
    </div>
    <div class="container">
        <h2>Privacy Policy</h2>
        <p>Your privacy is important to us. It is our policy to respect your privacy regarding any information we may
            collect from you across our website.</p>
        <h2>Information We Collect</h2>
        <p>We only collect information about you if we have a reason to do so. For example, when you place an order, we
            collect information to process your order and provide the requested service.</p>
        <h2>How We Use Your Information</h2>
        <p>We use the information we collect in various ways, including to:</p>
        <ul>
            <li>Process orders and transactions.</li>
            <li>Provide customer support.</li>
            <li>Improve our services and customer experience.</li>
        </ul>
        <h2>Sharing Your Information</h2>
        <p>We do not share, sell, or distribute your information to third parties unless required by law.</p>
        <h2>Security</h2>
        <p>We take reasonable precautions to protect your information both online and offline.</p>
        <h2>Contact Us</h2>
        <p>If you have any questions or concerns about our Privacy Policy, please <a
            href="<?php echo SITEURL; ?>contact.php">Contact</a> us.</p>
    </div>
</body>

</html>

<?php include('partials-front/footer.php'); ?>