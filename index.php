<?php include('partials-front/menu.php'); ?>
<style>
 .categories {
        margin-top: 50px;
    }

    .box-3 {
        margin-bottom: 30px;
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        transition: transform 0.3s ease-in-out;
    }

    .box-3:hover {
        transform: scale(1.05);
    }

    .box-3 img {
        width: 100%;
        height: auto; /* Let the height adjust proportionally */
        object-fit: cover;
    }

    .box-3 .float-text {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        color: #fff;
        font-size: 24px;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 1px;
        text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.6);
    }

 /* Banner styles */
.banner {
    position: relative; /* Make the banner a positioning context */
    height: 500px;
}

.banner video {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    object-fit: cover;
    z-index: -1; /* Place the video behind other elements */
}

.banner h1 {
    font-size: 36px;
    color: #fff; /* Ensure text is visible on top of the video */
}

.banner p {
    font-size: 18px;
    color: #fff; /* Ensure text is visible on top of the video */
}
.banner::before {
        content: "";
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        height: 30px; /* Adjust the height to control the feather effect size */
        background: linear-gradient(transparent, black); /* Adjust the color and transparency as needed */
        pointer-events: none;
    }


/* Update the styles for the Features Section to display in a row-like structure */
.features {
    background: #f4f4f4;
    padding: 40px 0;
}

.features .row {
    display: flex;
    justify-content: space-between;
}

.features .col-md-4 {
    flex-basis: calc(33.33% - 20px);
    padding: 0 10px;
}

.features .feature-icon {
    margin: 0 auto;
    width: 60px;
    height: 60px;
    background: #357a38;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
}

.features .feature-icon img {
    width: 100px;
    height: 100px;
}

.features h3 {
    margin-top: 20px;
    font-size: 20px;
}

/* Updated CSS for the About Stall section */
.about-stall {
    background: #f4f4f4;
    padding: 40px 0;
    text-align: center;
}

.card-container {
    display: flex;
    justify-content: space-between;
    flex-wrap: wrap; /* Allow cards to wrap to the next row if needed */
}

.card {
    flex: 1;
    width: calc(30% - 20px); /* Adjust the width as needed */
    margin: 10px;
    padding: 20px;
    background: #fff;
    border-radius: 10px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    text-align: center;
}

.card img {
    max-width: 100%;
    height: auto;
}

.card h3 {
    font-size: 18px;
    margin-top: 10px;
}

.card p {
    margin-top: 10px;
    font-size: 14px;
}
    
/* Add a common fade-in animation */
.fade-in {
    opacity: 0;
    transition: opacity 0.6s ease-in;
}

/* Apply the animation to sections with the "in-viewport" class */
.in-viewport {
    opacity: 1;
    transform: translateY(0);
    animation: fade 1s ease-in; /* Apply the fade-in animation to elements with the "in-viewport" class */
}

@keyframes fade {
    from {
        opacity: 0;
    }
    to {
        opacity: 1;
    }
}



/* CSS for the Order button */
.order-button {
    display: inline-block;
    margin-top: 20px;
    padding: 15px 30px;
    background-color: #ff6600;
    color: #fff;
    text-decoration: none;
    font-weight: bold;
    border-radius: 5px;
    transition: background-color 0.3s ease;
}

.order-button:hover {
    background-color: #ff9900;
}

/* CSS for the pulse animation */
@keyframes pulse {
    0%, 100% {
        transform: scale(1);
    }
    50% {
        transform: scale(1.2);
    }
}

.pulse {
    animation: pulse 2s infinite;
}

#categories {
    opacity: 20;
    /* You can adjust the colors and transparency (0.5) as needed */
}
</style>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const animateSections = document.querySelectorAll('.features, .categories, .about-stall');

        animateSections.forEach(function (section) {
            section.classList.add('in-viewport');
        });
    });
</script>

<?php 
    if (isset($_SESSION['order'])) {
        echo $_SESSION['order'];
        unset($_SESSION['order']);
    }
?>

<!-- Banner Section -->
<div class="banner">
    <div class="container text-center">
        <img src="images/logo.png" width="250" height="150" alt="Logo">
        <h1>Order food through Alabites</h1>
        <p>Have your R2K, CIA, Graciously Favorites quickly</p>

        <!-- Video Background -->
        <video id="video-background" autoplay muted loop>
            <!-- Fallback image for browsers that do not support video -->
            <img src="images/banner/fallback.jpg" alt="Fallback Image">
        </video>

        <!-- Add the Order button with a unique ID for styling and scrolling -->
        <a href="#categories" class="order-button" id="scrollButton">Order Now</a>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const videoSources = ['banner1.mp4', 'banner2.mp4', 'banner3.mp4', 'banner4.mp4'];
        const videoElement = document.getElementById('video-background');

        // Function to choose a random video and play it
        function playRandomVideo() {
            // Choose a random video source from the array
            const randomVideo = videoSources[Math.floor(Math.random() * videoSources.length)];

            // Set the chosen video as the source for the video element
            videoElement.src = `images/banner/${randomVideo}`;

            // Play the video
            videoElement.play();
        }

        // Play a random video initially
        playRandomVideo();

        // Add an event listener to the "ended" event of the video element
        videoElement.addEventListener('ended', playRandomVideo);
    });
</script>


<!-- Features Section -->
<section id="categories"  class="features fade-in">

</section>

<!-- Categories Section Starts Here -->
<section class="categories fade-in">
    <div class="container">
        <h2 class="text-center">Pick a Stall</h2>

        <div class="row">

            <?php 
            // Create SQL Query to Display Categories from Database
            $sql = "SELECT * FROM tbl_category WHERE active='Yes' AND featured='Yes' LIMIT 3";
            // Execute the Query
            $res = mysqli_query($conn, $sql);
            // Count rows to check whether the category is available or not
            $count = mysqli_num_rows($res);

            if ($count > 0) {
                // Categories Available
                while ($row = mysqli_fetch_assoc($res)) {
                    // Get the Values like id, title, image_name
                    $id = $row['id'];
                    $title = $row['title'];
                    $image_name = $row['image_name'];
                    ?>
                    
                    <div class="col-lg-4 col-md-6 col-sm-12">
                        <a href="<?php echo SITEURL; ?>category-foods.php?category_id=<?php echo $id; ?>">
                            <div class="box-3 float-container">
                                <?php 
                                // Check whether Image is available or not
                                if ($image_name == "") {
                                    // Display Message
                                    echo "<div class='error'>Image not Available</div>";
                                } else {
                                    // Image Available
                                    ?>
                                    <img src="<?php echo SITEURL; ?>images/category/<?php echo $image_name; ?>" alt="<?php echo $title; ?>" class="img-fluid img-curve">
                                    <?php
                                }
                                ?>
                                <h3 class="float-text text-white"><?php echo $title; ?></h3>
                            </div>
                        </a>
                    </div>

                    <?php
                }
            } else {
                // Categories not Available
                echo "<div class='error'>Category not Added.</div>";
            }
            ?>

        </div>
        <div class="clearfix"></div>
    </div>
</section>
<!-- Categories Section Ends Here -->

<!-- About Stall Section Starts Here -->
<section class="about-stall fade-in">
    <div class="container">
        <h2>About the Stalls</h2>

        <div class="card-container">
            <!-- R2K Stall -->
            <div class="card">
                <img src="images/r2kresize.jpg" alt="R2K Logo">
                <h3>R2K</h3>
                <p>R2K Stall specializes in a wide range of delicious cuisines, leaving you craving for more. Our expert chefs craft each dish with perfection to satisfy your cravings.</p>
            </div>

            <!-- CIA Stall -->
            <div class="card">
                <img src="images/cia.jpg" alt="CIA Logo">
                <h3>Chef In Action</h3>
                <p>CIA Stall is a food concession business that focuses on incorporating delicious western fusion cuisine to their meals, with multiple branches in different universities and schools. Serving delicious meals to students for an affordable price, and still providing an unlimited serving of rice.</p>
            </div>

            <!-- Graciously Stall -->
            <div class="card">
                <img src="images/Graciously.jpg" alt="Graciously Logo">
                <h3>Graciously FoodHub</h3>
                <p>Graciously Stall is a fast-paced food concession business, serving high-quality roasted food to the students of FEU Alabang.</p>
            </div>
        </div>
<!-- About Stall Section Ends Here -->



<?php include('partials-front/footer.php'); ?>

<script>
       document.getElementById('scrollButton').addEventListener('click', function (e) {
        e.preventDefault();

        // Select all elements with the class "box-3 float-container" in the "categories" section
        const boxContainers = document.querySelectorAll('.categories .box-3.float-container');

        // Apply the "pulse" class to each box container
        boxContainers.forEach(function (boxContainer) {
            boxContainer.classList.add('pulse');

            // Remove the "pulse" class after 1.5 seconds (0.5s animation x 3 pulses)
            setTimeout(function () {
                boxContainer.classList.remove('pulse');
            }, 1500); // 1500 milliseconds (1.5 seconds)
        });

        // Scroll to the categories section
        const categoriesSection = document.getElementById('categories');
        categoriesSection.scrollIntoView({ behavior: 'smooth' });
    });
    </script>
