<?php 

    include('../config/constants.php');

    //Get Admin
    $id = $_GET['id'];

    //Delete Admin
    $sql = "DELETE FROM tbl_admin WHERE id=$id";

    $res = mysqli_query($conn, $sql) or die(mysqli_error());
        if($res==TRUE){
            $_SESSION['delete'] = "<div class='success'>Admin Deleted Successfully</div>";

            header("location:".SITEURL.'ADMIN/manage-admin.php');
        }
        else{
            $SESSION['delete'] = "<div class='error'>❌Failed to Delete Admin. Try Again Later!!</div>";

            header("location:".SITEURL.'ADMIN/manage-admin.php');
        }


?>