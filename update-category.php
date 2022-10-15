<?php include('page/header.php');?>

<div class="content">
    <div class="contain">
        <h1>Update Category</h1><br>

        <?php
        //check if the id is set
        if(isset($_GET['id'])){
            //get id and other info
            $id = $_GET['id'];

            $query = "SELECT * FROM category WHERE id='$id'";
            $sql = mysqli_query($conn, $query);
            $count = mysqli_num_rows($sql);

            if($count>0){
                //get all data
                $row = mysqli_fetch_assoc($sql);
                $title = $row['title'];
                $current_image = $row['image'];
                $featured = $row['featured'];
                $active = $row['active'];
            }
            else{
                $_SESSION['no-category-found'] = "<div class='failed'>Category not found</div>";
                header('location:'.SITE_URL.'admin-category.php');
            }
        }
        else{
            header('location:'.SITE_URL.'admin-category.php');
        }
        ?>

        <form action="" method="POST" enctype="multipart/form-data">
           <table class="table-add">
              <tr>
                 <td>Title</td>
                 <td>
                     <input type="text" name="title" value="<?php echo $title; ?>">
                 </td>
              </tr>
              <tr>
                 <td>Image</td>
                 <td>
                     <?php
                     if($current_image != ""){
                         //display image
                         ?>
                         <img src="<?php echo SITE_URL; ?>images/category-images/<?php echo $current_image; ?>" width="150px">
                         <?php
                     }
                     else{
                         //message
                         echo "<div class='failed'>No image</div>";
                     }
                     ?>
                 </td>
              </tr>
              <tr>
                 <td>New image</td>
                 <td>
                     <input type="file" name="image">
                 </td>
              </tr>
              <tr>
                 <td>Featured</td>
                 <td>
                     <input <?php if($featured == "Yes"){echo "Checked";} ?> type="radio" name="featured" value="Yes">Yes
                     <input <?php if($featured == "No"){echo "Checked";} ?> type="radio" name="featured" value="No">No
                 </td>
              </tr>
              <tr>
                 <td>Active</td>
                 <td>
                     <input <?php if($active == "Yes"){echo "Checked";} ?> type="radio" name="active" value="Yes">Yes
                     <input <?php if($active == "No"){echo "Checked";} ?> type="radio" name="active" value="No">No
                 </td>
              </tr>
               <tr>
                    <td colspan="2">
                        <input type="hidden" name="current_image" value="<?php echo $current_image; ?>">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="submit" name="submit" value="update category" class="update-btn">
                    </td>
                </tr>
           </table>
        </form>

        <?php
        if(isset($_POST['submit'])){
            $id = $_POST['id'];
            $title = $_POST['title'];
            $current_image = $_POST['current_image'];
            $featured = $_POST['featured'];
            $active = $_POST['active'];

            //update new image
            //check if the image is selected
            if(isset($_FILES['image']['name'])){
                //get image details
                $image_name = $_FILES['image']['name'];

                if($image_name != ""){
                    //upload new image

                    //auto renaming images
                    //get extension of an image
                    $ext = end(explode(".",$image_name));

                    //rename image
                    $image_name = "Food_Category_".rand(000,999).'.'.$ext;


                    $source_path = $_FILES['image']['tmp_name'];
                    $destination = "images/category-images/".$image_name;

                    //this will apload image
                    $upload = move_uploaded_file($source_path, $destination);

                    //check if the image is uploaded
                    if($upload==false){
                       //message
                       $_SESSION['upload'] = "<div class='failed'>Failed to upload image</div>";

                     //rediect to add category page
                       header('location:'.SITE_URL.'admin-category.php');

                       //stop the process
                       die();
                    }
                    //remove image if available
                    if($current_image!=""){
                        $remove_path = "images/category-images".$current_image;
                        $remove = unlink($remove_path);

                        if($remove==false){
                            $_SESSION['failed-remove'] = "<div class='failed'>Failed to remove current image</div>";
                            header('location:'.SITE_URL.'admin-category.php');
                            die();
                        }

                    }
                   
                }

            }
            else{
                $image_name = $current_image;
            }

            //update to db
            $query2 = "UPDATE category SET
            title = '$title',
            image = '$image_name',
            featured = '$featured',
            active = '$featured'
            WHERE id = '$id'";

            $sql2 = mysqli_query($conn, $query2);

            if($sql2==true){
                $_SESSION['update'] = "<div class='succeed'>Category is updated</div>";
                header('location:'.SITE_URL.'admin-category.php');
            }
            else{
                $_SESSION['update'] = "<div class='failed'>Failed to update category</div>";
                header('location:'.SITE_URL.'admin-category.php');
            }
        }
        ?>
    </div>
</div>

<?php include('page/footer.php');?>