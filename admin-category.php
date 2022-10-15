<?php include("page/header.php"); ?>

<div class="content">
    <div class="contain">
        <h1>Manage Category</h1>
        <br><br>

         <?php 
        if(isset($_SESSION['add'])){
            echo $_SESSION['add'];
            unset($_SESSION['add']);
        }
        if(isset($_SESSION['remove'])){
            echo $_SESSION['remove'];
            unset($_SESSION['remove']);
        }
        if(isset($_SESSION['delete'])){
            echo $_SESSION['delete'];
            unset($_SESSION['delete']);
        }
        if(isset($_SESSION['no-category-found'])){
            echo $_SESSION['no-category-found'];
            unset($_SESSION['no-category-found']);
        }
        if(isset($_SESSION['update'])){
            echo $_SESSION['update'];
            unset($_SESSION['update']);
        }
        if(isset($_SESSION['upload'])){
            echo $_SESSION['upload'];
            unset($_SESSION['upload']);
        }
        if(isset($_SESSION['failed-remove'])){
            echo $_SESSION['failed-remove'];
            unset($_SESSION['failed-remove']);
        }
        ?><br>
                <a href="<?php echo SITE_URL;?>add-category.php" class="add-btn">Add Category</a>
                <br><br>
                <table class="table-manager">
                    <tr>
                        <th>ID</th>
                        <th>Title</th>
                        <th>Image</th>
                        <th>Featured</th>
                        <th>Active</th>
                        <th>Action</th>
                    </tr>

                    <?php 
                    $query = "SELECT * FROM category";

                    $sql = mysqli_query($conn, $query);

                    $count = mysqli_num_rows($sql);

                    //craete id no.
                    $id_no = 1;

                    if($count>0){
                        //we have data
                        //get & display data
                        while($row=mysqli_fetch_assoc($sql)){
                            $id = $row['id'];
                            $title = $row['title'];
                            $image_name = $row['image'];
                            $featured = $row['featured'];
                            $active = $row['active'];

                            ?>

                              <tr>
                                    <td><?php echo $id_no++; ?></td>
                                    <td><?php echo $title; ?></td>
                                    <td>
                                        <?php
                                        //check if the image is available
                                        if($image_name!=""){
                                            //display image
                                            ?>
                                            <img src="<?php echo SITE_URL; ?>images/category-images/<?php echo $image_name; ?>" width="100px">
                                            <?php
                                        }
                                        else{
                                            //message
                                            echo "<div class='failed'>Image is not added</div>";
                                        }
                                        
                                        ?>
                                    </td>
                                    <td><?php echo $featured; ?></td>
                                    <td><?php echo $active; ?></td>
                                    <td>
                                       <a href="<?php echo SITE_URL; ?>update-category.php?id=<?php echo $id;?>" class="update-btn">Update category</a>
                                       <a href="<?php echo SITE_URL; ?>delete-category.php?id=<?php echo $id;?>&image=<?php echo$image_name; ?>" class="delete-btn">Delete category</a>
                                    </td>
                              </tr>

                            <?php
                        }

                    }
                    else{
                        //don't have data
                        //display the message inside table
                        ?>
                        <tr>
                            <td colspan="6"><div class="failed">No category added</div></td>
                        </tr>

                        <?php

                    }
                    ?>
                  
                </table>
    </div>
</div>
<?php include("page/footer.php"); ?>