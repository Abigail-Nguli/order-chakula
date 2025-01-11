 <?php 
    //Authorization - Access Control
    if(!isset($_SESSION['user'])) //If user sssion is not set
    {
        //User is not logged in
        $_SESSION['no-login-message'] = "<div class='error text-center'>Please Log in to access Admin Panel</div>";
        header("location:".SITEURL.'ADMIN/login.php');
    }
 ?>