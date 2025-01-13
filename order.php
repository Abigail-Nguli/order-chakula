<?php
  include __DIR__ .'./partials-front/menu.php';
?>

    <?php 
        //Check whether food id id set
        if(isset($_GET['food_id']))
        {
            //Get food id and details of selected food
            $food_id = $_GET['food_id'];

            $sql = "SELECT * FROM tbl_food WHERE id = '$food_id'";

            $res = mysqli_query($conn, $sql);

            $count = mysqli_num_rows($res);

            if($count == 1)
            {
                //We have data
                $row = mysqli_fetch_assoc($res);

                $title = $row['title'];
                $price = $row['price'];
                $description = $row['description'];
                $image_name = $row['image_name'];
            }
            else
            {
                //Food not available
                header("location:".SITEURL);
            }
        }
        else
        {
            //redirect to home page
            header("location:".SITEURL);
        }
    ?>

    <!-- Food Search -->
    <section class="food-search">
        <h2 class="text-center text-white">Fill this form to confirm your order.</h2>
        <div class="order-container">

            <form action="#" method="POST" class="order">
                <fieldset>
                    <legend>Selected Food</legend>

                    <div class="selected-food">
                        <div class="menu-img">
                        <?php 
                            //Is image available?
                            if($image_name==""){
                                //Image not available
                                echo "<div class='error'>Image Not Available</div>";
                            }
                            else
                            {
                                //Image available
                                ?>
                                
                                <img src="<?php echo SITEURL; ?>IMAGES/Food/<?php echo $image_name ?>" alt="BBQ Chicken Pizza" class="img-responsive img-curve">

                                <?php
                            }
                        ?>
                        
                    </div>
    
                    <div class="input-box menu-description">
                        <h3 class="food-order"><?php echo $title; ?></h3>
                        <input type="hidden" name="food" value="<?php echo $title; ?>">
                        
                        <p class="food-order">KES <?php echo $price; ?></p>
                        <input type="hidden" name="price" value="<?php echo $price; ?>">

                        <p class="food-order qty">Quantity</p>
                        <input type="number" name="qty" class="input-responsive" value="1" required>
                        
                    </div>
                    </div>

                </fieldset>
                
                <fieldset>
                    <legend>Delivery Details</legend>
                    <div class="input-box">
                        
                    <div class="order-label">Full Name</div>
                    <input type="text" name="full-name" placeholder="E.g. Abigail Nguli"required>

                    <div class="order-label">Phone Number</div>
                    <input type="tel" name="contact" placeholder="E.g. +254 7xxxxxx"required>

                    <div class="order-label">Email</div>
                    <input type="email" name="email" placeholder="E.g. nguli@gmail.com" required>

                    <div class="order-label">Address</div>
                    <textarea name="address" rows="10" placeholder="E.g. Town, County" required></textarea>

                    </div>
                    <input type="submit" name="submit" value="Confirm Order" class="order-btn">
                </fieldset>

            </form>

            <?php 
                //Chech whether submit button is clicked
                if(isset($_POST['submit']))
                {
                    //Get all the details from form
                    $food = $_POST['food'];
                    $price = $_POST['price'];
                    $qty = $_POST['qty'];
                    $total = $price * $qty;

                    $order_date = date("Y-m-d h:i:sa");//Order Date $ Time

                    $status = "Ordered"; //Ordered, On delivery, Delivered, Cancelled

                    $customer_name = $_POST['full-name'];
                    $customer_contact = $_POST['contact'];
                    $customer_email = $_POST['email'];
                    $customer_address = $_POST['address'];


                    //Save Order to Database
                    $sql2 = "INSERT INTO tbl_order SET
                    food = '$food',
                    price = $price,
                    qty = $qty,
                    total = $total,
                    order_date = '$order_date',
                    status = '$status',
                    customer_name = '$customer_name',
                    customer_contact = '$customer_contact',
                    customer_email = '$customer_email',
                    customer_address = '$customer_address'
                    
                    ";

                    $res2 = mysqli_query($conn, $sql2);

                    if($res2 == true)
                    {
                        //Query executed and order saved
                        $_SESSION['order'] = "<div class='success text-center'>Food Ordered Successfully</div>";
                        header("location:".SITEURL);
                    }
                    else
                    {
                        //Failed to save order
                        $_SESSION['order'] = "<div class='error text-center'>Failed to Order Food</div>";
                        header("location:".SITEURL);
                    }
                }
            ?>

        </div>
    </section>

<?php
  include('partials-front/footer.php');
?>