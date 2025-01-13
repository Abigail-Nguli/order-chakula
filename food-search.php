<?php
  include __DIR__ .'./partials-front/menu.php';
?>

    <!-- Food Search -->
    <section class="food-search text-center">
        <div class="container">

        <?php
          //Get the search Keyword
          $search = $_POST['search'];
        ?>
            
            <h2>Foods on Your Search <a href="#" class="text-white">"<?php echo $search; ?>"</a></h2>


        </div>
    </section>

    <!--Food Menu-->
    <section class="food-menu">
      <div class="container">
        <h2 class="text-center">Food Menu</h2>

        <div class="menu-container">
          <?php 
            
            //Query to get food based on search
            $sql = "SELECT * FROM tbl_food WHERE title LIKE '%$search%' OR description LIKE '%$search%'";

            $res = mysqli_query($conn, $sql);

            $count = mysqli_num_rows($res);

            if($count>0)
            {
              //Food Available
              while($row = mysqli_fetch_assoc($res))
              {
                //Get the details
                $id = $row['id'];
                $title = $row['title'];
                $price = $row['price'];
                $description = $row['description'];
                $image_name = $row['image_name'];
                ?>
                    <div class="food-menu-box">
                      <div class="menu-img">
                        <?php 
                                //Is Image Available?
                                if($image_name=="")
                                {
                                  echo "<div class='error'>Image Not Available</div>";
                                }
                                else
                                {
                                  ?>
                                    <img
                                      src="<?php echo SITEURL; ?>IMAGES/Food/<?php echo $image_name; ?>"
                                      alt="Pizza"
                                      class="img-responsive img-curve"
                                    />
                                  <?php
                                }
                            ?>
                      </div>
                      <div class="menu-description">
                      <h4><?php echo $title; ?></h4>
                      <p class="food-price"><?php echo $price; ?></p>
                      <p class="food-detail"><?php echo $description; ?></p>
                      <br />
                      <a href="<?php echo SITEURL; ?>order.php" class="btn btn-primary">Order Now</a>
                      </div>
                    </div>
                <?php
              }
            }
            else
            {
              //Food Not Available
              echo "<div class='error'>Food Not Found</div>";
            }
          ?>

        </div>
      </div>
    </section>

   <?php
  include('partials-front/footer.php');
?>