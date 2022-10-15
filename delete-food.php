<?php 
include('sql/add-sql.php');

if(isset($_GET['id']) AND isset($_GET['image'])){
    $id = $_GET['id'];
    $image_name = $_GET['image'];

    //remove physical image file if available
    if($image_name != ""){
        $path = "images/food-images/".$image_name;
        //remove image
        $remove = unlink($path);

        if($remove==false){
            //message
            $_SESSION['remove'] = "<div class='failed'>Failed to remove image</div>";
            header('location:'.SITE_URL.'admin-food.php');

            //stop process
            die();
        }
    }

    //delete data from db
    $query = "DELETE FROM food WHERE id=$id";

    $sql = mysqli_query($conn, $query);

    if($sql == true){
        //message
        $_SESSION['delete'] = "<div class='succeed'>Food is deleted successfully</div>";

         //redirect to category page
         header('location:'.SITE_URL.'admin-food.php');

    }
    else{
        //message
        $_SESSION['delete'] = "<div class='failed'>Failed to delete food</div>";

        //redirect to category page
        header('location:'.SITE_URL.'admin-food.php');
    }

   

}
else{
    $_SESSION['unauthorized'] = "<div class='failed'>Unauthorized access</div>";
    header('location:'.SITE_URL.'admin-food.php');
}
?>