<?php 
    ob_start();
    include('partials/menu.php'); 
?>


    <div class="main-content">
        <div class="wrapper">
            <h1>Update Food</h1>
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
                if(isset($_GET['id']))
                {
                    //Select Food using ID
                $id = $_GET['id'];

                //Get Details
                $sql2 = "SELECT *FROM tbl_food WHERE id=$id";

                $res2 = mysqli_query($conn, $sql2);


                //Check Query Execution
                if($res2==true)
                {
                    $count = mysqli_num_rows($res2);

                    if($count==1){
                        //Get Details
                        $row2 = mysqli_fetch_assoc($res2);

                        $title = $row2["title"];
                        $description = $row2["description"];
                        $price = $row2["price"];
                        $current_image = $row2["image_name"];
                        $current_category = $row2["category_id"];
                        $featured = $row2["featured"];
                        $active = $row2["active"];
                    }
                    else{
                        //Redirect
                        header("location:".SITEURL.'ADMIN/manage-food.php');
                    }
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
                    <td>Description: </td>
                    <td>
                        <textarea name="description"><?php echo $description; ?></textarea>
                    </td>
                </tr>
                    <tr> 
                    <td>Price: </td> 
                    <td>
                        <input type="number" name="price" value="<?php echo $price; ?>">
                    </td> 
                </tr> 
                </tr> 
                <tr> 
                    <td>Current Image: </td> 
                    <td> 
                        <?php 
                            if($current_image != "") 
                            { 
                                ?>
                                    <img src="<?php echo SITEURL; ?>IMAGES/Food/<?php echo $current_image; ?>" width="150px">
                                <?php
                                
                            } 
                            else 
                            { 
                                echo "<div class='error'>Image Not Available</div>"; 
                            } 
                        ?> 
                    </td> 
                </tr> 
                <tr> 
                <td>Select New Image: </td> 
                <td><input type="file" name="image"></td>
                        
            </tr>
            <tr>
                <td>
                    Category:
                </td>
                <td>
                    <select name="category">
                            <?php 

                                //Query to get active categories
                                $sql = "SELECT * FROM tbl_category WHERE active = 'Yes'";

                                $res = mysqli_query($conn, $sql);

                                $count = mysqli_num_rows($res);

                                //Check whether category is available or not
                                if($count>0)
                                {
                                    //Category Available
                                    while($row = mysqli_fetch_assoc($res))
                                    {
                                        $category_title = $row['title'];
                                        $category_id = $row['id'];
                                        
                                        //echo "<option value='$category_id'>$category_title</option>"
                                        ?>
                                            <option <?php if($current_category == $category_id){echo "selected";} ?> value="<?php echo $category_id; ?>"><?php echo $category_title; ?></option>
                                        <?php
                                    }
                                }
                                else
                                {
                                    //Category Not Available
                                    echo "<option value='0'>Category Not Available</option>";
                                }
                            ?>
                    </select>
                </td>
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
                            <input type="hidden" name="current_image" value="<?php echo $current_image; ?>">
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
        $description = $_POST['description'];
        $price = $_POST['price'];
        $current_image = $_POST['current_image'];
        $category = $_POST['category'];
        $featured = $_POST['featured'];
        $active = $_POST['active'];


        //Check whether image is selected or not and set value for image name
        if(isset($_FILES['image']['name']) && $_FILES['image']['name'] != "")
        {
            // Upload new image and remove old image 
            $image_name = $_FILES['image']['name']; 

            $temp = explode('.', $image_name);
            $ext = end($temp);
            $image_name = "Food_Name".rand(000, 999).'.'.$ext; 

            $source_path = $_FILES['image']['tmp_name']; 
            $destination_path = "../IMAGES/Food/".$image_name; 

            $upload = move_uploaded_file($source_path, $destination_path); 
            if($upload == false) 
            {
                $_SESSION['upload'] = "<div class='error'>Failed to upload image❌</div>"; 
                header('location:'.SITEURL.'ADMIN/update-food.php'); die();
            }

            if($current_image != "") 
            { 
                $remove_path = "../IMAGES/Food/".$current_image; 
                $remove = unlink($remove_path); 
                if($remove == false) 
                { 
                    $_SESSION['remove-failed'] = "<div class='error'>Failed to remove current image❌</div>"; 
                    header('location:'.SITEURL.'ADMIN/manage-food.php'); 
                    die(); 
                } 
            }
        }
        else{
            $image_name = $current_image;
        }

        //Update Food
        $sql = "UPDATE tbl_food SET
            title = '$title',
            price = '$price', 
            description = '$description', 
            image_name = '$image_name', 
            category_id = '$category', 
            featured = '$featured',
            active = '$active'
            WHERE id = '$id'";


        $res = mysqli_query($conn, $sql);

        if($res == true)
        {
            $_SESSION["update"] = "<div class='success'>Food Updated Successfully</div>";
            // Debugging: Check image name
            echo "New Image: ".$image_name;
            header("location:".SITEURL.'ADMIN/manage-food.php');
        }
        else
        {
            $_SESSION["update"] = "<div class='error'>❌Failed to Update Food. Try Again Later!!</div>";
            header("location:".SITEURL.'ADMIN/update-food.php');
        }

    }
    ob_end_flush();
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