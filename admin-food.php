<?php include("page/header.php"); ?>

<div class="content">
    <div class="contain">
        <h1>Manage Food</h1>
        <br><br>
                <a href="<?php echo SITE_URL; ?>add-food.php" class="add-btn">Add Food</a>
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
                if(isset($_SESSION['unauthorized'])){
                    echo $_SESSION['unauthorized'];
                    unset($_SESSION['unauthorized']);
                }
                ?>

                <table class="table-manager">
                    <tr>
                        <th>ID</th>
                        <th>Title</th>
                        <th>Price</th>
                        <th>Image</th>
                        <th>Featured</th>
                        <th>Active</th>
                        <th>Actions</th>
                    </tr>

                    <?php
                    $query = "SELECT * FROM food";

                    $sql = mysqli_query($conn, $query);

                    $count = mysqli_num_rows($sql);
                    $food_id = 1;

                    if($count>0){
                        while($row=mysqli_fetch_assoc($sql)){
                            $id = $row['id'];
                            $title = $row['title'];
                            $price = $row['price'];
                            $image_name = $row['image'];
                            $featured = $row['featured'];
                            $active = $row['active'];

                            ?>
                              <tr>
                                    <td><?php echo $food_id++; ?></td>
                                     <td><?php echo $title; ?></td>
                                    <td><?php echo $price; ?></td>
                                    <td>
                                        <?php
                                           if($image_name == ""){
                                              echo "<div class='failed'>Image is not added</div>";
                                            }
                                            else{
                                               //display image
                                             ?>
                                               <img src="<?php echo SITE_URL; ?>images/food-images/<?php echo $image_name; ?>" width="100px">
                                             <?php
                                            }
                                        ?>
                                    </td>
                                    <td><?php echo $featured; ?></td>
                                    <td><?php echo $active; ?></td>
                                    <td>
                                       <a href="<?php echo SITE_URL; ?>update-food.php?id=<?php echo $id;?>&image=<?php echo$image_name; ?>" class="update-btn">Update food</a>
                                       <a href="<?php echo SITE_URL; ?>delete-food.php?id=<?php echo $id;?>&image=<?php echo$image_name; ?>" class="delete-btn">Delete food</a>
                                    </td>
                              </tr>
                            <?php
                        }

                    }
                    else{
                        echo "<tr><td colspan='2' class='failed'>Food is not added</td></tr>";
                    }
                    ?>
                  
                </table>
    </div>
</div>
<?php include("page/footer.php"); ?>