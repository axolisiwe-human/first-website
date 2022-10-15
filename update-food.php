<?php include('page/header.php');?>

<div class="content">
    <div class="contain">
        <h1>Update food</h1><br>

        <?php
        //check if the id is set
        if(isset($_GET['id'])){
            //get id and other info
            $id = $_GET['id'];

            $query2 = "SELECT * FROM food WHERE id='$id'";
            $sql2 = mysqli_query($conn, $query2);
            //$count = mysqli_num_rows($sql2);

            //if($count>0){
                //get all data
                $row2 = mysqli_fetch_assoc($sql2);

                $title = $row2['title'];
                $description = $row2['description'];
                $price = $row2['price'];
                $current_image = $row2['image'];
                $current_category = $row2['category_id'];
                $featured = $row2['featured'];
                $active = $row2['active'];
           // }
            //else{
             //   $_SESSION['no-food-found'] = "<div class='failed'>Food not found</div>";
            //    header('location:'.SITE_URL.'admin-food.php');
           // }
        }
        else{
            header('location:'.SITE_URL.'admin-food.php');
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
                    <td>Description</td>
                    <td>
                        <textarea name="description" cols="30" ><?php echo $description; ?></textarea>
                    </td>
                </tr>
                <tr>
                    <td>Price</td>
                    <td>
                        <input type="number" name="price" value="<?php echo $price; ?>"> 
                    </td>
                </tr>
              <tr>
                 <td>Current image</td>
                  <td>
                      <?php
                          if($current_image != ""){
                               //display image
                              ?>
                                 <img src="<?php echo SITE_URL; ?>images/food-images/<?php echo $current_image; ?>" width="150px">
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
                    <td>Category</td>
                    <td>
                        <select name="category_id">

                        <?php 
                        //display categories from db
                        $query = "SELECT * FROM category WHERE active='Yes'";
                        $sql = mysqli_query($conn, $query);
                        $count = mysqli_num_rows($sql);

                        if($count>0){
                            while($row=mysqli_fetch_assoc($sql)){
                                $category_id = $row['id'];
                                $category_title = $row['title'];

                                ?>
                                <option <?php if($current_category==$category_id){echo "selected";} ?> value="<?php echo $category_id; ?>"><?php echo $category_title; ?></option>
                                <?php

                            }

                        }
                        else{
                            //we don't have categories
                            ?>
                            <option value="0">No category found</option>
                            <?php
                        }
                        ?>
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
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="hidden" name="current_image" value="<?php echo $current_image; ?>">
                        <input type="submit" name="submit" value="update food" class="update-btn">
                    </td>
                </tr>
           </table>
        </form>

        <?php
        if(isset($_POST['submit'])){
            //get details from the form
            $id = $_POST['id'];
            $title = $_POST['title'];
            $description = $_POST['description'];
            $price = $_POST['price'];
            $current_image = $_POST['current_image'];
            $category_id = $_POST['category_id'];
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
                    $image_name = "Food_name_".rand(000,999).'.'.$ext;


                    $src_path = $_FILES['image']['tmp_name'];
                    $dest_path = "images/food-images/".$image_name;

                    //this will apload image
                    $upload = move_uploaded_file($src_path, $dest_path);

                    //check if the image is uploaded
                    if($upload==false){
                       //message
                       $_SESSION['upload'] = "<div class='failed'>Failed to upload image</div>";

                     //rediect to add category page
                       header('location:'.SITE_URL.'admin-food.php');

                       //stop the process
                       die();
                    }
                    //remove image if available
                    if($current_image!=""){
                        $remove_path = "images/food-images".$current_image;
                        $remove = unlink($remove_path);

                        if($remove==false){
                            $_SESSION['failed-remove'] = "<div class='failed'>Failed to remove current image</div>";
                            header('location:'.SITE_URL.'admin-food.php');
                            die();
                        }

                    }
                   
                }
                else{
                    $image_name = $current_image;
                }

            }
            else{
                $image_name = $current_image;
            }

            //update to db
            $query3 = "UPDATE food SET
            title = '$title',
            description = '$description',
            price = $price,
            image = '$image_name',
            category_id = $category_id,
            featured = '$featured',
            active = '$featured'
            WHERE id = $id";

            $sql3 = mysqli_query($conn, $query3);

            if($sql3==true){
                $_SESSION['update'] = "<div class='succeed'>Food is updated</div>";
                header('location:'.SITE_URL.'admin-food.php');
            }
            else{
                $_SESSION['update'] = "<div class='failed'>Failed to update food</div>";
                header('location:'.SITE_URL.'admin-food.php');
            }
        }
        ?>
    </div>
</div>

<?php include('page/footer.php');?>