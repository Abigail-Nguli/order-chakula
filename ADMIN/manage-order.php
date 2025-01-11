 <?php include('partials/menu.php')?>

        <!--Main-->
        <div class="main-content">
            <div class="wrapper">
                <h1>Manage Order</h1>
                <br><br>

                <div id="message">

                    <?php 

                        if(isset($_SESSION['update']))
                        {
                            echo $_SESSION['update'];//Display Session Message
                            unset($_SESSION['update']);//Remove Session Message
                        }
                    ?>

                </div>

                <table class="tbl-full order-tbl">
                    <tr>
                        <th>S.N</th>
                        <th>Food</th>
                        <th>Price</th>
                        <th>Qty</th>
                        <th>Total</th>
                        <th>Order Date</th>
                        <th>Status</th>
                        <th>Name</th>
                        <th>Contact</th>
                        <th>Email</th>
                        <th>Address</th>
                        <th>Actions</th>
                    </tr>


                <?php 
                    $sql = "SELECT * FROM tbl_order ORDER BY id DESC";//Display latest order first

                    $res = mysqli_query($conn, $sql);

                    if($res==TRUE)
                    {
                        $count = mysqli_num_rows($res);

                        $sn=1;

                            if($count>0){
                            while($rows=mysqli_fetch_assoc($res))
                            {
                                //Get Individual Data
                                $id = $rows["id"];
                                $food = $rows["food"];
                                $price = $rows["price"];
                                $qty = $rows["qty"];
                                $total = $rows["total"];
                                $order_date = $rows["order_date"];
                                $status = $rows["status"];
                                $customer_name = $rows["customer_name"];
                                $customer_contact = $rows["customer_contact"];
                                $customer_email = $rows["customer_email"];
                                $customer_address = $rows["customer_address"];
                        
                    ?>

                        <tr> 
                            <td><?php echo $sn++; ?></td>
                                <td><?php echo $food; ?></td>

                            <td>
                                <?php echo $price; ?>
                            </td> 
        
                            <td>
                                <?php echo $qty; ?>
                            </td> 

                            <td>
                                <?php echo $total; ?>
                            </td> 
        
                                <td>
                                    <?php echo $order_date; ?>
                                </td> 

                                <td>
                                    <?php 
                                        //Delivery Statuses
                                        if($status=="Ordered")
                                        {
                                            echo "<label>$status</label>";
                                        }
                                        else if($status=="On Delivery")
                                        {
                                            echo "<label style='color: orange;'>$status</label>";
                                        }
                                        else if($status=="Delivered")
                                        {
                                            echo "<label style='color: green;'>$status</label>";
                                        }
                                        else if($status=="Cancelled")
                                        {
                                            echo "<label style='color: red;'>$status</label>";
                                        }
                                    ?>
                                    
                                </td>

                                <td>
                                    <?php echo $customer_name; ?>
                                </td>

                                <td>
                                    <?php echo $customer_contact; ?>
                                </td>

                                <td>
                                    <?php echo $customer_email; ?>
                                </td>

                                <td>
                                    <?php echo $customer_address; ?>
                                </td>
                                    <td>
                                        <a href="<?php echo SITEURL; ?>ADMIN/update-order.php?id=<?php echo $id; ?>" class="btn-secondary">Update Order</a>
                                    </td>
                            </tr>

                        <?php
                                
                            }
                        }
                    }
                    else
                    {
                        echo "<tr><td colspan='12' class='error'>Orders Not Available</td></tr>";
                    }
                ?>

                </table>
                
            </div>
        </div>

 <?php include('partials/footer.php')?>

<script> 
    // JavaScript to hide message after 5 seconds 
    setTimeout(function() { 
        var message = document.getElementById('message'); 
        if (message) { 
            message.style.display = 'none'; } 
        }, 5000); 
    // 5000 milliseconds = 5 seconds
</script>