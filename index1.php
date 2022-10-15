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
    <?php
      if(isset($_SESSION['order'])){
          echo $_SESSION['order'];
          unset($_SESSION['order']);
      }
     
    ?>

    <!--Category section starts here-->
    <section class="category" id="category">
        <h1 class="heading-menu">Explore</h1>
        <div class="category-container">

        <?php 
            $query = "SELECT * FROM category WHERE active='Yes' AND featured='Yes' LIMIT 3";
            $sql = mysqli_query($conn, $query);
            $count = mysqli_num_rows($sql);

        if($count>0){
            while($row=mysqli_fetch_assoc($sql)){
                $id = $row['id'];
                $title = $row['title'];
                $image_name = $row['image'];

               ?>
           
                <div class="product-box">
                    <?php
                        if($image_name == ""){
                               echo "<div class='failed'>Image is no available</div>";
                        }
                        else{
                            ?>
                                 <a href="<?php echo SITE_URL; ?>category-foods.php?category_id=<?php echo $id;?>" ><img class="category-image" src="<?php echo SITE_URL; ?>images/category-images/<?php echo $image_name; ?>" alt=""></a>
     
                            <?php
                         }
                       ?>
                      
                       <div class="category-content">
                           <a href="<?php echo SITE_URL; ?>category-foods.php?category_id=<?php echo $id;?>" ><img src="images/chips.png" alt=""></a>
                           <h3><?php echo $title; ?></h3>
                       </div>
                   </div>
                    <!--<div class="clearfix"></div>-->
             
                 <?php
            }

           
        }
        else{
            echo "<div class='failed'>Category is not added</div>";
        }
        ?>
         </div>

       

    </section>
    <!--Categoty section ends here-->


    <!--Food menu starts here-->
    <section class="food-menu">
        <h1 class="heading-menu">Food Menu</h1>
        <div class="container">
        <?php 
            
            $query1 = "SELECT * FROM food WHERE active='Yes' LIMIT 10";

            $sql1 = mysqli_query($conn, $query1);
            $count1 = mysqli_num_rows($sql1);

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
                       <a href="<?php echo SITE_URL; ?>odering.php?food_id=<?php echo $id;?>" class="order-btn">Order now</a>
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
