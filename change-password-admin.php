<?php include('page/header.php');?>
<div class="content">
    <div class="contain">
        <h1>Change password</h1>
        <br>
        <br>

        <?php
        if(isset($_GET['id'])){ //calls id
            $id = $_GET['id'];
        } 
        ?>

        <form action="" method="POST">
            <table class="table-add">
                <tr>
                    <td>Old password:</td>
                    <td>
                        <input type="password" name="old_password" placeholder="old password">
                    </td>
                </tr>
                <tr>
                    <td>New password:</td>
                    <td>
                        <input type="password" name="new_password" placeholder="new password">
                    </td>
                </tr>
                <tr>
                    <td>Confirm password:</td>
                    <td>
                        <input type="password" name="confirm_password" placeholder="confirm password">
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="submit" name="submit" value="Chane password" class="update-btn">
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>

<?php 
//chech if the submit button is clicked
if(isset($_POST['submit'])){
    //get data from form
    $id = $_POST['id'];
    $old_password = md5($_POST['old_password']);
    $new_password = md5($_POST['new_password']);
    $confirm_password = md5($_POST['confirm_password']);

    //check if the user's id and old password exit
    $query = "SELECT * FROM admin WHERE id='$id' AND password='$old_password'
    ";
    //execute the query
    $sql = mysqli_query($conn, $query);

    if($sql==true){
        //check data
        $count = mysqli_num_rows($sql);
        if($count==1){
            //echo "User found";
            //header('location:'.SITE_URL.'manager.php');
            if($new_password==$confirm_password){
                $query2 = "UPDATE admin SET password = '$new_password' WHERE id='$id'
                ";

                $sql2 = mysqli_query($conn, $query2);

                if($sql2==true){

                    $_SESSION['change-password'] = "<div class='succeed'>Pasword Changed</div>";
                    header('location:'.SITE_URL.'manager.php');

                }
                else{
                    $_SESSION['change-password'] = "<div class='failed'>Changing password failed</div>";
                    header('location:'.SITE_URL.'manager.php');
                }

            }
            else{
                $_SESSION['not-match'] = "<div class='failed'>Not match</div>";
                header('location:'.SITE_URL.'manager.php');
            }
        }
        else{
            $_SESSION['user-not-found'] = "<div class='failed'>Not found</div>";
            header('location:'.SITE_URL.'manager.php');
        }

    }
}
?>
<?php include('page/footer.php');?>