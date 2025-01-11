<?php
  include('partials-front/menu.php');
?>

    <?php 
        //Check Whether id is passed or not
        if(isset($_GET['category_id']))
        {
          //Category id is set and get the id
          $category_id = $_GET['category_id'];
          //Get the category title based on category id
          $sql = "SELECT title FROM tbl_category WHERE id = '$category_id'";
          //Create the query
          $res = mysqli_query($conn, $sql);
          //Get value from database
          $row = mysqli_fetch_assoc($res);
          //Get the title
          $category_title = $row['title'];
        }
        else
        {
          //Redirect to home page
          header("location:".SITEURL);
        }
    ?>

    <!-- Food Search  -->
    <section class="food-search text-center">
      <div class="container">
        <h2>Foods on <a href="#" class="text-white">"<?php echo $category_title; ?>"</a></h2>
      </div>
    </section>

    <!--Food Menu-->
    <section class="food-menu">
      <div class="container">
        <h2 class="text-center">Food Menu</h2>

        <div class="menu-container">

        <?php
          //Query to get food based on selected category
          $sql2 = "SELECT * FROM tbl_food WHERE category_id = '$category_id'";
          
          $res2 = mysqli_query($conn, $sql2);

          $count = mysqli_num_rows($res2);

          //Is food available?
          if($count>0)
          {
            //Food is available
            while($row2=mysqli_fetch_assoc($res2))
            {
              $id = $row2['id'];
              $title = $row2['title'];
              $price = $row2['price'];
              $description = $row2['description'];
              $image_name = $row2['image_name'];
              ?>
                <div class="food-menu-box">
                  <div class="menu-img">
                    <?php 
                        //Is Image Available?
                        if($image_name=="")
                        {
                          echo "<div class='error'>Image Not Available</div>";
                        }
                        else{
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
            //Food is not available
            echo "<div class='error'>Food Not Available</div>";
          }
        ?>

        </div>
      </div>
    </section>

   <?php
  include('partials-front/footer.php');
?>