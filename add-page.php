<?php include("page/header.php");?>
<div class="content">
    <div class="contain">
        <h1>Add Admin</h1><br><br>

        <?php
                if(isset($_SESSION['add'])){
                    echo $_SESSION['add']; //show a message
                    unset($_SESSION['add']); //remove a message
                }

                ?><br><br>
                
        <form action="" method="POST">
            <table class="table-add">
                <tr>
                    <td>Name:</td>
                    <td><input type="text" name="fname" placeholder="enter your full name"></td>
                </tr>
                <tr>
                    <td>Username:</td>
                    <td><input type="text" name="username" placeholder="enter your username"></td>
                </tr>
                <tr>
                    <td>Password:</td>
                    <td><input type="password" name="password" placeholder="enter your password"></td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Admin" class="add-btn">
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>
<?php include("page/footer.php");?>

<?php
//process value and save it in db

//check if submit button is clicked

if(isset($_POST['submit'])){
    $ful_name = $_POST['fname'];
    $username = $_POST['username'];
    $password = md5($_POST['password']); //encrypt password by md5

    //save to db
    $query = "INSERT INTO admin SET name='$ful_name',
    username = '$username',
    password = '$password'";

    //execute query and save it to db
    $sql = mysqli_query($conn, $query);//

    //check if query is executed or not to the db and display a message
    if($sql==true){
        //create a session variable to display message
        $_SESSION['add'] = "<div class='succeed'>Admin is added successfully</div>";
        //redirect to this below page
        header("location:".SITE_URL.'manager.php');
    }
    else{
          //create a session variable to display message
          $_SESSION['add'] = "<div class='failed'>Adding admin failed</div>";
          //redirect to this below page
          header("location:".SITE_URL.'manager.php');
    }
}
?>