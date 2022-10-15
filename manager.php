<?php include("page/header.php"); ?>
        
        <!--content starts-->
        <div class="content">
            <div class="contain">
                <h1>Manage Admin</h1>
                <br><br>

                <?php
                if(isset($_SESSION['add'])){
                    echo $_SESSION['add']; //show a message
                    unset($_SESSION['add']); //remove a message
                }
                if(isset($_SESSION['delete'])){
                    echo $_SESSION['delete'];
                    unset($_SESSION['delete']);
                }
                if(isset($_SESSION['update'])){
                    echo $_SESSION['update'];
                    unset($_SESSION['update']);

                }
                if(isset($_SESSION['user-not-found'])){
                    echo $_SESSION['user-not-found'];
                    unset($_SESSION['user-not-found']);

                }
                if(isset($_SESSION['not-match'])){
                    echo $_SESSION['not-match'];
                    unset($_SESSION['not-match']);

                }
                if(isset($_SESSION['change-password'])){
                    echo $_SESSION['change-password'];
                    unset($_SESSION['change-password']);

                }

                ?><br><br>

                <a href="add-page.php" class="add-btn">Add Admin</a>
                <br><br>
                <table class="table-manager">
                    <tr>
                        <th>ID</th>
                        <th>Name and Surname</th>
                        <th>Username</th>
                        <th>Action</th>
                    </tr>

                    <?php
                      //get all admins
                      $query = "SELECT * FROM admin";
                      $sql = mysqli_query($conn, $query);

                      //check if the query is executed
                      if($sql==true){
                          $count = mysqli_num_rows($sql);

                          $numbers=1;

                          if($count>0){
                              while($rows=mysqli_fetch_assoc($sql)){
                                  $id=$rows['id'];
                                  $fname = $rows['name'];
                                  $username = $rows['username'];

                                  //display in php
                                  ?>

                                    <tr>
                                        <td><?php echo $numbers++; ?></td>
                                        <td><?php echo $fname; ?></td>
                                        <td><?php echo $username; ?></td>
                                        <td>
                                            <a href="<?php echo SITE_URL; ?>change-password-admin.php?id=<?php echo $id;?>" class="add-btn">Change password</a>
                                            <a href="<?php echo SITE_URL; ?>update-admin.php?id=<?php echo $id;?>" class="update-btn">Update</a>
                                            <a href="<?php echo SITE_URL; ?>delete-admin.php?id=<?php echo $id;?>" class="delete-btn">Delete</a>
                                        </td>
                                    </tr>
                                  <?php 

                              }
                          }
                      }
                     
                     ?>
                   
                </table>
                
                <div class="clearfix"></div>
            </div>

        </div>
        <!--content ends-->

<?php include("page/footer.php") ?>