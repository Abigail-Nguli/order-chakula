<?php include('partials/menu.php'); ?>


    <div class="main-content">
        <div class="wrapper">
            <h1>Update Admin</h1>
            <br>
            <br>

            <?php 
                //Select Admin using ID
                $id = $_GET['id'];

                //Get Details
                $sql = "SELECT *FROM tbl_admin WHERE id=$id";

                $res = mysqli_query($conn, $sql);

                //Check Query Execution
                if($res==true)
                {
                    $count = mysqli_num_rows($res);

                    if($count==1){
                        //Get Details
                        $row = mysqli_fetch_assoc($res);

                        $full_name = $row["full_name"];
                        $username = $row["username"];
                    }
                    else{
                        //Redirect
                        header("location:".SITEURL.'ADMIN/manage-admin.php');
                    }
                }
            ?>

            <form action="" method="POST">

                <table class="tbl-30">
                    <tr>
                        <td>Full Name: </td>
                        <td>
                            <input type="text" name="full_name" value="<?php echo $full_name; ?>">
                        </td>
                    </tr>
                    <tr>
                        <td>Username: </td>
                        <td>
                            <input type="text" name=username value="<?php echo $username; ?>">
                        </td>
                    </tr>

                    <tr>
                        <td colspan="2">
                            <input type="hidden" name="id" value="<?php echo $id; ?>">
                            <input type="submit" name="submit" value="Update Admin" class="btn-secondary">
                        </td>
                    </tr>
                </table>
            </form>
        </div>
    </div>

    <?php 
    
    if(isset($_POST['submit']))
    {
        //Get Updated Values
        $id = $_POST['id'];
        $full_name = $_POST['full_name'];
        $username = $_POST['username'];

        //Update Admin
        $sql = "UPDATE tbl_admin SET
        full_name = '$full_name',
        username = '$username' 
        WHERE id = '$id'
        ";

        $res = mysqli_query($conn, $sql);

        if($res==true){
            $_SESSION["update"] = "<div class='success'>Admin Updated Successfully</div>";
            header("location:".SITEURL.'ADMIN/manage-admin.php');
            
        }
        else{
            $_SESSION["update"] = "<div class='error'>❌Failed to Update Admin. Try Again Later!!</div>";
            header("location:".SITEURL.'ADMIN/manage-admin.php');
        }
    }
    
    ?>





<?php include('partials/footer.php'); ?>
