<?php include("page/header.php"); ?>

<div class="content">
    <div class="contain">
        <h1>Manage Order</h1>
        <br><br>
        <?php
            if(isset($_SESSION['update'])){
                echo $_SESSION['update'];
                unset($_SESSION['update']);
            }
        ?><br>
                <table class="table-manager">
                    <tr>
                        <th>ID</th>
                        <th>Food</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Total</th>
                        <th>Date</th>
                        <th>Status</th>
                        <th>Customer Name</th>
                        <th>Customer Contact</th>
                        <th>Customer Email</th>
                        <th>Customer Address</th>
                        <th>Actions</th>
                    </tr>
                    <?php 
                        $query = "SELECT * FROM ordering ORDER BY id DESC";
                        $sql = mysqli_query($conn, $query);
                        $count = mysqli_num_rows($sql);

                        $number = 1;

                        if($count>0){
                            while($row = mysqli_fetch_assoc($sql)){
                                $id = $row['id'];
                                $food_name = $row['food_name'];
                                $price = $row['price'];
                                $quantity = $row['quantity'];
                                $total = $row['total'];
                                $date = $row['date'];
                                $status = $row['status'];
                                $customer_name = $row['customer_name'];
                                $customer_contact = $row['customer_contact'];
                                $customer_email = $row['customer_email'];
                                $customer_address = $row['customer_address'];

                                ?>
                                     <tr>
                                        <td><?php echo $number++; ?></td>
                                        <td><?php echo $food_name; ?></td>
                                        <td><?php echo $price; ?></td>
                                        <td><?php echo $quantity; ?></td>
                                        <td><?php echo $total; ?></td>
                                        <td>
                                            <?php echo $date; ?>
                                        </td>
                                        <td>
                                            <?php 
                                                if($status=="Ordered"){
                                                    echo "<label>$status</label>";
                                                }
                                                elseif($status=="On Delivery"){
                                                    echo "<label style='color:orange'>$status</label>";
                                                }
                                                elseif($status=="Delivered"){
                                                    echo "<label style='color:green'>$status</label>";
                                                }
                                                elseif($status=="Cancelled"){
                                                    echo "<label style='color:red'>$status</label>";
                                                }
                                                ?>
                                        </td>
                                        <td><?php echo $customer_name; ?></td>
                                        <td><?php echo $customer_contact; ?></td>
                                        <td><?php echo $customer_email; ?></td>
                                        <td><?php echo $customer_address; ?></td>
                                        <td>
                                            <a href="<?php echo SITE_URL; ?>order-update.php?id=<?php echo $id; ?>" class="update-btn">Update</a>
                                        </td>
                                    </tr>

                                <?php

                            }
                        }
                        else{
                            echo "<tr colspan='12' class='failed'>Orders not placed</tr>";
                        }
                    ?>
                   
                </table>
    </div>
</div>
<?php include("page/footer.php"); ?>