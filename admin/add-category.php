<?php include('partials/menu.php'); ?>

<style>
    .main-content {
        padding: 20px;
        background-color: #f7f7f7;
    }

    .main-content h1 {
        font-size: 24px;
        margin-bottom: 20px;
    }

    .tbl-30 {
        width: 30%;
        margin: auto;
        border-collapse: collapse;
    }

    .tbl-30 td {
        padding: 10px;
    }

    .tbl-30 input[type="text"],
    .tbl-30 input[type="file"] {
        width: 100%;
        padding: 8px;
        border: 1px solid #ccc;
        border-radius: 4px;
        box-sizing: border-box;
    }

    .tbl-30 input[type="radio"] {
        margin-right: 10px;
    }

    .tbl-30 input[type="submit"] {
        width: auto;
        padding: 10px 20px;
        background-color: #4caf50;
        color: #fff;
        border: none;
        border-radius: 4px;
        cursor: pointer;
    }

    .tbl-30 input[type="submit"]:hover {
        background-color: #45a049;
    }

    /* Animation */
    @keyframes fadeIn {
        0% {
            opacity: 0;
        }
        100% {
            opacity: 1;
        }
    }

    .animated-fadeIn {
        animation: fadeIn 0.5s ease;
    }

    .success {
        color: #155724;
        background-color: #d4edda;
        border-color: #c3e6cb;
        padding: 10px;
        margin-bottom: 10px;
        border-radius: 4px;
    }

    .error {
        color: #721c24;
        background-color: #f8d7da;
        border-color: #f5c6cb;
        padding: 10px;
        margin-bottom: 10px;
        border-radius: 4px;
    }
</style>

<div class="main-content animated-fadeIn">
    <div class="wrapper">
        <h1>Add Category</h1>

        <?php 
        if(isset($_SESSION['add'])){
            echo $_SESSION['add'];
            unset($_SESSION['add']);
        }

        if(isset($_SESSION['upload'])){
            echo $_SESSION['upload'];
            unset($_SESSION['upload']);
        }
        ?>

        <form action="" method="POST" enctype="multipart/form-data">
            <table class="tbl-30">
                <tr>
                    <td>Title:</td>
                    <td>
                        <input type="text" name="title" placeholder="Category Title">
                    </td>
                </tr>
                <tr>
                    <td>Select Image:</td>
                    <td>
                        <input type="file" name="image">
                    </td>
                </tr>
                <tr>
                    <td>Featured:</td>
                    <td>
                        <input type="radio" name="featured" value="Yes"> Yes 
                        <input type="radio" name="featured" value="No"> No 
                    </td>
                </tr>
                <tr>
                    <td>Active:</td>
                    <td>
                        <input type="radio" name="active" value="Yes"> Yes 
                        <input type="radio" name="active" value="No"> No 
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Category">
                    </td>
                </tr>
            </table>
        </form>

        <?php 
        if(isset($_POST['submit'])){
            $title = $_POST['title'];

            if(isset($_POST['featured'])){
                $featured = $_POST['featured'];
            }else{
                $featured = "No";
            }

            if(isset($_POST['active'])){
                $active = $_POST['active'];
            }else{
                $active = "No";
            }

            if(isset($_FILES['image']['name'])){
                $image_name = $_FILES['image']['name'];

                if($image_name != ""){
                    $ext = end(explode('.', $image_name));
                    $image_name = "Food_Category_".rand(000, 999).'.'.$ext;
                    $source_path = $_FILES['image']['tmp_name'];
                    $destination_path = "../images/category/".$image_name;

                    $upload = move_uploaded_file($source_path, $destination_path);

                    if($upload == false){
                        $_SESSION['upload'] = "<div class='error'>Failed to Upload Image.</div>";
                        header('location:'.SITEURL.'admin/add-category.php');
                        die();
                    }
                }
            }else{
                $image_name = "";
            }

            $sql = "INSERT INTO tbl_category SET 
                title='$title',
                image_name='$image_name',
                featured='$featured',
                active='$active'
            ";

            $res = mysqli_query($conn, $sql);

            if($res == true){
                $_SESSION['add'] = "<div class='success'>Category Added Successfully.</div>";
                header('location:'.SITEURL.'admin/manage-category.php');
            }else{
                $_SESSION['add'] = "<div class='error'>Failed to Add Category.</div>";
                header('location:'.SITEURL.'admin/add-category.php');
            }
        }
        ?>

    </div>
</div>

<?php include('partials/footer.php'); ?>
