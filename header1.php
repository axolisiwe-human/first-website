<?php include('sql/add-sql.php');?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nenes</title>
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" />
    
    <link rel="stylesheet" href="styler.css"/>
  
    
</head>
<body>
  <!--header section-->
  <header>
      <a href="#" class="logo"><i class="fas fa-utensils"></i>Nenes</a>

      <div id="menubar" class= "fas fa-bars"></div>

      <nav class="navbar">
          <a href="<?php echo SITE_URL; ?>index1.php">Home</a>
          <a href="<?php echo SITE_URL; ?>category.php">Explore</a>
          <a href="<?php echo SITE_URL; ?>menu.php">Menu</a>
          <a href="<?php echo SITE_URL;?>login.php">Admin</a>
      </nav>
  </header>
  <!--header section ends-->