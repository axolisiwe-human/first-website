<?php include('header1.php'); ?>

<!--search section starts-->
<section class="home-search">
      <div class="container">
          <form action="<?php echo SITE_URL; ?>food-search.php" method="POST">
              <input type="search" name="search" placeholder="Search food" class="search-box">
              <input type="submit" name="submit" class="submit-btn">
          </form>
      </div>
  </section>
    <!--search section ends-->

    <!--Food menu starts here-->
    <section class="food-menu">
        <h1 class="heading-menu">Food Menu</h1>
        <div class="container">

            <?php 
            
            $query = "SELECT * FROM food WHERE active='Yes' LIMIT 10";

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