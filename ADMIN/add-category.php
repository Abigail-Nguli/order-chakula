<?php include('partials/menu.php')?>

<div class="main-content">
    <div class="wrapper">
        <h1>Add Category</h1>
        <br>
        <br>

        <div id="message">

            <?php 
                if(isset($_SESSION['add']))
                {
                    echo $_SESSION['add'];//Display Session Message
                    unset($_SESSION['add']);//Remove Session Message
                }

                if(isset($_SESSION['upload']))
                {
                    echo $_SESSION['upload'];
                    unset($_SESSION['upload']);
                }
            ?>
        </div>
        <br>
        <br>

        <form action="" method="POST" enctype="multipart/form-data">

            <table class="tbl-30">
                <tr>
                    <td>Title: </td>
                    <td><input type="text" name="title" placeholder="Category Title"></td>
                </tr>
                <tr>
                    <td>Select Image: </td>
                    <td>
                        <input type="file" name="image">
                    </td>
                </tr>
                <tr>
                    <td>Featured: </td>
                    <td>
                        <input type="radio" name="featured" value="Yes"> Yes
                        <input type="radio" name="featured" value="No"> No
                    </td>
                </tr>

                <tr>
                    <td>Active: </td>
                    <td>
                        <input type="radio" name="active" value="Yes"> Yes
                        <input type="radio" name="active" value="No"> No
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Category" class="btn-secondary">
                    </td>
                </tr>
            </table>

        </form>
    </div>
</div>

<?php include('partials/footer.php')?>

<?php 
    if(isset($_POST['submit'])){

        //Get Data
        $title = $_POST['title'];
        
        //For radio input type check whether the button is selected or not
        if(isset($_POST['featured']))
        {
            $featured = $_POST['featured'];
        }
        else{
            $featured = "No";
        }

        if(isset($_POST['active']))
        {
            $active = $_POST['active'];
        }
        else{
            $active = "No";
        }

        //Check whether image is selected or not and set value for image name
        if(isset($_FILES['image']['name']))
        {
            //Get the image name, source path and destination path
            $image_name = $_FILES['image']['name'];

            //Auto rename image
            //Get the extension eg. grill-choma.jpg
            $ext = end(explode('.', $image_name));

            //Rename the image eg. Food_Category_123.jpg
            $image_name = "Food_Category_".rand(000, 999).'.'.$ext;
            $source_path = $_FILES['image']['tmp_name'];

            $destination_path = "../IMAGES/Category/".$image_name;

            //Upload the image
            $upload = move_uploaded_file($source_path, $destination_path);

            //Check whether the image is uploaded or not
            if($upload==false)
            {
                $_SESSION['upload'] = "<div class='error'>Failed to upload image❌</div>";
                header('location:'.SITEURL.'ADMIN/add-category.php');

                //Stop the process
                die();
            }


        }
        else{
            //Don't upload image and set image name value as blank
            $image_name = "";
        }


        //Save Data
        $sql = "INSERT INTO tbl_category SET
            title = '$title',
            image_name = '$image_name',
            featured = '$featured',
            active = '$active'
        ";


        $res = mysqli_query($conn, $sql) or die(mysqli_error());
        if($res==TRUE){
            $_SESSION['add'] = "<div class='success'>Category Added Successfully</div>";

            header("location:".SITEURL.'ADMIN/manage-category.php');
        }
        else{
            $SESSION['add'] = "<div class='error'>❌Failed to Add Category. Try Again Later!!</div>";

            header("location:".SITEURL.'ADMIN/add-category.php');
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