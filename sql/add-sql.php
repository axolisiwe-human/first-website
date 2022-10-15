<?php
//start session
session_start();

//create const
define('SITE_URL', 'http://localhost/project/');
define('LOCALHOST','localhost');
define('DB_USERNAME','root');
define('DB_PASSWORD', 'Password@1');
define('DB_NAME', 'nenes');

 //connect to db
 $conn = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD, DB_NAME);// or die(mysqli_error());
 $select_db = mysqli_select_db($conn,DB_NAME);
?>