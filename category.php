<?php include('header1.php'); ?>

    <!--Category section starts here-->
    <section class="category" id="category">
        <h1 class="heading-menu">Explore</h1>
        <div class="category-container">

        <?php 
            $query = "SELECT * FROM category WHERE active='Yes'";
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
                           <a href = "category-foods"><img src="images/chips.png" alt=""></a>
                           <h3><?php echo $title; ?></h3>
                       </div>
                   </div>
                    <div class="clearfix"></div>
                    
             
                 <?php
            }

           
        }
        else{
            echo "<div class='failed'>Category is not added</div>";
        }
        ?>
         </div>

       <!-- <a href="category-foods.php">
        <div class="category-container">
            <div class="product-box">
                <img class="category-image" src="images/burger with rib and becon.jpg" alt="">
                <div class="category-content">
                    <img src="images/chips.png" alt="">
                    <h3>Almighty Kota's</h3>
                </div>
            </div>
</a>
  
           
            <div class="clearfix"></div>
        </div>-->

    </section>
    <!--Categoty section ends here-->

    <?php include('footer1.php'); ?>