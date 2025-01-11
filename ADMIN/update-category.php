<?php include('partials/menu.php'); ?>


    <div class="main-content">
        <div class="wrapper">
            <h1>Update Category</h1>
            <br>
            <br>

            <div id="message">
                <?php 
                
                 if(isset($_SESSION['remove-failed']))
                {
                    echo $_SESSION['remove-failed'];//Display Session Message
                    unset($_SESSION['remove-failed']);//Remove Session Message
                }

                ?>
            </div>

            <?php 
                //Select Category using ID
                $id = $_GET['id'];

                //Get Details
                $sql = "SELECT *FROM tbl_category WHERE id=$id";

                $res = mysqli_query($conn, $sql);

                //Check Query Execution
                if($res==true)
                {
                    $count = mysqli_num_rows($res);

                    if($count==1){
                        //Get Details
                        $row = mysqli_fetch_assoc($res);

                        $title = $row["title"];
                        $image_name = $row["image_name"];
                        $featured = $row["featured"];
                        $active = $row["active"];
                    }
                    else{
                        //Redirect
                        header("location:".SITEURL.'ADMIN/manage-category.php');
                    }
                }
            ?>

            <form action="" method="POST" enctype="multipart/form-data">

            <table class="tbl-30"> 
                <tr> 
                    <td>Title: </td> 
                    <td>
                        <input type="text" name="title" value="<?php echo $title; ?>">
                    </td> 
                </tr> 
                <tr> 
                    <td>Current Image: </td> 
                    <td> 
                        <?php 
                            if($image_name != "") 
                            { 
                                echo '<img src="../IMAGES/Category/'.$image_name.'" width="150px">'; 
                                
                            } 
                            else 
                            { 
                                echo "<div class='error'>Image Not Added</div>"; 
                            } 
                        ?> 
                    </td> 
                </tr> 
                <tr> 
                <td>Select New Image: </td> 
                <td><input type="file" name="image"></td>
                        
            </tr>
                <tr>
                    <td>Featured: </td>
                    <td>
                        <input type="radio" name="featured" value="Yes" <?php if($featured == "Yes"){echo "checked";} ?>>Yes
                        <input type="radio" name="featured" value="No"  <?php if($featured == "No"){echo "checked";} ?>> No
                    </td>
                </tr>

                <tr>
                    <td>Active: </td>
                    <td>
                        <input type="radio" name="active" value="Yes"  <?php if($active == "Yes"){echo "checked";} ?>> Yes
                        <input type="radio" name="active" value="No"  <?php if($active == "No"){echo "checked";} ?>> No
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                            <input type="hidden" name="id" value="<?php echo $id; ?>">
                            <input type="hidden" name="current_image" value="<?php echo $image_name; ?>">
                            <input type="submit" name="submit" value="Update Category" class="btn-secondary">
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
        $title = $_POST['title'];
        $current_image = $_POST['current_image'];

       // For radio input type check whether the button is selected or not 
       $featured = isset($_POST['featured']) ? $_POST['featured'] : 'No'; 
       $active = isset($_POST['active']) ? $_POST['active'] : 'No';

        //Check whether image is selected or not and set value for image name
        if(isset($_FILES['image']['name']) && $_FILES['image']['name'] != "")
        {
            // Upload new image and remove old image 
            $image_name = $_FILES['image']['name']; 

            $ext = end(explode('.', $image_name)); 
            $image_name = "Food_Category_".rand(000, 999).'.'.$ext; 

            $source_path = $_FILES['image']['tmp_name']; 
            $destination_path = "../IMAGES/Category/".$image_name; 

            $upload = move_uploaded_file($source_path, $destination_path); 
            if($upload == false) 
            {
                $_SESSION['upload'] = "<div class='error'>Failed to upload image❌</div>"; 
                header('location:'.SITEURL.'ADMIN/manage-category.php'); die();
            }

            if($current_image != "") 
            { 
                $remove_path = "../IMAGES/Category/".$current_image; 
                $remove = unlink($remove_path); 
                if($remove == false) 
                { 
                    $_SESSION['remove-failed'] = "<div class='error'>Failed to remove current image❌</div>"; 
                    header('location:'.SITEURL.'ADMIN/manage-category.php'); 
                    die(); 
                } 
            }
        }
        else{
            $image_name = $current_image;
        }

        //Update Category
        $sql = "UPDATE tbl_category SET
        title = '$title',
        image_name = '$image_name', 
        featured = '$featured',
        active = '$active'
        WHERE id = '$id'
        ";

        $res = mysqli_query($conn, $sql);

        if($res==true){
            $_SESSION["update"] = "<div class='success'>Category Updated Successfully</div>";
            header("location:".SITEURL.'ADMIN/manage-category.php');
            
        }
        else{
            $_SESSION["update"] = "<div class='error'>❌Failed to Update Category. Try Again Later!!</div>";
            header("location:".SITEURL.'ADMIN/update-category.php');
        }
    }
    
    ?>


<?php include('partials/footer.php'); ?>

<script> 
    // JavaScript to hide message after 5 seconds 
    setTimeout(function() { 
        var message = document.getElementById('message'); 
        if (message) { 
            message.style.display = 'none'; } 
        }, 5000); 
    // 5000 milliseconds = 5 seconds
</script>