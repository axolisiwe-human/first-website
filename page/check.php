<?php 
//authorize access
//check if the user is logged
if(isset($_SESSION['username'])){
    $_SESSION['no-login-message'] = "<div class='failed text'>Please login to access Admin Panel</div>";
    header('location:'.SITE_URL.'login.php');
}


?>