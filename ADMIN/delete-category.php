<?php 

    include('../config/constants.php');

    //Get Category
    $id = $_GET['id'];

    //Delete Category
    $sql = "DELETE FROM tbl_category WHERE id=$id";

    $res = mysqli_query($conn, $sql) or die(mysqli_error());
        if($res==TRUE){
            $_SESSION['delete'] = "<div class='success'>Category Deleted Successfully</div>";

            header("location:".SITEURL.'ADMIN/manage-category.php');
        }
        else{
            $SESSION['delete'] = "<div class='error'>❌Failed to Delete Category. Try Again Later!!</div>";

            header("location:".SITEURL.'ADMIN/manage-Category.php');
        }


?>