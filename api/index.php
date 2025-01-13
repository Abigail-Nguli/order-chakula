<?php 
  include __DIR__ . '/../partials-front/menu.php';
?>
    <!--Food Search-->
    <section class="food-search text-center">
        <div class="container">
            
            <form action="<?php echo SITEURL; ?>food-search.php" method="POST">
                <input type="search" name="search" placeholder="Search for Food.." required class="search">
                <input type="submit" name="submit" value="Search" class="btn btn-primary">
            </form>

        </div>
    </section>

    <div id="message">
      <?php 
        if(isset($_SESSION['order']))
        {
          echo $_SESSION['order'];
          unset($_SESSION['order']);
        }
      ?>
    </div>

    <!--Categories-->
    <section class="categories">
      <div class="container">
        <h2 class="text-center">Explore Foods</h2>

        <div class="boxes">
            <?php 
              //Query to display categories from database
              $sql = "SELECT * FROM tbl_category WHERE active = 'Yes' AND featured = 'Yes' LIMIT 3";

              $res = mysqli_query($conn, $sql);

              //Count rows to check whether the category is available
              $count = mysqli_num_rows($res);

              if($count>0)
              {
                //Category is Available
                while($row = mysqli_fetch_assoc($res))
                {
                  $id = $row['id'];
                  $title = $row['title'];
                  $image_name = $row['image_name'];
                  ?>
                  <div class="box-3 box-container">
                    <a href="<?php echo SITEURL; ?>category-foods.php?category_id=<?php echo $id; ?>">
                      <?php 
                        //Is Image Available?
                        if($image_name=="")
                        {
                          echo "<div class='error'>Image Not Available</div>";
                        }
                        else{
                          ?>
                            <img
                              src="<?php echo SITEURL; ?>IMAGES/Category/<?php echo $image_name; ?>"
                              alt="Pizza"
                              class="img-responsive img-curve"
                            />
                          <?php
                        }
                      ?>
                      

                    <h3 class="box-text text-white"><?php echo $title; ?></h3>
                    </a>
                  </div>
                  <?php
                }
              }
              else{
                //Categories not available
                echo "<div class='error'>Category Not Available</div>";
              }
            ?>
        </div>
      </div>
    </section>

    <!--Food Menu-->
    <section class="food-menu">
      <div class="container">
        <h2 class="text-center">Food Menu</h2>

        <div class="menu-container">

              <?php 
              
                //Get Foods that are active and featured from database
                $sql2 = "SELECT * FROM tbl_food WHERE active = 'Yes' AND featured = 'Yes' LIMIT 6";

                $res2 = mysqli_query($conn, $sql2);

                $count2 = mysqli_num_rows($res2);

                if($count2>0)
                {
                  //Food Available
                  while($row = mysqli_fetch_assoc($res2))
                  {
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
                            <h4><?php echo $title ?></h4>
                            <p class="food-price"><?php echo $price ?></p>
                            <p class="food-detail"><?php echo $description ?></p>
                            <br />
                            <a href="<?php echo SITEURL; ?>order.php?food_id=<?php echo $id; ?>" class="btn btn-primary">Order Now</a>
                          </div>
                        </div>

                    <?php
                  }
                }
                else
                {
                  //Food Not Available 
                  echo "<div class='error'>Food Not Available</div>";
                }
              ?>
        </div>
        <div class="see-foods">
          <p class="text-center">
              <a href="<?php echo SITEURL; ?>foods.php">See All Foods</a>
          </p>
        </div>
      </div>
      
    </section>

<?php
  include('../partials-front/footer.php');
?>

<script> 
    // JavaScript to hide message after 5 seconds 
    setTimeout(function() { 
        var message = document.getElementById('message'); 
        if (message) { 
            message.style.display = 'none'; } 
        }, 5000); 
    // 5000 milliseconds = 5 seconds
</script>