<?php include('page/header.php'); ?>

<div class="content">
    <div class="contain">
        <h1>Update order</h1>
        <br>
        <?php 
        
            if(isset($_GET['id'])){
                $id = $_GET['id'];

                $query = "SELECT * FROM ordering WHERE id = $id";
                $sql = mysqli_query($conn, $query);
                $count = mysqli_num_rows($sql);

                if($count==1){
                    $row=mysqli_fetch_assoc($sql);
                    $food_name = $row['food_name'];
                    $price = $row['price'];
                    $qauntity = $row['quantity'];
                    $status = $row['status'];
                    $customer_name = $row['customer_name'];
                    $customer_contact = $row['customer_contact'];
                    $customer_email = $row['customer_email'];
                    $customer_address = $row['customer_address'];
                }
                else{
                    header('location:'.SITE_URL.'admin-order.php');
                }
            }
            else{
                header('location:'.SITE_URL.'admin-order.php');
            }
        ?>

        <form action="" method="POST">
            <table class="table-add">
                <tr>
                    <td>Food name</td>
                    <td><?php echo $food_name; ?></td>
                </tr>
                <tr>
                    <td>Price</td>
                    <td>R<?php echo $price; ?></td>
                </tr>
                <tr>
                    <td>Quantity</td>
                    <td>
                        <input type="number" name="quantity" value="<?php echo $qauntity; ?>">
                    </td>
                </tr>
                <tr>
                    <td>status</td>
                    <td>
                        <select name="status">
                            <option <?php if($status=="Ordered"){echo "selected";} ?> value="Ordered">Ordered</option>
                            <option <?php if($status=="On Delivery"){echo "selected";} ?> value="On Delivery">On delivery</option>
                            <option <?php if($status=="Delivered"){echo "selected";} ?> value="Delivered">Delivered</option>
                            <option <?php if($status=="Cancelled"){echo "selected";} ?> value="Cancelled">Cancelled</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Customer name</td>
                    <td>
                        <input type="text" name="customer_name" value="<?php echo $customer_name; ?>">
                    </td>
                </tr>
                <tr>
                    <td>Customer contact</td>
                    <td>
                        <input type="text" name="customer_contact" value="<?php echo $customer_contact; ?>">
                    </td>
                </tr>
                <tr>
                    <td>Customer email</td>
                    <td>
                        <input type="email" name="customer_email" value="<?php echo $customer_email; ?>">
                    </td>
                </tr>
                <tr>
                    <td>Customer address</td>
                    <td>
                        <textarea type="text" name="customer_address" cols="30" rows="5"><?php echo $customer_address; ?></textarea>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="hidden" name="price" value="<?php echo $price; ?>">

                        <input type="submit" name="submit" value="update order" class="update-btn">
                    </td>
                </tr>
            </table>
        </form>

        <?php
            if(isset($_POST['submit'])){
                $id = $_POST['id'];
                $price = $_POST['price'];
                $quantity = $_POST['quantity'];
  
                $total = $price * $quantity;
  
                $status = $_POST['status'];
                $customer_name = $_POST['customer_name'];
                $customer_contact = $_POST['customer_contact'];
                $customer_email = $_POST['customer_email'];
                $customer_address = $_POST['customer_address'];

                $query1 = "UPDATE ordering SET
                quantity = $quantity,
                total = $total,
                status = '$status',
                customer_name = '$customer_name',
                customer_contact = '$customer_contact',
                customer_email = '$customer_email',
                customer_address = '$customer_address'
                WHERE id = $id";

                $sql1 = mysqli_query($conn, $query1);

                if($sql1 == true){
                     $_SESSION['update'] = "<div class='succeed'>Food order is successful</div>";
                     header('location:'.SITE_URL.'admin-order.php');
                 }
                else{
                $_SESSION['update'] = "<div class='failed'>Food order failed</div>";
                header('location:'.SITE_URL.'admin-order.php');
                }
            }
        ?>
    </div>
</div>

<?php include('page/footer.php'); ?>