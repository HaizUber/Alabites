<style>
    /* Add this CSS to your stylesheet */
.food-menu-box.grayscale .food-menu-img img {
    filter: grayscale(100%); /* Apply grayscale filter to the image */
}

.food-menu-box.grayscale .food-menu-desc a.btn {
    background: #ccc; /* Change button background color to gray */
    cursor: not-allowed; /* Change cursor to not-allowed */
    pointer-events: none; /* Prevent interactions with the button */
}

.unavailable-label {
    background: rgba(0, 0, 0, 0.7);
    color: white;
    padding: 5px;
    border-radius: 5px;
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    pointer-events: none;
}

.animated-item {
    opacity: 0;
    transform: translateY(20px);
    animation: fadeInUp 0.5s forwards ease-out;
}

@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}


    </style>

<?php
include('config/constants.php');

$search = isset($_POST['search']) ? mysqli_real_escape_string($conn, $_POST['search']) : '';
$category_id = isset($_POST['category_id']) ? $_POST['category_id'] : '';

// SQL Query to filter results by search and category_id
$sql = "SELECT * FROM tbl_food WHERE category_id = $category_id AND (title LIKE '%$search%' OR description LIKE '%$search%')";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $id = $row['id'];
        $title = $row['title'];
        $price = $row['price'];
        $description = $row['description'];
        $image_name = $row['image_name'];
        $stocks = $row['Stocks'];

        $isAvailable = $stocks > 0;
        $isGrayscale = $stocks <= 0;
        ?>

        <div class="food-menu-box <?php echo $isGrayscale ? 'grayscale' : ''; ?> animated-item">
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

                <?php if ($isGrayscale) { ?>
                    <span class="unavailable-label">Not Available</span>
                    
                <?php } else { ?>
                    <?php if ($isAvailable) { ?>
                        <a href="<?php echo SITEURL; ?>order.php?food_id=<?php echo $id; ?>" class="btn btn-primary">Order Now</a>
                    <?php } else { ?>
                        
                    <?php } ?>
                <?php } ?>
            </div>
        </div>
        <?php
    }
} else {
    echo "<div class='error'>No matching food items found.</div>";
}
?>

