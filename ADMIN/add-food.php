<?php 
ob_start();
include('partials/menu.php');
?>

<div class="main-content">
    <div class="wrapper">
        <h1>Add Food</h1>
        <br><br>

        <div id="message">
            <?php 
                if(isset($_SESSION['add'])) {
                    echo $_SESSION['add']; // Display Session Message
                    unset($_SESSION['add']); // Remove Session Message
                }

                if(isset($_SESSION['upload'])) {
                    echo $_SESSION['upload'];
                    unset($_SESSION['upload']);
                }
            ?>
        </div>
        <br><br>

        <form action="" method="POST" enctype="multipart/form-data">

            <table class="tbl-30">
                <tr>
                    <td>Title: </td>
                    <td><input type="text" name="title" placeholder="Food Title"></td>
                </tr>
                <tr>
                    <td>Description: </td>
                    <td>
                        <textarea name="description" placeholder="Food Description" cols="22" rows="4"></textarea>
                    </td>
                </tr>
                <tr>
                    <td>Price: </td>
                    <td><input type="number" name="price"></td>
                </tr>
                <tr>
                    <td>Select Image: </td>
                    <td><input type="file" name="image"></td>
                </tr>
                <tr>
                    <td>Category: </td>
                    <td>
                        <select name="category">
                        <?php
                        $sql = "SELECT * from tbl_category WHERE active='yes'";
                        $res = mysqli_query($conn, $sql);
                        if($res) {
                            while($row = mysqli_fetch_assoc($res)) {
                                $id = $row['id'];
                                $title = $row['title'];

                            ?>
                
                                <option value="<?php echo $id; ?>"><?php echo $title; ?></option>

                            <?php
                            }
                        } else {
                            echo "<option value='0'>No Category Found</option>";
                        }
                        ?>
                        </select>
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
                        <input type="submit" name="submit" value="Add Food" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>

<?php include('partials/footer.php')?>

<?php 
if(isset($_POST['submit'])){
    $title = $_POST['title'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $category_id = $_POST['category'];

    if(isset($_POST['featured'])) {
        $featured = $_POST['featured'];
    } else {
        $featured = "No";
    }

    if(isset($_POST['active'])) {
        $active = $_POST['active'];
    } else {
        $active = "No";
    }

    if(isset($_FILES['image']['name'])) {
        $image_name = $_FILES['image']['name'];
        if($image_name!="") {
            $temp = explode('.', $image_name);
            $ext = end($temp);
            $image_name = "Food_Name_".rand(000, 999).'.'.$ext;
            $source_path = $_FILES['image']['tmp_name'];
            $destination_path = "../IMAGES/Food/".$image_name;
            $upload = move_uploaded_file($source_path, $destination_path);

            if($upload == false) {
                $_SESSION['upload'] = "<div class='error'>Failed to upload image❌</div>";
                header('location:'.SITEURL.'ADMIN/add-food.php');
                die();
            }
        }
    } else {
        $image_name = $current_image;
    }

    $sql2 = "INSERT INTO tbl_food SET
        title = '$title',
        description = '$description',
        price = $price,
        image_name = '$image_name',
        category_id = $category_id,
        featured = '$featured',
        active = '$active'";

    $res2 = mysqli_query($conn, $sql2) or die(mysqli_error($conn));
    if($res2 == TRUE) {
        $_SESSION['add'] = "<div class='success'>Food Added Successfully</div>";
        header("location:".SITEURL.'ADMIN/manage-food.php');
    } else {
        $_SESSION['add'] = "<div class='error'>❌Failed to Add Food. Try Again Later!!</div>";
        header("location:".SITEURL.'ADMIN/add-food.php');
    }
}
ob_end_flush();
?>

<script>
    setTimeout(function() {
        var message = document.getElementById('message');
        if (message) {
            message.style.display = 'none';
        }
    }, 5000);
</script>
