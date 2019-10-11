<?php include "header.php"; ?> 
<?php include "menu.php"; ?> 

<?php
    if(!isset($_SESSION['email'])){
    header('Location: login.php');
    }
    else if(isset($_SESSION['email']) && ($_SESSION['role'] == 'user')){
    header('Location: index.php');
    }
    if(isset($_GET['edit'])){
        $edit_id = $_GET['edit'];
        $edit_query = "SELECT * FROM users WHERE id = $edit_id";
        $edit_query_run = mysqli_query($con, $edit_query);
        if(mysqli_num_rows($edit_query_run) > 0){
            $edit_row = mysqli_fetch_array($edit_query_run);
            $e_first_name = $edit_row['first_name'];
            $e_last_name = $edit_row['last_name'];
            $e_contact_no = $edit_row['contact_no'];
            $e_password = $edit_row['password'];
            //$e_role = $edit_row['role'];
            $e_image = $edit_row['image'];
        }
    }
    else{
        header("location: index.php");
    }
?>


<div class="container-fluid w-100 float-left position-relative ">
    <div class="row">
        <div class="col-md-3">
            <?php include "side_menu.php"; ?>   
        </div>
        <div class="col-md-9">
            
            
           
            <h1 class="text-primary pt-4">
                <i class="fas fa-user-edit"></i> Edit User: <small class="text-dark"> Edit User Details</small>
            </h1>
            <hr>
            <ol class="breadcrumb">
                <li><a href="index.php" class="pr-1"><i class="fa fa-tachometer"></i> Dashboard / </a></li>
              <li class="active pl-1"><i class="fas fa-user-edit"></i> Edit User:</li>
            </ol>
             
             <?php
                
                if(isset($_POST['submit'])){
                    $date = time();
                    $ed_first_name = mysqli_real_escape_string($con,$_POST['first_name']);
                    $ed_last_name = mysqli_real_escape_string($con,$_POST['last_name']);
                    $ed_password = mysqli_real_escape_string($con,$_POST['password']);
                    $ed_contact_no = mysqli_real_escape_string($con,$_POST['contact_no']);
                    //$role = $_POST['role'];
                    $ed_image = $_FILES['image']['name'];
                    $ed_image_tmp = $_FILES['image']['tmp_name'];
                    
                    if(empty($ed_image)){
                            $ed_image = $image;
                        }
                    
                    $salt_query = "SELECT * FROM users ORDER BY id DESC LIMIT 1";
                    $salt_run = mysqli_query($con, $salt_query);
                    $salt_row = mysqli_fetch_array($salt_run);
                    $salt = $salt_row['salt'];
                    
                    $password = crypt($password, $salt);
                    
                    if(empty($ed_first_name) or empty($ed_last_name) or empty($ed_contact_no)){
                        $error = "All (*) Feilds Are Required";
                    }
                    
                    else{
                            $update_query = "UPDATE users SET cdate = '$date' , first_name = '$ed_first_name' , last_name = '$ed_last_name', contact_no = '$ed_contact_no', password = '$password', image = '$ed_image' WHERE id = '$edit_id'";
                            
                            if(mysqli_query($con, $update_query)){
                                
                                $msg = "User Has Been Edit Successfully";
                                $path = "assets/images/$up_image";
                                
                                 header("location: edit_user.php?edit=$edit_id");
                                    if(!empty($ed_image)){
                                        if(move_uploaded_file($ed_image_tmp, $path)){
                                        copy($path, "../$path");
                                    }
                    else{
                        $msg = "ERROR";
                        }
                                }
                                    }
                        }
                }
            
             ?>
              
              <div class="row" style="margin-bottom:5px">
                  <div class="col-md-6">
                      <form action="" method="post" enctype="multipart/form-data">
                          <div class="form-group">
                              <label for="first_name">First Name:*</label>
                              <?php
                                if(isset($error)){
                                    echo "<span style='color:red; float:right;'>$error</span>";
                                }
                                else if(isset($msg)){
                                    echo "<span class='pull-right' style='color:green;'>$msg</span>";
                                }
                              ?>
                              <input type="text" id="first_name" name="first_name" class="form-control" value="<?php echo $e_first_name ?>" placeholder="First Name">
                          </div>
                          <div class="form-group">
                              <label for="last_name">Last Name:*</label>
                              <input type="text" id="last_name" name="last_name" class="form-control" value="<?php echo $e_last_name ?>" placeholder="Last Name">
                          </div>
                          <div class="form-group">
                              <label for="contact_no">Contact No:*</label>
                              <input type="text" id="contact_no" name="contact_no" class="form-control" value="<?php echo $e_contact_no ?>" placeholder="Contact No">
                          </div>
                           <div class="form-group">
                                   <label for="Password">Password:</label>
                                   <input type="password" id="password" name="password" class="form-control"<?php echo $e_contact_no;?> value="<?php echo $e_password;?>" placeholder="Password">
                            </div>
                            <div class="form-group">
                                   <label for="Password">Conform Password:</label>
                                   <input type="password" id="password" name="password" class="form-control" placeholder="Password">
                            </div>
                         <!-- <div class="form-group">
                              <label for="password">Password:*</label>
                              <input type="password" id="password" name="password" class="form-control" placeholder="Password">
                          </div>-->
                         <!-- <div class="form-group">
                              <label for="role">Role:*</label>
                              <select name="role" id="role" class="form-control">
                                  <option value="user" <?php //if($e_role == 'user'){echo "selected";}?> >User</option>
                                  <option value="admin" <?php //if($e_role == 'admin'){echo "selected";}?> >Admin</option>
                              </select>
                          </div>-->
                          <div class="form-group">
                              <label for="image">Profile Picture:</label>
                              <input type="file"id="image" name="image">
                          </div>
                          <input type="submit" value="Update User Details" name="submit" class="btn btn-primary">
                      </form>
                 </div>
                  <div class="col-md-6">
                      <?php
                        
                            echo "<img src='assets/images/$e_image' width='100%'>";
                        
                      ?>
                  </div>
              </div>
               
        </div>
        <!--  .col-md-9/ -->  
    </div>
</div>

       

<?php include "footer.php"; ?> 