<?php include('sql/add-sql.php');?>

<!DOCTYPE html>
<html>
    <head>
        <title>Login User</title>
        <link rel = "stylesheet" href="admin.css">
    </head>
    <body>
        <div class="login">
            <h1 class="text">Login</h1><br>

            <?php
            if(isset($_SESSION['login'])){
                echo $_SESSION['login'];
                unset($_SESSION['login']);
            }
            if(isset($_SESSION['no-login-message'])){
                echo $_SESSION['no-login-message'];
                unset($_SESSION['no-login-message']);
            }
            ?>
            <br>
            <form action="" method="POST" class="text">
                <h4>Username</h4>
                <input type="text" name="username" placeholder="enter username">
                <h4>Password</h4>
                <input type="password" name="password" placeholder="enter password">
                <table class="login-table">
                    <tr>
                        <td><input type="submit" name="submit" value="login" class="add-btn"></td>
                        <td><a href="add-page.php" class="register">register</a></td><br>
                    </tr>
                    <tr>
                         <section class="social">
                             <div class="container heading-menu">
                                
                               <ul>
                                   <td>
                                     <br><br><a href="#"><img src="images/facebook-icon.png"></a>
                                   </td>
                                   <td>
                                      <br><br><a href="#"><img src="images/instagram-icon.png"></a>
                                   </td>
                             </ul>
                         </div>
                     </section>
                    </tr>
                </table>
            </form><br>
        </div>
    </body>
</html>

<?php 
//check if the submit btn is clicked
if(isset($_POST['submit'])){
    //get data
    $username = $_POST['username'];
    $password = md5($_POST['password']);

    //check if the user exist
    $query="SELECT * FROM admin WHERE  username='$username' AND password='$password'
    ";

    //execute query
    $sql = mysqli_query($conn, $query);

    //count rows to search for a user
    $count = mysqli_num_rows($sql);

    if($count==1){
        $_SESSION['login'] = "<div class='succeed text'>You are successfully logged in</div>";
        $_SESSION['user'] = $username;// to check if user is logged in or not
        //redirect to dashboard
        header('location:'.SITE_URL.'admin.php');
    }
    else{
        $_SESSION['login'] = "<div class='failed text'>Failed to login</div>";
        //redirect to dashboard
        header('location:'.SITE_URL.'login.php');
    }
}
?>