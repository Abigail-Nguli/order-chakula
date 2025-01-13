 <?php 
    include('../config/constants.php');
    include('login-check.php');
 ?>


<html>
    <head>
        <title>Food Ordering Website😋 - Admin Panel</title>
        <link rel="stylesheet" href="../admin.css">
        <script src="https://kit.fontawesome.com/a29196e54d.js" crossorigin="anonymous"></script>
    </head>
    <body>
        <!--Menu-->
        <div class="menu">
            <div class="wrapper">
                <ul>
                    <li>
                        <a href="api/index.php">Home</a>
                    </li>
                    <li>
                        <a href="manage-admin.php">Admin</a>
                    </li>
                    <li>
                        <a href="manage-category.php">Category</a>
                    </li>
                    <li>
                        <a href="manage-food.php">Food</a>
                    </li>
                    <li>
                        <a href="manage-order.php">Order</a>
                    </li>
                    <li>
                        <a href="logout.php">Log Out</a>
                    </li>
                </ul>
            </div>
        </div>


       