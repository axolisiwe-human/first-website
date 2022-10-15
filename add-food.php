<?php include('page/header.php');?>
<div class="content">
    <div class="contain">
        <h1>Add Foods</h1><br>

        <?php 
        if(isset($_SESSION['upload'])){
            echo $_SESSION['upload'];
            unset($_SESSION['upload']);
        }
        ?>

        <form action="" method="post" enctype="multipart/form-data">
            <table class="table-add">
                <tr>
                    <td>Title</td>
                    <td>
                        <input type="text" name="title" placeholder=""> 
                    </td>
                </tr>
                <tr>
                    <td>Description</td>
                    <td>
                        <textarea name="description" placeholder=""></textarea>
                    </td>
                </tr>
                <tr>
                    <td>Price</td>
                    <td>
                        <input type="number" name="price" placeholder=""> 
                    </td>
                </tr>
                <tr>
                    <td>Image</td>
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
                                $id = $row['id'];
                                $title = $row['title'];

                                ?>
                                <option value="<?php echo $id; ?>"><?php echo $title; ?></option>
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
                        <input type="radio" name="featured" value="Yes">Yes
                        <input type="radio" name="featured" value="No">No 
                    </td>
                </tr>
                <tr>
                    <td>Active</td>
                    <td>
                       <input type="radio" name="active" value="Yes">Yes
                        <input type="radio" name="active" value="No">No 
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="add food" class="update-btn">
                    </td>
                </tr>
            </table>

        </form>

        <?php
        //check if the submit btn is clicked
        if(isset($_POST['submit'])){

            //get data from form
            $title = $_POST['title'];
            $description = $_POST['description'];
            $price = $_POST['price'];
            $category_id = $_POST['category_id'];

            //check if features and active are checked
            if(isset($_POST['featured'])){
                $featured = $_POST['featured'];
            }
            else{
                $featured = "No";
            }

            if(isset($_POST['active'])){
                $active = $_POST['active'];
            }
            else{
                $active = "No";
            }
            //upload image
            if(isset($_FILES['image']['name'])){
                $image_name = $_FILES['image']['name'];

                if($image_name != ""){
                    //image is selected
                    $ext = end(explode('.', $image_name));

                    //rename image
                    $image_name = "Food_name_".rand(000,999).'.'.$ext;


                    $source = $_FILES['image']['tmp_name'];
                    $dest = "images/food-images/".$image_name;

                 //this will apload image
                    $upload = move_uploaded_file($source, $dest);

                     //check if the image is uploaded
                   if($upload==false){
                     //message
                       $_SESSION['upload'] = "<div class='failed'>Failed to upload image</div>";

                     //rediect to add category page
                       header('location:'.SITE_URL.'add-food.php');

                      //stop the process
                      die();
                    }
                }

            }
            else{
                $image_name = "";
            }

            $query2 = "INSERT INTO food SET
            title = '$title',
            description = '$description',
            price = $price,
            image = '$image_name',
            category_id = $category_id,
            featured = '$featured',
            active = '$active'";

            $sql2 = mysqli_query($conn, $query2);

            if($sql2==true){
                $_SESSION['add'] = "<div class='succeed'>Food is added successfully</div>";
                //redirect to category page
                header('location:'.SITE_URL.'admin-food.php');
            }
            else{
                //failed to add category to db
                $_SESSION['add'] = "<div class='failed'>Failed to add food</div>";
                //redirect to category page
                header('location:'.SITE_URL.'admin-food.php');
            }

        }
        ?>
    </div>
</div>

<?php include('page/footer.php');?>