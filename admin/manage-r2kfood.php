<?php include('partials/menur2kcons.php'); ?>

<style>
        .btn-primary {
    background-color: green;
    color: #fff;
    border: none;
    border-radius: 5px;
    text-decoration: none;
    padding: 10px 20px;
    transition: background-color 0.3s ease;
    margin-right: 10px;
}

.btn-primary:hover {
    background-color: #74b72e;
}
/* Added CSS styles for table */
    .tbl-full {
        width: 100%;
        margin-top: 20px;
        border-collapse: collapse;
    }

    .tbl-full thead tr th,
    .tbl-full tbody tr td {
        padding: 10px;
        text-align: center;
    }

    .tbl-full thead tr th {
        background-color: #f5f5f5;
        border-bottom: 1px solid #ddd;
        font-size: 14px;
    }

    .tbl-full tbody tr td {
        border-bottom: 1px solid #f5f5f5;
        font-size: 16px;
    }

    .tbl-full tbody tr:last-child td {
        border-bottom: none;
    }

    @keyframes fadeIn {
        0% {
            opacity: 0;
        }
        100% {
            opacity: 1;
        }
    }

    /* Updated styles for the update order button and status labels */
    .btn-secondary {
        display: inline-block;
        padding: 8px 15px;
        background-color: #4caf50;
        color: #fff;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    .btn-secondary:hover {
        background-color: #45a049;
    }
    .btn-danger {
        background-color: #f44336;
    }

    .btn-danger:hover {
        background-color: #d32f2f;
    }

    .btn-danger {
        display: inline-block;
        padding: 10px 20px;
        color: #fff;
        border-radius: 5px;
        text-decoration: none;
        transition: background-color 0.3s ease;
    }

@media only screen and (max-width: 767px) {
    .btn-secondary,
    .btn-danger {
        padding: 8px 12px;
        font-size: 14px;
    }
    .tbl-full {
        margin-top: 10px;
    }

    .tbl-full thead tr th {
        font-size: 12px;
    }

    .tbl-full tbody tr td {
        font-size: 14px;
    }
}

@keyframes entry-pop-out {
    0% {
        transform: scale(0);
    }
    100% {
        transform: scale(1);
    }
}

.tbl-full tbody tr {
    animation: entry-pop-out 0.5s ease both; /* Apply animation to table rows */
}
</style>

<div class="main-content">
    <div class="wrapper">
        <h1>Manage Food</h1><br>

        <!-- Add Food button -->
        <div class="btn-container">
            <a href="<?php echo SITEURL; ?>admin/add-r2kfood.php" class="btn-secondary">Add Food</a>
        </div>

        <!-- Display messages -->
        <?php 
        if (isset($_SESSION['add'])) {
            echo "<div class='message success'>" . $_SESSION['add'] . "</div>";
            unset($_SESSION['add']);
        }
        if (isset($_SESSION['delete'])) {
            echo "<div class='message success'>" . $_SESSION['delete'] . "</div>";
            unset($_SESSION['delete']);
        }
        if (isset($_SESSION['upload'])) {
            echo "<div class='message success'>" . $_SESSION['upload'] . "</div>";
            unset($_SESSION['upload']);
        }
        if (isset($_SESSION['unauthorize'])) {
            echo "<div class='message error'>" . $_SESSION['unauthorize'] . "</div>";
            unset($_SESSION['unauthorize']);
        }
        if (isset($_SESSION['update'])) {
            echo "<div class='message success'>" . $_SESSION['update'] . "</div>";
            unset($_SESSION['update']);
        }
        ?>

        <!-- Food data table -->
        <table class="tbl-full">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Title</th>
                    <th>Price</th>
                    <th>Image</th>
                    <th>Category</th>
                    <th>Actions</th>
                    <th>Available Stocks</th>
                    <th>Sold</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sn = 1; // Initialize the row number
                $sql = "SELECT * FROM tbl_food WHERE category_id = 1";
                $res = mysqli_query($conn, $sql);
                if ($res) {
                    while ($row = mysqli_fetch_assoc($res)) {
                        $id = $row['id'];
                        $title = $row['title'];
                        $price = $row['price'];
                        $image_name = $row['image_name'];
                        $category_id = $row['category_id'];
                        $stocks = $row['stocks_sold'];
                        $Stocks = $row['Stocks'];
                        $sold = $row['sold'];

                        // Display the image correctly using the file path
                        $image_path = SITEURL . "images/" . $image_name;
                        ?>

                        <tr>
                            <td><?php echo $sn++; ?></td>
                            <td><?php echo $title; ?></td>
                            <td>₱<?php echo $price; ?></td>
                            <td><img src="<?php echo $image_path; ?>" alt="<?php echo $title; ?>" width="100px"></td>
                            <td>
                                <?php
                                // Fetch the category title
                                $sql2 = "SELECT title FROM tbl_category WHERE id = $category_id";
                                $res2 = mysqli_query($conn, $sql2);
                                if ($res2) {
                                    $row2 = mysqli_fetch_assoc($res2);
                                    echo $row2['title'];
                                } else {
                                    echo "Category not found";
                                }
                                ?>
                            </td>
                            <td>
                                <a href="<?php echo SITEURL; ?>admin/update-r2kfood.php?id=<?php echo $id; ?>" class="btn-secondary">Update Food</a>
                                <a href="<?php echo SITEURL; ?>admin/delete-r2kfood.php?id=<?php echo $id; ?>&image_name=<?php echo $image_name; ?>" class="btn-danger">Delete Food</a>
                            </td>
                            <td><?php echo $Stocks; ?></td>
                            <td><?php echo $sold; ?></td>
                        </tr>
                    <?php
                    }
                } else {
                    echo "<tr><td colspan='10' class='error'>Food not available.</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</div>

<?php include('partials/footer.php'); ?>
