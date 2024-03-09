<?php include('partials-front/menu.php'); ?>

<!-- Categories Section Starts Here -->
<section class="categories">
    <div class="container">
        <h2 class="text-center">Explore Foods</h2>

        <div class="row">

            <?php 
            // Display all the categories that are active
            // SQL Query
            $sql = "SELECT * FROM tbl_category WHERE active='Yes'";

            // Execute the Query
            $res = mysqli_query($conn, $sql);

            // Check whether categories available or not
            if (mysqli_num_rows($res) > 0) {
                // Categories Available
                while ($row = mysqli_fetch_assoc($res)) {
                    // Get the values
                    $id = $row['id'];
                    $title = $row['title'];
                    $image_name = $row['image_name'];
                    ?>
                    
                    <div class="col-lg-4 col-md-6 col-sm-12">
                        <a href="<?php echo SITEURL; ?>category-foods.php?category_id=<?php echo $id; ?>">
                            <div class="box-3 float-container">
                                <?php 
                                if ($image_name == "") {
                                    // Image not Available
                                    echo "<div class='error'>Image not found.</div>";
                                } else {
                                    // Image Available
                                    ?>
                                    <img src="<?php echo SITEURL; ?>images/category/<?php echo $image_name; ?>" alt="<?php echo $title; ?>" class="img-responsive img-curve">
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
                // Categories Not Available
                echo "<div class='error'>Category not found.</div>";
            }
            ?>
        </div>

        <div class="clearfix"></div>
    </div>
</section>
<!-- Categories Section Ends Here -->

<style>
    .categories {
        margin-top: 50px;
    }

    .box-3 {
        position: relative;
        overflow: hidden;
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
        height: auto;
        object-fit: cover;
        vertical-align: middle;
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
        opacity: 0;
        transition: opacity 0.3s ease-in-out;
    }

    .box-3:hover .float-text {
        opacity: 1;
    }
</style>

<?php include('partials-front/footer.php'); ?>
