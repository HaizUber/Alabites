<?php
// Check if the website is closed based on time
$timezone = new DateTimeZone('Asia/Manila');
$currentDateTime = new DateTime(null, $timezone);
$startTime = '07:00:00'; // 7am (07:00:00)
$endTime = '17:00:00'; // 5pm (17:00:00)

$currentTime = $currentDateTime->format('H:i:s'); // Get the current time in 'H:i:s' format

$websiteClosed = ($currentTime < $startTime || $currentTime >= $endTime);

if ($websiteClosed) {
    // Redirect to alabitesclosed.php
    header('Location: alabitesclosed.php');
    exit(); // Ensure the script stops executing after the redirect
} else {
    // Website is open, display regular content
    include('partials-front/menu.php');
}
?>


<?php 
    if(isset($_GET['category_id']))
    {
        $category_id = $_GET['category_id'];
        $sql = "SELECT title FROM tbl_category WHERE id=$category_id";
        $res = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($res);
        $category_title = $row['title'];
    }
    else if(isset($_POST['search']))
    {
        $search = mysqli_real_escape_string($conn, $_POST['search']);
        $category_title = "Your Search: \"$search\"";
    }
    else
    {
        // Handle the case where no category_id is set. You may want to redirect or show an error message.
    }
?>
<section class="food-search text-center">
    <div class="container">
       <?php
        // Check the value of $restaurant_id and display the corresponding image or text
        if ($category_id == 1) {
            echo '<img src="r2k.jpg" alt="R2K" class="img-responsive img-curve" style="max-width: 40%">';
        } elseif ($category_id == 2) {
            echo '<img src="Graciously.jpg" alt="Graciously" class="img-responsive img-curve" style="max-width: 40%">';
        } elseif ($category_id == 3) {
            echo '<img src="cia.jpg" alt="Graciously" class="img-responsive img-curve" style="max-width: 40%">';
        } else {
            // Default text when $restaurant_id doesn't match any of the conditions
            echo 'No Image Available';
        }
        ?>
        <form action="<?php echo SITEURL; ?>food-search.php" method="POST">
            <input type="search" name="search" id="food-search-input" placeholder="Search for Food.." required>
            
        </form>
        <div id="food-search-results"></div>
    </div>
</section>

<section class="food-menu">
    <div class="container">
        <h2 class="text-center">Food Menu</h2>

        <div id="animation-container">
            <div id="food-menu-container"> <!-- Container for food menu -->
            <?php
            // Display all food items initially
            $search = isset($_POST['search']) ? mysqli_real_escape_string($conn, $_POST['search']) : '';
            $sql2 = "SELECT * FROM tbl_food WHERE category_id=$category_id AND (stocks > 0 OR title LIKE '%$search%')";
            $res2 = mysqli_query($conn, $sql2);
            $count2 = mysqli_num_rows($res2);

            if ($count2 > 0) {
                while ($row2 = mysqli_fetch_assoc($res2)) {
                    $id = $row2['id'];
                    $title = $row2['title'];
                    $price = $row2['price'];
                    $description = $row2['description'];
                    $image_name = $row2['image_name'];
                    $stocks = $row2['Stocks'];

                    $isAvailable = $stocks > 0;
                    ?>

                    <div class="food-menu-box <?php echo $isAvailable ? '' : 'unavailable'; ?>">
                        <div class="food-menu-img">
                            <?php
                            if ($image_name == "") {
                                echo "<div class='error'>Image not Available.</div>";
                            } else {
                                ?>
                                <img src="<?php echo SITEURL; ?>images/<?php echo $image_name; ?>"
                                    alt="<?php echo $title; ?>" class="img-responsive img-curve">
                                <?php
                            }
                            ?>
                        </div>

                        <div class="food-menu-desc">
                            <h4><?php echo $title; ?></h4>
                            <p class="food-price">₱<?php echo $price; ?></p>
                            <p class="food-detail">
                                <?php echo $description; ?>
                            </p>
                            <br>

                            <?php if ($isAvailable) { ?>
                                <a href="<?php echo SITEURL; ?>order.php?food_id=<?php echo $id; ?>" class="btn btn-primary">Order Now</a>
                            <?php } else { ?>
                                <span class="unavailable-label">Not Available</span>
                            <?php } ?>
                        </div>
                    </div>
                    <?php
                }
            } else {
                echo "<div class='error'>Food not found.</div>";
            }
            ?>
        </div>
        <div class="clearfix"></div>
    </div>
</section>
<style>
/* Define styles for food menu boxes */
.food-menu-box {
    width: 100%; /* Full width for all screens */
    height: auto; /* Allow variable card height based on content */
    display: flex; /* Use flexbox for layout */
    flex-wrap: wrap; /* Allow content to wrap to the next row on smaller screens */
    border: 1px solid #ddd;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    transition: transform 0.3s ease-in-out; /* Add animation to card on hover */
    
}

/* Style for food-menu-img to cover the top portion */
.food-menu-img {
    flex: 1; /* Adjust the proportion between image and description */
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
    transition: transform 0.3s ease-in-out; /* Add animation to the image on hover */
}

.food-menu-img img {
    width: 100%;
    height: 100%;
}

/* Style for food-menu-desc on the bottom portion */
.food-menu-desc {
    flex: 2; /* Adjust the proportion between image and description */
    padding: 10px;
}

/* Styles for food title and details */
.food-title {
    font-size: 18px;
    font-weight: bold;
    margin-bottom: 5px;
}

.food-details {
    font-size: 16px;
}

/* Styles for h4 tags */
.food-menu-box h4 {
    font-size: 20px; /* Increase the font size for h4 tags */
    font-weight: bold;
    margin-bottom: 5px;
}

/* Styles for food price */
.food-menu-box p.food-price {
    font-size: 16px; /* Increase the font size for food price */
}

/* Styles for food details */
.food-menu-box p.food-details {
    font-size: 14px; /* Increase the font size for food details */
}
/* Add hover animation for cards */
.food-menu-box:hover {
    transform: scale(1.05); /* Scale up the card on hover */
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2); /* Add a subtle shadow on hover */
}

/* Add hover animation for the image */
.food-menu-img:hover {
    transform: scale(1.1); /* Scale up the image on hover */
}

/* Define styles for unavailable items */
.unavailable {
    filter: grayscale(100%); /* Gray out the image */
    position: relative;
}

.unavailable .unavailable-label {
    background: rgba(0, 0, 0, 0.7); /* Semi-transparent background for label */
    color: white;
    padding: 5px;
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    border-radius: 5px;
    pointer-events: none; /* Prevent interactions with the label */
}

/* Media query for larger screens (e.g., screens wider than 768px) */
@media (min-width: 769px) {
    /* Styles for h4 tags */
    .food-menu-box h4 {
        font-size: 50px; /* Increase the font size for h4 tags */
        font-weight: bold;
        margin-bottom: 5px;
    }

    /* Styles for food price */
    .food-menu-box p.food-price {
        font-size: 36px; /* Increase the font size for food price */
    }

    /* Styles for food details */
    .food-menu-box p.food-detail {
        font-size: 35px; /* Increase the font size for food details */
    }
/* Style for primary buttons */
.food-menu-box a.btn.btn-primary {
        font-size: 18px; /* Increase the font size for the button text */
        padding: 12px 20px; /* Increase padding for the button */
        margin-top: 10px;
        transition: transform 0.2s ease, background-color 0.3s ease; /* Add smooth transition for hover animation */
    }

    /* Add hover animation for the button */
    .food-menu-box a.btn.btn-primary:hover {
        background-color: #005000; /* Change the background color to a darker shade of green */
        transform: scale(1.1); /* Scale up the button on hover */
    }

}


/* Media query for small screens (e.g., screens up to 768px wide) */
@media (max-width: 768px) {
        /* Styles for food details on smaller screens */
.food-menu-box p.food-detail {
    font-size: 14px; /* Increase the font size for food details on smaller screens */
    text-overflow: ellipsis; /* Add an ellipsis (...) to indicate truncated text */
    max-height: 3em; /* Limit the maximum height to 3 lines of text */
    line-height: 1em; /* Set line height to 1em for proper text display */
    
}
    .food-menu-box {
        padding: 10px; /* Add spacing around the content for smaller screens */
    }

    .food-title {
        font-size: 14px;
    }

    .food-details {
        font-size: 12px;
    }
}

/* Additional Media Query for very small screens (e.g., screens up to 480px wide) */
@media (max-width: 480px) {
    .food-menu-box {
        padding: 5px; /* Further reduce spacing on very small screens */
    }

    .food-title {
        font-size: 12px;
    }

    .food-details {
        font-size: 10px;
    }

    .food-menu-box a.btn {
        font-size: 12px;
    }
}
</style>

<script>
    const searchInput = document.getElementById('food-search-input');
    const foodMenuContainer = document.getElementById('food-menu-container');

    searchInput.addEventListener('input', function () {
        const searchText = this.value.trim();
        const category_id = <?php echo $category_id; ?>;

        // Check if there is a search text
        if (searchText !== '') {
            const xhr = new XMLHttpRequest();
            xhr.open('POST', 'filter-food.php', true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.onreadystatechange = function () {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    foodMenuContainer.innerHTML = xhr.responseText;
                }
            };
            xhr.send('search=' + searchText + '&category_id=' + category_id);
        } else {
            // Display all food items when the search input is empty
            const xhr = new XMLHttpRequest();
            xhr.open('POST', 'filter-food.php', true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.onreadystatechange = function () {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    foodMenuContainer.innerHTML = xhr.responseText;
                }
            };
            xhr.send('search=&category_id=' + category_id);
        }
    });

</script>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const animationContainer = document.getElementById('animation-container');
        animationContainer.style.opacity = '1';
    });
</script>


<?php include('partials-front/footer.php'); ?>
