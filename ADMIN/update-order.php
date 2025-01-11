<?php include('partials/menu.php'); ?>


    <div class="main-content">
        <div class="wrapper">
            <h1>Update Order</h1>
            <br>
            <br>

            <div id="message">
                <?php 
                
                 if(isset($_Get['id']))
                {
                    //Get Order Details
                    $sql = "SELECT * FROM tbl_order WHERE id=$id";

                    $res = mysqli_query($conn, $sql);

                    //Check Query Execution
                    if($res==true)
                    {
                        $count = mysqli_num_rows($res);

                        if($count==1)
                        {
                            //Get Details
                            $row = mysqli_fetch_assoc($res);

                            $food = $row["food"];
                            $price = $row["price"];
                            $qty = $row["qty"];
                            $status = $row["status"];
                        }
                        else
                        {
                            //Redirect
                            header("location:".SITEURL.'ADMIN/manage-order.php');
                        }
                    }
                    else
                    {
                        //Redirect
                        header('location:'.SITEURL.'ADMIN/manage-order.php');
                    }
                }

                ?>
            </div>

            <?php 
                //Select Order using ID
                $id = $_GET['id'];

                //Get Details
                $sql = "SELECT *FROM tbl_order WHERE id=$id";

                $res = mysqli_query($conn, $sql);

                //Check Query Execution
                if($res==true)
                {
                    $count = mysqli_num_rows($res);

                    if($count==1){
                        //Get Details
                        $row = mysqli_fetch_assoc($res);

                        $food = $row["food"];
                        $price = $row["price"];
                        $qty = $row["qty"];
                        $total = $row["total"];
                        $order_date = $row["order_date"];
                        $status = $row["status"];
                        $customer_name = $row["customer_name"];
                        $customer_contact = $row["customer_contact"];
                        $customer_email = $row["customer_email"];
                        $customer_address = $row["customer_address"];

                    }
                    else{
                        //Redirect
                        header("location:".SITEURL.'ADMIN/manage-order.php');
                    }
                }
            ?>

            <form action="" method="POST">

            <table class="tbl-30"> 
                <tr> 
                    <td>Food Name: </td> 
                    <td><b>
                        <?php echo $food; ?>
                    </td></b>
                </tr>
                 
                <tr>
                    <td>Price: </td> 
                    <td><b>
                       KES <?php echo $price; ?>
                    </td></b>
                </tr> 
                <tr> 
                    <td>Quantity: </td> 
                    <td>
                        <input type="number" name="qty" value="<?php echo $qty; ?>">
                    </td> 
                    <tr> 
                </tr> 

                <tr> 
                    <tr>
                        <td>Status: </td>
                        <td>
                            <select name="status">
                                <option <?php if($status=="Ordered"){echo "selected";} ?> value="Ordered">Ordered</option>
                                <option  <?php if($status=="On Delivery"){echo "selected";} ?> value="On Delivery">On Delivery</option>
                                <option <?php if($status=="Delivered"){echo "selected";} ?> value="Delivered">Delivered</option>
                                <option  <?php if($status=="Cancelled"){echo "selected";} ?> value="Cancelled">Cancelled</option>
                            </select>
                        </td>
                    </tr>

                    <tr>
                        <td>
                            Order Date
                        </td>
                        <td><b>
                            <?php echo $order_date; ?>
                        </td></b>
                    </tr>
                    <tr>
                        <td>Customer Name</td>
                        <td><b>
                            <?php echo $customer_name; ?>
                        </td></b>
                    </tr>
                    <tr>
                        <td>Customer Address</td>
                        <td><b>
                            <?php echo $customer_address; ?>
                        </td></b>
                    </tr>

                    <tr>
                        <td colspan="2">
                                <input type="hidden" name="id" value="<?php echo $id; ?>">
                                <input type="hidden" name="price" value="<?php echo $price; ?>">
                                <input type="submit" name="submit" value="Update Order" class="btn-secondary">
                            </td>
                    </tr>
                    
            </table>
            </form>
        </div>
    </div>

    <?php 
    
    if(isset($_POST['submit']))
    {
        //Get Updated Values
        $id = $_POST['id'];
        $price = $_POST['price'];
        $qty = $_POST['qty'];
        $total = $price * $qty;
        $status = $_POST['status'];



        //Update Order
        $sql2 = "UPDATE tbl_order SET
        qty = $qty, 
        total = $total, 
        status = '$status'
        WHERE id = '$id'
        ";

        $res2 = mysqli_query($conn, $sql2);

        if($res2==true){
            $_SESSION["update"] = "<div class='success'>Order Updated Successfully</div>";
            header("location:".SITEURL.'ADMIN/manage-order.php');
            
        }
        else{
            $_SESSION["update"] = "<div class='error'>❌Failed to Update Order. Try Again Later!!</div>";
            header("location:".SITEURL.'ADMIN/update-order.php');
        }
    }
    
    ?>


<?php include('partials/footer.php'); ?>

<script> 
    // JavaScript to hide message after 5 seconds 
    setTimeout(function() { 
        var message = document.getElementById('message'); 
        if (message) { 
            message.style.display = 'none'; } 
        }, 5000); 
    // 5000 milliseconds = 5 seconds
</script>