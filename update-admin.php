<?php include('page/header.php');?>

<div class="content">
    <div class="contain">
        <h1>Update Admin</h1>
        <br>
        <br>
        <?php
        //get id of selected admin
        $id=$_GET['id'];

        //create sql query to get details
        $query = "SELECT * FROM admin";

        //execute query
        $sql=mysqli_query($conn,$query);

        //chech if the query is executed
        if($sql==true){
            //check if the a=date is available
            $count = mysqli_num_rows($sql);

            //check if we have admin data
            if($count==1){
                //echo "Admin is available";

                $row = mysqli_fetch_assoc($sql);

                $fname = $row['name'];
                $username = $row['username'];
            }
            else{
                //echo "Admin is unavailable";
                //direct to manage admin page
                header('location:' .SITE_URL. 'manager.php');
            }
        }
        ?>
        <form action="" method="POST">
            <table class="table-add">
                <tr>
                    <td>Name:</td>
                    <td>
                        <input type="text" name="fname" value="<?php echo $fname; ?>">
                    </td>
                </tr>

                <tr>
                    <td>Username:</td>
                    <td>
                        <input type="text" name="username" value="<?php echo $username; ?>">
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="submit" name="submit" value="Update Admin" class="add-btn">
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>

<?php 
//cheking if the submit button is clicked
if(isset($_POST['submit'])){
    //echo "button clicked";

    //get values from form to update
    $id = $_POST['id'];
    $fname = $_POST['fname'];
    $username = $_POST['username'];

    //update admin with sql query
    $query = "UPDATE admin SET name = '$fname',
    username = '$username' WHERE id='$id'";

    //execute
    $sql = mysqli_query($conn, $query);

    //check if the query is executed
    if($sql==true){
        //update admin
        $_SESSION['update'] = "<div class='succeed'>Admin updated successfully</div>";
        header('location:' .SITE_URL. 'manager.php');
    }
    else{
        //failed
        $_SESSION['update'] = "<div class='failed'>Update Failed</div>";
        header('location:' .SITE_URL. 'manager.php');

    }
}
?>

<?php include('page/footer.php');?>