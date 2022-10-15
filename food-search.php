<?php include('header1.php'); ?>


  <!-- Food Search Section Starts Here -->
  <section class="home-search heading-menu">
        <div class="container">

        <?php 
        
            $search = $_POST['search'];
        ?>

            <h2>You have searched for <a href="#"><?php echo $search; ?></a></h2>

        </div>
    </section>
    <!-- Food Search Section Ends Here -->


     <!--Food menu starts here-->
     <section class="food-menu">
        <h1 class="heading-menu">Food Menu</h1>
        <div class="container">

        <?php 
        
        

            $query = "SELECT * FROM food WHERE title LIKE '%$search%' OR description LIKE '%$search'";
            $sql = mysqli_query($conn, $query);
            $count = mysqli_num_rows($sql);

            if($count>0){
                while($row=mysqli_fetch_assoc($sql)){
                    $id = $row['id'];
                    $title = $row['title'];
                    $price = $row['price'];
                    $description = $row['description'];
                    $image_name = $row['image'];

                ?>
                    <div class="food-menu-box">
                      <div class="food-menu-image">
                       <?php
                          if($image_name == ""){
                              echo "<div class='failed'>Image is not available</div>";
                            }
                          else{
                             ?>
                                <img src="<?php echo SITE_URL; ?>images/food-images/<?php echo $image_name; ?>" alt="">
   
                             <?php
                            }
                           ?>
                         </div>
                         <div class="food-menu-boxes">
                              <h3><?php echo $title; ?></h3>
                              <p class="food-info"><?php echo $description; ?></p>
                              <p class="food-price"><?php echo $price; ?></p>
                              <br>
                              <a href="<?php echo SITE_URL; ?>odering.php?food_id=<?php echo $id;?>" class="order-btn">Order now</a>
                         </div>
                 </div>
                <?php
            }
        }
        else{
            echo "<div class='failed'>Food not found</div>";
        }
        ?>
            <div class="clearfix"></div>

        </div>
    </section>
    <!--Food menu ends here-->



<?php include('footer1.php'); ?>