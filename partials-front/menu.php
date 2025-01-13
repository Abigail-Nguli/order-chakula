<?php
  include __DIR__. '/config/constants.php';
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Food Ordering Website😋</title>
    <link rel="stylesheet" href="style.css" />
    <script
      src="https://kit.fontawesome.com/a29196e54d.js"
      crossorigin="anonymous"
    ></script>
  </head>
  <body>
    <!--Navbar-->
    <section class="navbar">
      <div class="container">
        <div class="logo">
          <img src="IMAGES/logo-1.jpeg" alt="Restaurant Logo" />
        </div>
        <div class="menu">
          <ul>
                    <li>
                        <a href="<?php echo SITEURL; ?>api/index.php">Home</a>
                    </li>
                    <li>
                        <a href="<?php echo SITEURL; ?>categories.php">Categories</a>
                    </li>
                    <li>
                        <a href="<?php echo SITEURL; ?>foods.php">Foods</a>
                    </li>
                    <li>
                        <a href="#">Contact</a>
                    </li>
                    <li>
                        <a href="<?php echo SITEURL; ?>ADMIN/login.php"><i class="fa-regular fa-user menu-icon"></i></a>
                    </li>
          </ul>
        </div>
      </div>
    </section>
