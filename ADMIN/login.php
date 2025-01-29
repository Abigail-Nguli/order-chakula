<?php 
include('../config/constants.php');

// Get Username and Password from cookies
$cookieUser = isset($_COOKIE['login_user']) ? $_COOKIE['login_user'] : '';
$cookiePass = isset($_COOKIE['login_pass']) ? $_COOKIE['login_pass'] : '';
$checkedStatus = (!empty($cookieUser) && !empty($cookiePass)) ? 'checked' : '';

// Check Whether Login button is clicked
if(isset($_POST['submit']))
{
    // Process for Login
    // 1. Get Data from Login Form
    $username = $_POST['username'];
    $password = md5($_POST['password']);

    // Query to check whether the user with username and password exists or not
    $sql = "SELECT * FROM tbl_admin WHERE username = '$username' AND password = '$password'";

    // Execute Query
    $res = mysqli_query($conn, $sql);
    if(!$res) {
        die("Query failed: " . mysqli_error($conn));
    }

    // Count rows to check whether user exists or not
    $count = mysqli_num_rows($res);

    if($count==1)
    {
        // User Available and Login Success
        $_SESSION['login'] = "<div class='success text-center'>Login Successful</div>";
        $_SESSION['user'] = $username; // Checks whether user is logged in or not and logout will unset it
        header("location:".SITEURL.'ADMIN/');
    }
    else
    {
        // User Not Available and Login Failed
        $_SESSION['login'] = "<div class='error text-center'>Username or Password did not match</div>";
        header("location:".SITEURL.'ADMIN/login.php');
    }

    if(isset($_POST['remember'])){
        setcookie("login_user", $username, time() + (10 * 365 * 24 * 60 * 60));
        setcookie("login_pass", $password, time() + (10 * 365 * 24 * 60 * 60));
    }
    else{
        setcookie("login_user", "", time() - 3600);
        setcookie("login_pass", "", time() - 3600);
    }   
}
?>

<html>
<head>
    <title>Login Form - Food Ordering Website</title>
    <link rel="stylesheet" href="../ADMIN.css">
    <script src="https://kit.fontawesome.com/a29196e54d.js" crossorigin="anonymous"></script>
</head>

<body>

<div class="login-container">

    <form action="#" class="login-form" method="POST">
       <h1 class="login-title">Login</h1>

        <div id="message">
            <?php 
                if(isset($_SESSION['login']))
                {
                    echo $_SESSION['login'];
                    unset($_SESSION['login']);
                }
            ?>
        </div>

        <div class="input-box">
            <i class="fa-regular fa-user"></i>
            <input type="text" name="username" placeholder="Username" value="<?php echo $cookieUser; ?>">
        </div>

        <div class="input-box">
            <i class="fa-solid fa-lock"></i>
            <input type="password" name="password" placeholder="Password" value="<?php echo $cookiePass; ?>">
        </div>
        
        <div class="remember-forgot-box">
            <label for="remember">
                <input type="checkbox" name="remember" id="remember" <?php echo $checkedStatus; ?>>
                Remember me
            </label>
            <a href="#">Forgot Password?</a>
        </div>

        <input type="submit" name="submit" value="Login" class="login-btn">

        <p class="register">
            Don't have an account?
            <a href="register.php">Register</a>
        </p>
    </form>

</div>

</body>
</html>

<script> 
    // JavaScript to hide message after 5 seconds 
    setTimeout(function() { 
        var message = document.getElementById('message'); 
        if (message) { 
            message.style.display = 'none'; 
        } 
    }, 5000); 
    // 5000 milliseconds = 5 seconds
</script>
