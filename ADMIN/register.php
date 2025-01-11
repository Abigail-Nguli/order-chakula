<?php 
    include('../config/constants.php');
?>

<html>
    <head>
        <title>Registration Form - Food Ordering Website</title>
        <link rel="stylesheet" href="../ADMIN.css">
        <script src="https://kit.fontawesome.com/a29196e54d.js" crossorigin="anonymous"></script>
    </head>

    <body>

        <div class="login-container">

            <form action="#" class="login-form" method="POST">
                <h1 class="login-title">Register</h1>

                <div id="message">
                    <?php 
                        if(isset($_SESSION['register']))
                        {
                            echo $_SESSION['register'];
                            unset($_SESSION['register']);
                        }
                    ?>
                </div>

                <div class="input-box">
                    <i class="fa-regular fa-user"></i>
                    <input type="text" name="full_name" placeholder="Full Name" required>
                </div>

                <div class="input-box">
                    <i class="fa-regular fa-user"></i>
                    <input type="text" name="username" placeholder="Username" required>
                </div>

                <div class="input-box">
                    <i class="fa-solid fa-lock"></i>
                    <input type="password" name="password" placeholder="Password" required>
                </div>
                
                <div class="remember-forgot-box">
                    <label for="remember">
                        <input type="checkbox" name="checkbox" id="remember">
                        Remember me
                    </label>

                </div>

                <input type="submit" name="submit" value="Register" class="login-btn">

            </form>

        </div>

    </body>
</html>

<?php 
   if(isset($_POST['submit'])){

        //Get Data
        $full_name = $_POST['full_name'];
        $username = $_POST['username'];
        $password = md5($_POST['password']);


        //Save Data
        $sql = "INSERT INTO tbl_admin SET
            full_name = '$full_name',
            username = '$username',
            password = '$password'
        ";


        $res = mysqli_query($conn, $sql) or die(mysqli_error());
        if($res==TRUE){
            $_SESSION['register'] = "<div class='success'>Registration Successfully</div>";

            header("location:".SITEURL.'ADMIN/login.php');
        }
        else{
            $SESSION['register'] = "<div class='error'>❌Failed to Register. Try Again Later!!</div>";

            header("location:".SITEURL.'ADMIN/register.php');
        }
    }
?>

<script> 
    // JavaScript to hide message after 5 seconds 
    setTimeout(function() { 
        var message = document.getElementById('message'); 
        if (message) { 
            message.style.display = 'none'; } 
        }, 5000); 
    // 5000 milliseconds = 5 seconds
</script>