 <?php include('partials/menu.php')?>

        <!--Main-->
        <div class="main-content">
    <div class="wrapper">
        <h1>Manage Category</h1>
        <br><br>

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

                if(isset($_SESSION['remove-failed']))
                {
                    echo $_SESSION['remove-failed'];//Display Session Message
                    unset($_SESSION['remove-failed']);//Remove Session Message
                }
            ?>

        </div>
        <br>
        <br>



        <a href="add-category.php" class="btn-primary">Add Category</a>
        <br>
        <br>

        <table class="tbl-full">
            <tr>
                <th>S.N</th>
                <th>Title</th>
                <th>Image Name</th>
                <th>Featured</th>
                <th>Active</th>
                <th>Actions</th>
            </tr>


        <?php 
            $sql = "SELECT * FROM tbl_category";

            $res = mysqli_query($conn, $sql);

            if($res==TRUE){
                $count = mysqli_num_rows($res);

                $sn=1;

                if($count>0){
                    while($rows=mysqli_fetch_assoc($res))
                    {
                        //Get Individual Data
                        $id=$rows['id'];
                        $title=$rows['title'];
                        $image_name=$rows['image_name'];
                        $featured=$rows['featured'];
                        $active=$rows['active'];

                        ?>

                        <tr>
                            <td><?php echo $sn++; ?></td>

                            <td>
                                <?php 
                                    if($image_name!="")
                                    {
                                        //Display the image
                                        ?>

                                        <img src="<?php echo SITEURL; ?>IMAGES/Category/<?php echo $image_name; ?> " width="100px">

                                        <?php
                                    }
                                    else{
                                        //Display the message
                                        echo "<div class='error'>Image not Added</div>";
                                    }
                                ?>
                            </td>

                            <td><?php echo $title; ?></td>
                            <td><?php echo $featured; ?></td>
                            <td><?php echo $active; ?></td>
                            <td>
                                <a href="<?php echo SITEURL; ?>ADMIN/update-category.php?id=<?php echo $id; ?>" class="btn-secondary">Update Category</a>
                                <a href="<?php echo SITEURL; ?>ADMIN/delete-category.php?id=<?php echo $id; ?>" class="btn-danger">Delete Category</a>
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