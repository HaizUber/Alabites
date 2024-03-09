<?php include('partials/menur2kcons.php'); ?>

<?php 
    // Check whether id is set or not 
    if(isset($_GET['id']))
    {
        // Get all the details
        $id = $_GET['id'];

        // SQL Query to Get the Selected Food
        $sql2 = "SELECT *, Stocks FROM tbl_food WHERE id=$id";
        // execute the Query
        $res2 = mysqli_query($conn, $sql2);

        // Get the value based on the query executed
        $row2 = mysqli_fetch_assoc($res2);

        // Get the Individual Values of Selected Food
        $title = $row2['title'];
        $description = $row2['description'];
        $price = $row2['price'];
        $current_image = $row2['image_name'];
        $current_category = $row2['category_id'];
        $stocks = $row2['Stocks'];
        $sold = $row2['sold'];
        $status = $row2['status'];
    }
    else
    {
        // Redirect to Manage Food
        header('location:'.SITEURL.'admin/manage-r2kfood.php');
        exit;
    }
?>

<div class="main-content">
    <div class="wrapper">
        <h1>Update Food</h1>
        <br><br>

        <form action="" method="POST" enctype="multipart/form-data">
        
            <table class="tbl-30">

                <tr>
                    <td>Title: </td>
                    <td>
                        <input type="text" name="title" value="<?php echo $title; ?>">
                    </td>
                </tr>

                <tr>
                    <td>Description: </td>
                    <td>
                        <textarea name="description" cols="30" rows="5"><?php echo $description; ?></textarea>
                    </td>
                </tr>

                <tr>
                    <td>Price: </td>
                    <td>
                        <input type="number" name="price" value="<?php echo $price; ?>">
                    </td>
                </tr>

                <tr>
                    <td>Current Image: </td>
                    <td>
                        <?php 
                            if($current_image == "")
                            {
                                //Image not Available 
                                echo "<div class='error'>Image not Available.</div>";
                            }
                            else
                            {
                                //Image Available
                                ?>
                                <img src="<?php echo SITEURL; ?>images/<?php echo $current_image; ?>" width="150px">
                                <?php
                            }
                        ?>
                    </td>
                </tr>

                <tr>
                    <td>Select New Image: </td>
                    <td>
                        <input type="file" name="image">
                    </td>
                </tr>

                <tr>
                    <td>Category: </td>
                    <td>
                        <select name="category">
                            <?php 
                                // Query to Get Active Categories
                                $sql = "SELECT * FROM tbl_category WHERE active='Yes'";
                                // Execute the Query
                                $res = mysqli_query($conn, $sql);
                                // Check whether category is available or not
                                if (mysqli_num_rows($res) > 0) {
                                    while ($row = mysqli_fetch_assoc($res)) {
                                        $category_title = $row['title'];
                                        $category_id = $row['id'];
                                        $selected = ($current_category == $category_id) ? "selected" : "";
                                        echo "<option value='$category_id' $selected>$category_title</option>";
                                    }
                                } else {
                                    echo "<option value='0'>Category Not Available.</option>";
                                }
                            ?>
                        </select>
                    </td>
                </tr>

                <tr>
                    <td>Stocks: </td>
                    <td>
                    <input type="number" name="stocks_sold" value="<?php echo $stocks; ?>">
                    </td>
                </tr>

                <tr>
                    <td>
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="hidden" name="current_image" value="<?php echo $current_image; ?>">
                        <input type="submit" name="submit" value="Update Food" class="btn-secondary">
                    </td>
                </tr>
            
            </table>
        
        </form>

        <?php 
        
            if(isset($_POST['submit']))
            {
                $id = $_POST['id'];
                $title = $_POST['title'];
                $description = $_POST['description'];
                $price = $_POST['price'];
                $current_image = $_POST['current_image'];
                $category = $_POST['category'];
                $stocks_sold = $_POST['stocks_sold'];
            
                // Calculate "stocks" and "sold"
                $stocks = $stocks_sold; // Updated to set 'stocks' to the same value as 'stocks_sold'
                $sold = $stocks - $stocks; // Corrected logic

                // Handle image upload
                if ($_FILES['image']['name'] != '') {
                    $new_image = $_FILES['image']['name'];
                    if ($new_image != "") {
                        $source_path = $_FILES['image']['tmp_name'];
                        $destination_path = "../images/" . $new_image; // Set the appropriate path
                        $upload = move_uploaded_file($source_path, $destination_path);
                        if (!$upload) {
                            // Handle the image upload error here
                        }
                        // Update the image name in the database
                        $current_image = $new_image;
                    }
                }
            
                // Update the Food in the Database
                $sql3 = "UPDATE tbl_food SET 
                    title = '$title',
                    description = '$description',
                    price = $price,
                    image_name = '$current_image',
                    category_id = '$category',
                    stocks = $stocks,
                    status = '$status'
                    WHERE id = $id";
                
                // Execute the SQL Query
                $res3 = mysqli_query($conn, $sql3);

                // Check whether the query is executed or not 
                if($res3)
                {
                    // Query Executed and Food Updated
                    $_SESSION['update'] = "<div class='success'>Food Updated Successfully.</div>";
                    header('location:'.SITEURL.'admin/manage-r2kfood.php');
                    exit;
                }
                else
                {
                    // Failed to Update Food
                    $_SESSION['update'] = "<div class='error'>Failed to Update Food.</div>";
                    header('location:'.SITEURL.'admin/manage-r2kfood.php');
                    exit;
                }
            }
        ?>

    </div>
</div>


<?php include('partials/footer.php'); ?>

<style> 
/* Add modern styles for the form */
body {
    background-color: #f2f2f2;
    font-family: Arial, sans-serif;
}

.main-content {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    height: 100vh;
    background-color: #fff; /* Background color for main content */
    padding: 20px;
    border-radius: 5px;
    box-shadow: 0px 0px 5px rgba(0, 0, 0, 0.2);
}

h1 {
    color: #333;
}

table {
    width: 50%;
    border-collapse: collapse;
    margin-top: 20px;
}

td {
    padding: 10px;
}

input[type="text"],
input[type="number"],
select,
textarea {
    width: 100%;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 5px;
    margin-bottom: 10px;
}

input[type="submit"] {
    background-color: #007bff;
    color: #fff;
    padding: 10px 20px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    margin: 10px 0;
    align-self: center;
}

/* Add animations (you can adjust these animations as needed) */
input[type="text"],
input[type="number"],
select,
textarea,
input[type="file"],
input[type="submit"] {
    animation: fadeIn 1s ease;
}

@keyframes fadeIn {
    0% {
        opacity: 0;
        transform: translateY(10px);
    }
    100% {
        opacity: 1;
        transform: translateY(0);
    }
}

</style>
