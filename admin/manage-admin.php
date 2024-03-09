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

    .message {
        padding: 10px;
        margin-bottom: 20px;
        border-radius: 5px;
        font-weight: bold;
    }

    .message.success {
        background-color: #4caf50;
        color: #fff;
    }

    .message.error {
        background-color: #f44336;
        color: #fff;
    }

    .btn-primary,
    .btn-secondary,
    .btn-danger {
        display: inline-block;
        padding: 10px 20px;
        color: #fff;
        border-radius: 5px;
        text-decoration: none;
        transition: background-color 0.3s ease;
    }

    .btn-primary {
        background-color: #4caf50;
    }

    .btn-primary:hover {
        background-color: #45a049;
    }

    .btn-secondary {
        background-color: #ff9800;
    }

    .btn-secondary:hover {
        background-color: #e68a00;
    }

    .btn-danger {
        background-color: #f44336;
    }

    .btn-danger:hover {
        background-color: #d32f2f;
    }

    .tbl-full {
        width: 100%;
        margin-top: 30px;
    }

    .tbl-full th,
    .tbl-full td {
        padding: 10px;
        text-align: center;
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

    /* Responsive Styles */
    @media screen and (max-width: 768px) {
        .tbl-full th,
        .tbl-full td {
            padding: 5px;
            font-size: 14px;
        }
    }
</style>

<div class="main-content animated-fadeIn">
    <div class="wrapper">
        <h1>Manage Admin</h1>

        <?php 
        if (isset($_SESSION['add'])) {
            echo "<div class='message success'>" . $_SESSION['add'] . "</div>";
            unset($_SESSION['add']);
        }

        if (isset($_SESSION['delete'])) {
            echo "<div class='message success'>" . $_SESSION['delete'] . "</div>";
            unset($_SESSION['delete']);
        }

        if (isset($_SESSION['update'])) {
            echo "<div class='message success'>" . $_SESSION['update'] . "</div>";
            unset($_SESSION['update']);
        }

        if (isset($_SESSION['user-not-found'])) {
            echo "<div class='message error'>" . $_SESSION['user-not-found'] . "</div>";
            unset($_SESSION['user-not-found']);
        }

        if (isset($_SESSION['pwd-not-match'])) {
            echo "<div class='message error'>" . $_SESSION['pwd-not-match'] . "</div>";
            unset($_SESSION['pwd-not-match']);
        }

        if (isset($_SESSION['change-pwd'])) {
            echo "<div class='message success'>" . $_SESSION['change-pwd'] . "</div>";
            unset($_SESSION['change-pwd']);
        }
        ?>

        <a href="add-admin.php" class="btn-primary">Add Admin</a>

        <table class="tbl-full">
            <thead>
                <tr>
                    <th>S.N.</th>
                    <th>Full Name</th>
                    <th>Username</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql = "SELECT * FROM tbl_admin";
                $res = mysqli_query($conn, $sql);

                if ($res == TRUE) {
                    $count = mysqli_num_rows($res);

                    $sn = 1;
                    if ($count > 0) {
                        while ($rows = mysqli_fetch_assoc($res)) {
                            $id = $rows['id'];
                            $full_name = $rows['full_name'];
                            $username = $rows['username'];
                            $restaurant_id = $rows['restaurant_id']; // Fetch the restaurant ID
                            ?>
                            <tr>
                                <td><?php echo $sn++; ?>. </td>
                                <td><?php echo $full_name; ?></td>
                                <td><?php echo $username; ?></td>
                                <td>
                                    <a href="<?php echo SITEURL; ?>admin/update-password.php?id=<?php echo $id; ?>" class="btn-primary">Change Password</a>
                                    <a href="<?php echo SITEURL; ?>admin/update-admin.php?id=<?php echo $id; ?>" class="btn-secondary">Update Admin</a>
                                    
                                </td>
                            </tr>
                            <?php
                        }
                    } else {
                        echo "<tr><td colspan='4'>No admins found</td></tr>";
                    }
                }
                ?>
            </tbody>
        </table>
    </div>
</div>

<?php include('partials/footer.php'); ?>
