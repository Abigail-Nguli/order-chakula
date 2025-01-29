<?php include('partials/menu.php')?>
        <!--Main-->
        <div class="main-content">
    <div class="wrapper">
        <h1>DASHBOARD</h1>
        <br><br>

        <div id="message">
            <?php 
                if(isset($_SESSION['login']))
                {
                    echo $_SESSION['login'];
                    unset($_SESSION['login']);
                }
        ?>
        </div>
        <br><br>

        <div class="container">
            <div class="col-4 text-center">
                <?php 
                    $sql = "SELECT * FROM tbl_category";

                    $res = mysqli_query($conn, $sql);

                    $count = mysqli_num_rows($res);
                ?>
            <h1><?php echo $count; ?></h1>
            <br><br>
            Categories
        </div>
        <div class="col-4 text-center">
            <?php 
                    $sql2 = "SELECT * FROM tbl_food";

                    $res2 = mysqli_query($conn, $sql2);

                    $count2 = mysqli_num_rows($res2);
                ?>
            <h1><?php echo $count; ?></h1>
            <br><br>
            Foods
        </div>
        <div class="col-4 text-center">
             <?php 
                    $sql3 = "SELECT * FROM tbl_order";

                    $res3 = mysqli_query($conn, $sql3);

                    $count3 = mysqli_num_rows($res3);
                ?>
            <h1><?php echo $count; ?></h1>
            <br><br>
            Orders
        </div>
        <div class="col-4 text-center">
            <?php 
                    $sql4 = "SELECT SUM(total) AS Total FROM tbl_order WHERE status='Delivered'";

                    $res4 = mysqli_query($conn, $sql4);

                    $row4 = mysqli_fetch_assoc($res4);

                    $total_revenue = $row4['Total'];
                ?>
            <h1>KES <?php echo $total_revenue; ?></h1>
            <br><br>
            Revenue Generated
        </div>
        </div>
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