<?php include('page/header.php'); ?>

<div class="content">
    <div class="contain">
        <h1>Add Category</h1><br>

        <?php 
        if(isset($_SESSION['add'])){
            echo $_SESSION['add'];
            unset($_SESSION['add']);
        }
        if(isset($_SESSION['upload'])){
            echo $_SESSION['upload'];
            unset($_SESSION['upload']);
        }
        ?><br>

        <!--add a form-->
        <form action="" method="POST" enctype="multipart/form-data"> <!--enctype allow to add images or files from file manage-->
            <table class="table-add">
                <tr>
                    <td>Title</td>
                    <td>
                        <input type="text" name="title" placeholder="category title">
                    </td>
                </tr>
                <tr>
                    <td>Select image</td>
                    <td>
                        <input type="file" name="image">
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
                        <input type="submit" name="submit" value="add category" class="update-btn">
                    </td>
                </tr>

            </table>
        </form>

        <!--end a form-->

        <?php
        //chech if tge submit btn is clicked
        if(isset($_POST['submit'])){
            //get value from category form
            $title = $_POST['title'];

            //check if the radio btn are clicked
            if(isset($_POST['featured'])){
                //get value from the form
                $featured = $_POST['featured'];
            }
            else{
                //set the default value to No
                $featured = "No";
            }

            if(isset($_POST['active'])){
                $active = $_POST['active'];
            }
            else{
                $active = "No";
            }

            //check if the image is selected and set the value for imanage name
           // print_r($_FILES['image']);

           if(isset($_FILES['image']['name'])){
               //upload image
               //we need image name, source path and destination
               $image_name = $_FILES['image']['name'];

               //upload image only if it is selected
               if($image_name != ""){
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
                   header('location:'.SITE_URL.'add-category.php');

                   //stop the process
                   die();
                }
            }

        }     
        else{
               //won't upload image
               $image_name = "";
            }

            //insert category into db
            $query="INSERT INTO category SET
            title = '$title',
            image = '$image_name',
            featured='$featured',
            active='$active'
            ";

            //execute the query
            $sql = mysqli_query($conn, $query);

            //check if the query is executed
            if($sql==true){
                $_SESSION['add'] = "<div class='succeed'>Category added successfully</div>";
                //redirect to category page
                header('location:'.SITE_URL.'admin-category.php');
            }
            else{
                //failed to add category to db
                $_SESSION['add'] = "<div class='failed'>Failed to add Category</div>";
                //redirect to category page
                header('location:'.SITE_URL.'add-category.php');
            }
        }
        ?>

    </div>

</div>


<?php include('page/footer.php'); ?>
