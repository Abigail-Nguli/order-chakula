<?php
  include __DIR__ .'./partials-front/menu.php';
?>

    <!-- Categories -->
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

   <?php
  include __DIR__ .'./partials-front/footer.php';
?>