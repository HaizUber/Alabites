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

    /* CSS styles for the table */
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

    /* Replicated animation styles for table rows */
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
        <h1>Manage Stall</h1>

        <?php 
        if (isset($_SESSION['add'])) {
            echo "<div class='message success'>" . $_SESSION['add'] . "</div>";
            unset($_SESSION['add']);
        }

        if (isset($_SESSION['remove'])) {
            echo "<div class='message success'>" . $_SESSION['remove'] . "</div>";
            unset($_SESSION['remove']);
        }

        if (isset($_SESSION['delete'])) {
            echo "<div class='message success'>" . $_SESSION['delete'] . "</div>";
            unset($_SESSION['delete']);
        }

        if (isset($_SESSION['no-category-found'])) {
            echo "<div class='message error'>" . $_SESSION['no-category-found'] . "</div>";
            unset($_SESSION['no-category-found']);
        }

        if (isset($_SESSION['update'])) {
            echo "<div class='message success'>" . $_SESSION['update'] . "</div>";
            unset($_SESSION['update']);
        }

        if (isset($_SESSION['upload'])) {
            echo "<div class='message success'>" . $_SESSION['upload'] . "</div>";
            unset($_SESSION['upload']);
        }

        if (isset($_SESSION['failed-remove'])) {
            echo "<div class='message error'>" . $_SESSION['failed-remove'] . "</div>";
            unset($_SESSION['failed-remove']);
        }
        ?>

        

        <table class="tbl-full animated-fadeIn">
            <thead>
                <tr>
                    <th>S.N.</th>
                    <th>Title</th>
                    <th>Image</th>
                    <th>Featured</th>
                    <th>Active</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql = "SELECT * FROM tbl_category WHERE id = 1";
                $res = mysqli_query($conn, $sql);
                $count = mysqli_num_rows($res);
                $sn = 1;

                if ($count > 0) {
                    while ($row = mysqli_fetch_assoc($res)) {
                        $id = $row['id'];
                        $title = $row['title'];
                        $image_name = $row['image_name'];
                        $featured = $row['featured'];
                        $active = $row['active'];
                        ?>

                        <tr>
                            <td><?php echo $sn++; ?>. </td>
                            <td><?php echo $title; ?></td>
                            <td>
                                <?php
                                if ($image_name != "") {
                                    ?>
                                    <img src="<?php echo SITEURL; ?>images/category/<?php echo $image_name; ?>" width="100px">
                                    <?php
                                } else {
                                    echo "<div class='message error'>Image not Added.</div>";
                                }
                                ?>
                            </td>
                            <td><?php echo $featured; ?></td>
                            <td><?php echo $active; ?></td>
                            <td>
                                <a href="<?php echo SITEURL; ?>admin/update-r2kcategory.php?id=<?php echo $id; ?>" class="btn-secondary">Update Stall</a>
                                
                            </td>
                        </tr>

                        <?php
                    }
                } else {
                    echo "<tr><td colspan='6'><div class='message error'>No Category Added.</div></td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</div>

<?php include('partials/footer.php'); ?>
