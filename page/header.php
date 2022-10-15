<?php 
include("sql/add-sql.php"); 
include("check.php");
?>

<!DOCTYPE html>
<html lang="en">
    <head>
         <meta charset="UTF-8">
         <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Admin page</title>
        <link rel="stylesheet" href="admin.css">
    </head>
    <body>
        <!--menu starts-->
        <div class="menu text">
            <div class="contain">
                <ul>
                    <li><a href="admin.php">Home</a></li>
                    <li><a href="manager.php">Admin</a></li>
                    <li><a href="admin-category.php">Category</a></li>
                    <li><a href="admin-food.php">Food</a></li>
                    <li><a href="admin-order.php">Order</a></li>
                    <li><a href="logout.php">Logout</a></li>
                </ul>

            </div>

        </div>

        <!--menu ends-->