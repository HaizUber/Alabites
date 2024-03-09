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
    .tbl-30 input[type="password"] {
        width: 100%;
        padding: 8px;
        border: 1px solid #ccc;
        border-radius: 4px;
        box-sizing: border-box;
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
        <h1>Add Admin</h1>

        <?php
        if (isset($_SESSION['add'])) {
            echo $_SESSION['add'];
            unset($_SESSION['add']);
        }
        ?>

<form action="" method="POST">
    <table class="tbl-30">
        <tr>
            <td>Full Name:</td>
            <td>
                <input type="text" name="full_name" placeholder="Enter Your Name">
            </td>
        </tr>
        <tr>
            <td>Username:</td>
            <td>
                <input type="text" name="username" placeholder="Your Username">
            </td>
        </tr>
        <tr>
            <td>Password:</td>
            <td>
                <input type="password" name="password" placeholder="Your Password">
            </td>
        </tr>
        <tr>
            <td>Restaurant:</td>
            <td>
                <select name="restaurant_id">
                    <option value="1">R2K</option>
                    <option value="2">Graciously</option>
                    <option value="3">Chef In Action</option>
                </select>
            </td>
        </tr>
        <tr>
            <td colspan="2">
                <input type="submit" name="submit" value="Add Admin">
            </td>
        </tr>
    </table>
</form>


<?php include('partials/footer.php'); ?>

<?php
//Process the Value from Form and Save it in Database


// Check whether the submit button is clicked or not
if (isset($_POST['submit'])) {
    $full_name = $_POST['full_name'];
    $username = $_POST['username'];
    $password = md5($_POST['password']);
    $restaurant_id = $_POST['restaurant_id'];

    $sql = "INSERT INTO tbl_admin (full_name, username, password, restaurant_id) VALUES ('$full_name', '$username', '$password', '$restaurant_id')";

    $res = mysqli_query($conn, $sql) or die(mysqli_error($conn));

    if ($res == TRUE) {
        $_SESSION['add'] = "<div class='success'>Admin Added Successfully.</div>";
        header("location:".SITEURL.'admin/manage-admin.php');
    } else {
        $_SESSION['add'] = "<div class='error'>Failed to Add Admin.</div>";
        header("location:".SITEURL.'admin/add-admin.php');
    }
}

?>
