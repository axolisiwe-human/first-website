
   <?php include('header1.php'); ?>

   <?php
   if(isset($_GET['food_id'])){
       $food_id = $_GET['food_id'];

       $query = "SELECT * FROM food WHERE id = $food_id";
       $sql = mysqli_query($conn, $query);
       $count = mysqli_num_rows($sql);

       if($count>0){
           $row = mysqli_fetch_assoc($sql);

           $food_id = $row['id'];
           $title = $row['title'];
           $price = $row['price'];
           $image_name = $row['image'];
       }
       else{
           header('location:'.SITE_URL);
       }

   }
   else{
       header('location:'.SITE_URL);
   }
   
   ?>

  <!--search section starts-->
  <section class="home-search">
      <div class="container">
          <h2 class="heading-menu">Confirm your order</h2>
          <form action="" method="POST" class="order">
              <fieldset>
                  <legend>Select your choice</legend>
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
                  <div class="food-menu-box">
                      <h3><?php echo $title; ?></h3>
                      <input type="hidden" name="food" value="<?php echo $title; ?>">

                      <p class="food-price"><?php echo $price; ?></p>
                      <input type="hidden" name="price" value="<?php echo $price; ?>">

                      <div class="order-label">Quantity</div>
                      <input type="number" name="quantity" value="1" class="input-responsive" required>
                  </div>
              </fieldset>
              <fieldset>
                <legend>Delivery Details</legend>

                <div class="order-label">Full Name</div>
                <input type="text" name="full-name" placeholder="" class="input-responsive" required>

                <div class="order-label">Phone Number</div>
                <input type="tel" name="contact" placeholder="" class="input-responsive" required>

                <div class="order-label">Email</div>
                <input type="email" name="email" placeholder="" class="input-responsive" required>

                <div class="order-label">Address</div>
                <textarea name="address" rows="10" placeholder="" class="input-responsive" required></textarea>

                <input type="submit" name="submit" value="Confirm Order" class="order-btn">
              </fieldset>

          </form>

          <?php
          if(isset($_POST['submit'])){
              $food = $_POST['food'];
              $price = $_POST['price'];
              $quantity = $_POST['quantity'];

              $total = $price * $quantity;
              $order_date = date('y-m-d h:i:s');

              $status = "Ordered";
              $customer_name = $_POST['full-name'];
              $customer_contact = $_POST['contact'];
              $customer_email = $_POST['email'];
              $customer_address = $_POST['address'];

              $query3 = "INSERT INTO ordering SET
              food_name = '$food',
              price = $price,
              quantity = $quantity,
              total = $total,
              date = '$order_date',
              status = '$status',
              customer_name = '$customer_name',
              customer_contact = '$customer_contact',
              customer_email = '$customer_email',
              customer_address = '$customer_address'
              ";
              /*$query3 = "INSERT INTO order (food_name, price, quantity, total, date, status, customer_name, customer_contact, customer_email, customer_address)
              VALUE('$food',$price, $quantity, $total, '$order_date', '$status', '$customer_name', '$customer_contact', '$customer_email', '$customer_address')";*/

              $sql3 = mysqli_query($conn, $query3);

              if($sql3 == true){
                  $_SESSION['order'] = "<div class='succeed heading-menu'>Food order is successful</div>";
                  header('location:'.SITE_URL.'index1.php');
              }
              else{
                $_SESSION['order'] = "<div class='failed heading-menu'>Food order failed</div>";
                header('location:'.SITE_URL.'index1.php');
              }
            }
          ?>

      </div>
  </section>
    <!--search section ends-->

   <?php include('footer1.php'); ?>