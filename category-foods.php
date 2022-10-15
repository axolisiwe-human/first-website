<?php include('header1.php'); ?>

<?php 
  if(isset($_GET['category_id'])){
      $category_id = $_GET['category_id'];

      $query = "SELECT title FROM category WHERE id=$category_id";
      $sql = mysqli_query($conn, $query);
      $row = mysqli_fetch_assoc($sql);

      $category_title = $row['title'];
  }
  else{
      header('location:'.SITE_URL);
  }
?>


 <!-- Food Search Section Starts Here -->
 <section class="home-search heading-menu">
        <div class="container">

            <h2>Foods on <a href="#"><?php echo $category_title; ?></a></h2>

        </div>
    </section>
    <!-- Food Search Section Ends Here -->


     <!--Food menu starts here-->
     <section class="food-menu">
        <h1 class="heading-menu">Food Menu</h1>
        <div class="container">
            <?php
                $query1 = "SELECT * FROM food WHERE category_id=$category_id";

                $sql1 = mysqli_query($conn, $query1);
                $count1 = mysqli_num_rows($sql);
    
                if($count1>0){
                    while($row1=mysqli_fetch_assoc($sql1)){
                        $id = $row1['id'];
                        $title = $row1['title'];
                        $price = $row1['price'];
                        $description = $row1['description'];
                        $image_name = $row1['image'];
    
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
                           <a href="<?php echo SITE_URL; ?>odering.php?food_id=<?php echo $id; ?>" class="order-btn">Order now</a>
                       </div>
                   </div>
                       <?php
                    }  
                   
                }
                else{
                    echo "<div class='failed'>Food is not available</div>";
                  }
            ?>

            <div class="clearfix"></div>

        </div>
    </section>
    <!--Food menu ends here-->

<?php include('footer1.php'); ?>