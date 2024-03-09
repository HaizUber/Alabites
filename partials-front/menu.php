<?php include('config/constants.php'); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <!-- Important to make the website responsive -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alabites Website</title>

    <!-- Link your CSS file -->
    <link rel="stylesheet" href="css/style.css">

    <style>
        .navbar {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            background: transparent;
            transition: background 0.3s;
            z-index: 1000;
        }

        .navbar.scrolled {
            background: white;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .mobile-menu {
        display: none; /* Hide the mobile menu by default */
    }

    .mobile-menu-icon {
        display: none; /* Hide the mobile menu icon by default on larger screens */
        cursor: pointer;
    }

    @media (max-width: 768px) {
        .logo{
            display:none;
        }
        .mobile-menu {
        display: none; /* Hide the mobile menu by default */
        position: absolute;
        top: 60px;
        right: 0;
        background: white;
        width: 100%;
        transition: transform 0.3s ease-in-out;
        transform: translateY(-100%);
        z-index: 1000;
    }

    .mobile-menu.show {
        transform: translateY(0);
    }

    .mobile-menu ul {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .mobile-menu li {
        padding: 10px 0;
        text-align: center;
    }

    .mobile-menu a {
        color: #333;
        text-decoration: none;
    }
    .btn-download-app {
                display: none;
            }
}
        
    </style>
<script>
    var mobileMenuIcon = document.querySelector(".mobile-menu-icon");
    var mobileMenu = document.querySelector(".mobile-menu");

    mobileMenuIcon.addEventListener("click", function () {
        if (mobileMenu.classList.contains("show")) {
            mobileMenu.classList.remove("show");
        } else {
            mobileMenu.classList.add("show");
        }
    });
</script>

    <script>
        window.addEventListener("scroll", function () {
            var navbar = document.querySelector(".navbar");
            if (window.scrollY > 0) {
                navbar.classList.add("scrolled");
            } else {
                navbar.classList.remove("scrolled");
            }
        });
    </script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

</head>

<body>
   <!-- Navbar Section Starts Here -->
<section class="navbar">
    <div class="container">
        <div class="logo">
            <a href="#" title="Logo">
                <img src="images/logo.png" alt="Restaurant Logo" class="img-responsive">
            </a>
        </div>

        <div class="menu text-right">
            <ul class="desktop-menu">
                <li>
                    <a href="<?php echo SITEURL; ?>index.php">Home</a>
                </li>
                <li>
                    <a href="<?php echo SITEURL; ?>contact.php">Contact</a>
                </li>
                <li>
                    <a href="<?php echo SITEURL; ?>help.php">Help</a>
                </li>
                <li>
                    <a href="<?php echo SITEURL; ?>admin/login.php">Admin</a>
                </li>
                <li>
                <a href="alabites.apk" download>
            <button class="btn-download-app" style = "     
        background-color: green; 
        color: #fff; 
        padding: 10px 20px; 
        border: none;
        border-radius: 5px;
        cursor: pointer;
        font-size: 16px;">Download App</button>
                </li>
            </ul>
            <!-- Mobile menu icon (burger menu) -->
            <div class="mobile-menu-icon">
            <i class="fas fa-bars"></i>
            </div>

            <!-- Mobile menu (hidden by default) -->
            <ul class="mobile-menu">
                <li>
                    <a href="<?php echo SITEURL; ?>index.php">Home</a>
                </li>
                <li>
                    <a href="<?php echo SITEURL; ?>contact.php">Contact</a>
                </li>
                <li>
                    <a href="<?php echo SITEURL; ?>help.php">Help</a>
                </li>
                <li>
                    <a href="<?php echo SITEURL; ?>admin/login.php">Admin</a>
                </li>
            </ul>
        </div>

        <div class="clearfix"></div>
    </div>
</section>
<!-- Navbar Section Ends Here -->
    
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="js/script.js"></script>
    <script>
    document.querySelector(".mobile-menu-icon").addEventListener("click", function () {
        var mobileMenu = document.querySelector(".mobile-menu");
        mobileMenu.style.display = (mobileMenu.style.display === "block" ? "none" : "block");
    });
</script>

</body>
</html>

