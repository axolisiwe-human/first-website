<?php include("page/header.php");?>
        
        <!--content starts-->
        <div class="content">
            <div class="contain">
                <h1>Dashboard</h1>
        <br><br>
        <?php
            if(isset($_SESSION['login'])){
                echo $_SESSION['login'];
                unset($_SESSION['login']);
            }
        ?>
        <br><br>
        <?php
            $query="SELECT * FROM category";
            $sql = mysqli_query($conn, $query);
            $count = mysqli_num_rows($sql);

        ?>

                <div class="block text">
                    <h1><?php echo $count; ?></h1>
                    Categories
                </div>

                <div class="block text">
                <?php
                    $query1="SELECT * FROM food";
                    $sql1 = mysqli_query($conn, $query1);
                    $count1 = mysqli_num_rows($sql1);

                ?>
                    <h1><?php echo $count1; ?></h1>
                    Foods
                </div>

                <div class="block text">
                <?php
                    $query2="SELECT * FROM ordering";
                    $sql2 = mysqli_query($conn, $query2);
                    $count2 = mysqli_num_rows($sql2);

                ?>
                    <h1><?php echo $count2; ?></h1>
                    Orders
                </div>
                <div class="block text">
                <?php
                    $query3="SELECT SUM(total) AS total FROM ordering WHERE status = 'Delivered'";
                    $sql3 = mysqli_query($conn, $query3);
                    $row = mysqli_fetch_assoc($sql3);

                    $total = $row['total'];

                ?>
                    <h1>R<?php echo $total; ?></h1>
                    Total amount
                </div>

                <div class="clearfix"></div>
            </div>

        </div>
        <!--content ends-->

     <?php include("page/footer.php");?>