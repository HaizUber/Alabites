<?php include('partials-front/menu.php'); ?>

<!-- fOOD SEARCH Section Starts Here -->
<section class="food-search text-center">
    <div class="container">
        <form action="<?php echo SITEURL; ?>food-search.php" method="POST">
            <input type="search" name="search" placeholder="Search for Food.." required>
            <input type="submit" name="submit" value="Search" class="btn btn-primary">
        </form>
    </div>
</section>
<!-- fOOD SEARCH Section Ends Here -->

<!-- fOOD MENU Section Starts Here -->
<section class="food-menu">
    <div class="container">
        <h2 class="text-center">Food Menu</h2>

        <div class="row">
            <?php 
            //Display Foods that are Active
            $sql = "SELECT * FROM tbl_food WHERE active='Yes'";

            //Execute the Query
            $res = mysqli_query($conn, $sql);

            //Count Rows
            $count = mysqli_num_rows($res);

            //Check whether the foods are available or not
            if ($count > 0) {
                //Foods Available
                while ($row = mysqli_fetch_assoc($res)) {
                    //Get the Values
                    $id = $row['id'];
                    $title = $row['title'];
                    $description = $row['description'];
                    $price = $row['price'];
                    $image_name = $row['image_name'];
                    ?>

                    <div class="col-md-4 col-sm-6">
                        <div class="food-menu-box">
                            <div class="food-menu-img">
                                <?php 
                                //Check whether image available or not
                                if ($image_name == "") {
                                    //Image not Available
                                    echo "<div class='error'>Image not Available.</div>";
                                } else {
                                    //Image Available
                                    ?>
                                    <img src="<?php echo SITEURL; ?>images/food/<?php echo $image_name; ?>" alt="Chicke Hawain Pizza" class="img-responsive img-curve">
                                    <?php
                                }
                                ?>
                            </div>

                            <div class="food-menu-desc">
                                <h4><?php echo $title; ?></h4>
                                <p class="food-price">$<?php echo $price; ?></p>
                                <p class="food-detail"><?php echo $description; ?></p>
                                <br>
                                <a href="<?php echo SITEURL; ?>order.php?food_id=<?php echo $id; ?>" class="btn btn-primary">Order Now</a>
                            </div>
                        </div>
                    </div>

                <?php
                }
            } else {
                //Food not Available
                echo "<div class='error'>Food not found.</div>";
            }
            ?>
        </div>

        <div class="clearfix"></div>
    </div>
</section>
<!-- fOOD MENU Section Ends Here -->

<?php include('partials-front/footer.php'); ?>

<style>
    /* Other styles */

    .food-menu {
        padding: 80px 0;
    }

    .food-menu h2 {
        font-size: 36px;
        margin-bottom: 30px;
        font-weight: bold;
        text-transform: uppercase;
    }

    .food-menu-box {
        background-color: #f1f1f1;
        border-radius: 10px;
        overflow: hidden;
        margin-bottom: 30px;
        box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        transition: transform 0.3s ease-in-out;
        display: flex;
        flex-direction: column;
        align-items: center;
    }

    .food-menu-box:hover {
        transform: scale(1.02);
    }

    .food-menu-img img {
        width: 100%;
        height: auto;
        object-fit: cover;
    }

    .food-menu-desc {
        padding: 30px;
    }

    .food-menu-desc h4 {
        font-size: 24px;
        margin-bottom: 15px;
        font-weight: bold;
    }

    .food-menu-desc .food-price {
        font-size: 20px;
        color: #f0880d;
        margin-bottom: 10px;
    }

    .food-menu-desc .food-detail {
        margin-bottom: 20px;
    }

    .food-menu-desc a.btn {
        display: inline-block;
        background-color: #f0880d;
        color: #fff;
        padding: 10px 30px;
        border-radius: 30px;
        transition: background-color 0.3s ease-in-out;
    }

    .food-menu-desc a.btn:hover {
        background-color: #e05204;
    }

    /* Responsive Styles */
    @media (max-width: 767px) {
        .food-menu-box {
            margin-bottom: 15px;
        }
    }
</style>
