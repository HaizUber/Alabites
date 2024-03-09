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

.col-4{
    width: 25%;
    background-color: white;
    margin: 1%;
    padding: 2%;
    float: left;
}

    .col-4:hover {
        background-color: #f2f2f2;
    }

    .col-4 h1 {
        font-size: 48px;
        margin-bottom: 10px;
        color: #333;
    }

    .col-4 p {
        font-size: 18px;
        color: #777;
    }

    .clearfix {
        clear: both;
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
</style>

<div class="main-content animated-fadeIn">
    <div class="wrapper">
        <h1>Dashboard</h1>

        <?php
        if (isset($_SESSION['login'])) {
            echo "<p>" . $_SESSION['login'] . "</p>";
            unset($_SESSION['login']);
        }
        ?>

        <div class="col-4">
            <?php
            $sql = "SELECT * FROM tbl_category";
            $res = mysqli_query($conn, $sql);
            $count = mysqli_num_rows($res);
            ?>
            <h1><?php echo $count; ?></h1>
            <p>Stalls</p>
        </div>

        <div class="col-4">
            <?php
            $sql2 = "SELECT * FROM tbl_food";
            $res2 = mysqli_query($conn, $sql2);
            $count2 = mysqli_num_rows($res2);
            ?>
            <h1><?php echo $count2; ?></h1>
            <p>Foods</p>
        </div>

        <div class="col-4">
            <?php
            $sql3 = "SELECT * FROM tbl_order";
            $res3 = mysqli_query($conn, $sql3);
            $count3 = mysqli_num_rows($res3);
            ?>
            <h1><?php echo $count3; ?></h1>
            <p>Total Orders</p>
        </div>

        <div class="clearfix"></div>
    </div>
</div>

<?php include('partials/footer.php') ?>
