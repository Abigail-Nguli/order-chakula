<?php 

    include('../config/constants.php');

    //Get Order
    $id = $_GET['id'];

    //Delete Food
    $sql = "DELETE FROM tbl_order WHERE id=$id";

    $res = mysqli_query($conn, $sql) or die(mysqli_error());
        if($res==TRUE){
            $_SESSION['delete'] = "<div class='success'>Order Deleted Successfully</div>";

            header("location:".SITEURL.'ADMIN/manage-order.php');
        }
        else{
            $SESSION['delete'] = "<div class='error'>❌Failed to Delete Order. Try Again Later!!</div>";

            header("location:".SITEURL.'ADMIN/manage-order.php');
        }


?>