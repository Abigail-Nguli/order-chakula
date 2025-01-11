<?php 

    include('../config/constants.php');

    //Get Food
    $id = $_GET['id'];

    //Delete Food
    $sql = "DELETE FROM tbl_food WHERE id=$id";

    $res = mysqli_query($conn, $sql) or die(mysqli_error());
        if($res==TRUE){
            $_SESSION['delete'] = "<div class='success'>Food Deleted Successfully</div>";

            header("location:".SITEURL.'ADMIN/manage-food.php');
        }
        else{
            $SESSION['delete'] = "<div class='error'>❌Failed to Delete Food. Try Again Later!!</div>";

            header("location:".SITEURL.'ADMIN/manage-food.php');
        }


?>