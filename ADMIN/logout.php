<?php 
    include('../config/constants.php');

    //Destroy Session
    session_destroy();

    //Redirect to Login Page
    header("location:".SITEURL.'api/');
?>