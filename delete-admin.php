<?php 

  //link sql page
  include('sql/add-sql.php');
  //get the admin's Id to be deleted
  $id= $_GET['id'];

  //sql query to delete admin
  $query="DELETE FROM admin WHERE id=$id";

  //execute query
  $sql = mysqli_query($conn, $query);

  //chech if query is executed
  if($sql==true){
      //admin deleted
      //display a message
      $_SESSION['delete'] = "<div class='succeed'>Admin is deleted successfully</div>";
      //direct to manage admin page
      header('location:'.SITE_URL.'manager.php');
  }
  else{
      //failed to delete admin
      //echo "failed to delete";
      $_SESSION['delete'] = "<div class='failed'>Failed to delete admin</div>";
      header('location:'.SITE_URL.'manager.php');
  }

  //redirect to manage admin page with a message eg. success/error

?>