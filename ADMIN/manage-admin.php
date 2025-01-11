 <?php include('partials/menu.php')?>

        <!--Main-->
        <div class="main-content">
    <div class="wrapper">
        <h1>Manage Admin</h1>
    <br>

    <div id="message">

        <?php 
        if(isset($_SESSION['add']))
        {
            echo $_SESSION['add'];//Display Session Message
            unset($_SESSION['add']);//Remove Session Message
        }

        if(isset($_SESSION['delete']))
        {
            echo $_SESSION['delete'];//Display Session Message
            unset($_SESSION['delete']);//Remove Session Message
        }

        if(isset($_SESSION['update']))
        {
            echo $_SESSION['update'];//Display Session Message
            unset($_SESSION['update']);//Remove Session Message
        }

        if(isset($_SESSION['user-not-found']))
        {
            echo $_SESSION['user-not-found'];//Display Session Message
            unset($_SESSION['user-not-found']);//Remove Session Message
        }

        if(isset($_SESSION['pass-not-match']))
        {
            echo $_SESSION['pass-not-match'];//Display Session Message
            unset($_SESSION['pass-not-match']);//Remove Session Message
        }

        if(isset($_SESSION['change-password']))
        {
            echo $_SESSION['change-password'];//Display Session Message
            unset($_SESSION['change-password']);//Remove Session Message
        }
    ?>

    </div>
    <br>
    <br>
    <br>

        <a href="add-admin.php" class="btn-primary">Add Admin</a>
        <br>
        <br>

        <table class="tbl-full">
            <tr>
                <th>S.N</th>
                <th>Full Name</th>
                <th>Username</th>
                <th>Actions</th>
            </tr>


        <?php 
            $sql = "SELECT * FROM tbl_admin";

            $res = mysqli_query($conn, $sql);

            if($res==TRUE){
                $count = mysqli_num_rows($res);

                $sn=1;

                if($count>0){
                    while($rows=mysqli_fetch_assoc($res))
                    {
                        //Get Individual Data
                        $id=$rows['id'];
                        $full_name=$rows['full_name'];
                        $username=$rows['username'];

                        ?>

                        <tr>
                            <td><?php echo $sn++; ?></td>
                            <td><?php echo $full_name; ?></td>
                            <td><?php echo $username; ?></td>
                            <td>
                                <a href="<?php echo SITEURL; ?>ADMIN/update-password.php?id=<?php echo $id; ?>" class="btn-primary">Change Password</a>
                                <a href="<?php echo SITEURL; ?>ADMIN/update-admin.php?id=<?php echo $id; ?>" class="btn-secondary">Update Admin</a>
                                <a href="<?php echo SITEURL; ?>ADMIN/delete-admin.php?id=<?php echo $id; ?>" class="btn-danger">Delete Admin</a>
                            </td>
                         </tr>

                        <?php
                    }
                }
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