<?php
include('sql/add-sql.php');
//destroy all the sessions
session_destroy();

//redirect to login page
header('location:'.SITE_URL.'login.php');
?>