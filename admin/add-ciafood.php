<?php
ob_start(); // Start output buffering
include('partials/menuciacons.php');

?>

<style>
    /* Style for the main content container */
    .main-content {
        background-color: #f7f7f7;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
    }

    /* Style for the form and its elements */
    form {
        max-width: 500px;
        margin: 0 auto;
    }

    .tbl-30 {
        width: 100%;
    }

    .tbl-30 td {
        padding: 10px;
    }

    .tbl-30 input[type="text"],
    .tbl-30 input[type="number"],
    .tbl-30 select,
    .tbl-30 textarea {
        width: 100%;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 5px;
        margin-bottom: 10px;
    }

    .tbl-30 input[type="file"] {
        width: 100%;
        padding: 10px;
        margin-bottom: 10px;
    }

    .tbl-30 input[type="submit"] {
        background-color: #3498db;
        color: #fff;
        border: none;
        border-radius: 5px;
        padding: 10px 20px;
        cursor: pointer;
    }

    .tbl-30 input[type="submit"]:hover {
        background-color: #258cd1;
    }

    /* Animation for the main content */
    .main-content {
        animation: fadeIn 1s ease;
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
        }
        to {
            opacity: 1;
        }
    }
</style>


<div class="main-content animated-fadeIn">
    <div class="wrapper">
        <h1>Add Food</h1>
        <br><br>

        <?php
        if (isset($_SESSION['upload'])) {
            echo $_SESSION['upload'];
            unset($_SESSION['upload']);
        }
        ?>

        <form action="" method="POST" enctype="multipart/form-data">
            <table class="tbl-30">
                <tr>
                    <td>Title:</td>
                    <td>
                        <input type="text" name="title" placeholder="Title of the Food">
                    </td>
                </tr>
                <tr>
                    <td>Description:</td>
                    <td>
                        <textarea name="description" cols="30" rows="5" placeholder="Description of the Food."></textarea>
                    </td>
                </tr>
                <tr>
                    <td>Price:</td>
                    <td>
                        <input type="number" name="price">
                    </td>
                </tr>
                <tr>
                    <td>Select Image:</td>
                    <td>
                        <input type="file" name="image">
                    </td>
                </tr>
                <tr>
                    <td>Category:</td>
                    <td>
                        <select name="category">
                            <?php
                            $sql = "SELECT * FROM tbl_category WHERE id = 3";
                            $res = mysqli_query($conn, $sql);
                            $count = mysqli_num_rows($res);

                            if ($count > 0) {
                                while ($row = mysqli_fetch_assoc($res)) {
                                    $id = $row['id'];
                                    $title = $row['title'];
                                    ?>
                                    <option value="<?php echo $id; ?>"><?php echo $title; ?></option>
                                    <?php
                                }
                            } else {
                                ?>
                                <option value="0">No Category Found</option>
                                <?php
                            }
                            ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Stocks:</td>
                    <td>
                        <input type="number" name="stocks">
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Food">
                    </td>
                </tr>
            </table>
        </form>

        <?php
        if (isset($_POST['submit'])) {
            $title = $_POST['title'];
            $description = $_POST['description'];
            $price = $_POST['price'];
            $category = $_POST['category'];
            $stocks = $_POST['stocks'];

            if (isset($_FILES['image']['name'])) {
                $image_name = $_FILES['image']['name'];

                if ($image_name != "") {
                    $image_name_parts = explode('.', $image_name);
                    $ext = end($image_name_parts);
                    $image_name = "Food_Category_" . rand(000, 999) . '.' . $ext;
                    $source_path = $_FILES['image']['tmp_name'];
                    $destination_path = "../images/" . $image_name;

                    $upload = move_uploaded_file($source_path, $destination_path);

                    if ($upload == false) {
                        $_SESSION['upload'] = "<div class='error'>Failed to Upload Image.</div>";
                        header('location:' . SITEURL . 'admin/add-ciafood.php');
                        exit();
                    }
                }
            } else {
                $image_name = "";
            }

            $sql = "INSERT INTO tbl_food (title, description, price, image_name, category_id, stocks)
                    VALUES (?, ?, ?, ?, ?, ?)";

            $stmt = mysqli_prepare($conn, $sql);
            mysqli_stmt_bind_param($stmt, 'ssdsdd', $title, $description, $price, $image_name, $category, $stocks);

            $res = mysqli_stmt_execute($stmt);

            if ($res) {
                $_SESSION['add'] = "<div class='success'>Food Added Successfully.</div>";
                header('location: manage-ciafood.php');
            } else {
                $_SESSION['add'] = "<div class='error'>Failed to Add Food.</div>";
                header('location: add-ciafood.php');
            }
        }
        ?>
    </div>
</div>

<?php include('partials/footer.php');?>
