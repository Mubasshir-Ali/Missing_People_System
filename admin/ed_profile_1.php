    <?php include "header.php"; ?> 
<?php include "menu.php"; ?> 
<!-- ================================================ -->
<?php 

if(!isset($_SESSION['email'])){
    header('Location: login.php');
}

$session_email = $_SESSION['email'];

if(isset($_GET['edit'])){
    $edit_id = $_GET['edit'];
    $edit_query = "SELECT * FROM users WHERE id = $edit_id";
    $edit_query_run = mysqli_query($con, $edit_query);
    if(mysqli_num_rows($edit_query_run) > 0){
        $edit_row = mysqli_fetch_array($edit_query_run);
        $e_email = $edit_row['email'];
        if($e_email == $session_email){
            $e_first_name = $edit_row['first_name'];
            $e_last_name = $edit_row['last_name'];
            $e_contact_no = $edit_row['contact_no'];
            $e_password = $edit_row['password'];
            $e_image = $edit_row['image'];
            
        }
        else{
            header('location: index.php');
        }
   }
}/* 
    else{
        header('location: index.php');
    }
}
else{
    header("location: index.php");
}*/

?>
<!-- ================================================ -->
<div class="container-fluid w-100 float-left position-relative ">
    <div class="row">
        <div class="col-md-3">
            <?php include "side_menu.php"; ?>   
        </div>
        <div class="col-md-9  pd-5 mb-5">                     
            <h1 class="text-primary pt-4">
                <i class="fa fa-user"></i> Profile: <small class="text-dark"> Personal Details </small>
            </h1>
            <hr>
            <ol class="breadcrumb">
                <li><a href="index.php" class="pr-1"><i class="fa fa-tachometer"></i> Dashboard / </a></li>
              <li class="active pl-1"><i class="fa fa-user"></i> Edit Profile </li>
            </ol>
            <?php
                    if(isset($_POST['submit'])){ 
                        if(isset($_GET['edit'])){
                        $edit_id = $_GET['edit'];
                        $first_name = mysqli_real_escape_string($con,$_POST['first_name']);
                        $last_name = mysqli_real_escape_string($con,$_POST['last_name']);
                       
                        $password   = mysqli_real_escape_string($con, $_POST['password']);
                        $contact_no = mysqli_real_escape_string($con, $_POST['contact_no']);
                        $image      = $_FILES['image']['name'];
                        $image_tmp  = $_FILES['image']['tmp_name'];
                        
                        
                        
                        if(empty($image)){
                            $image = $e_image;
                        }
                        
                        $salt_query = "SELECT * FROM users ORDER BY id DESC LIMIT 1";
                        $salt_run = mysqli_query($con, $salt_query);
                        $salt_row = mysqli_fetch_array($salt_run);
                        $salt = $salt_row['salt'];
                        
                        $insert_password = crypt($password, $salt);
                        
                        if(empty($first_name) or empty($last_name)){
                            $error = "All  feilds are Required";
                        }
                        else{
                            $update_query = /*"UPDATE `users` SET `first_name` = '$first_name', `last_name` = '$last_name', `image` = '$image', `contact_no` = '$contact_no',";*/
                            
                              "UPDATE users SET first_name = '$first_name' , last_name = '$last_name', contact_no = '$contact_no', password = '$password', image = '$image' WHERE id = '$edit_id'";
                            
                           if(isset($password)){
                                $update_query .= ",`password` = '$insert_password'";
                            }
                            $update_query .= " WHERE `users`.`id` = $edit_id";
                            if(mysqli_query($con, $update_query)){
                                $msg = "User Has Been Updated";
                                header("refresh:0; url=edit_profile.php?edit=$edit_id");
                                if(!empty($image)){
                                    move_uploaded_file($image_tmp, "img/$image");
                                }
                            }
                            
                            if(mysqli_query($con, $update_query)){
                                $msg = "User Has Been Updated";
                            }
                            else{
                                $error = "User Has Not Been Updated";
                            }
                        }
                    }
                    }
                    ?>
                    <form action="" method="post" enctype="multipart/form-data">
                   <div class="row">
                       <div class="col-md-8  ">
                         <div class="container">
                          <div class="row">
                          
                          <div class="card w-100 mt-3">
                        <div class="card-header">
                          <div class="row align-items-center">
                            <div class="col-8">
                              <h3 class="mb-0">Edit Profile </h3>
                            </div>
                            <div class="col-4 text-right">
                              <input type="submit" value="Update User" name="submit" class="btn btn-primary">
                              
                            </div>
                          </div>
                        </div>
                        <div class="card-body w-">
                           
                            <h6 class="heading-small text-muted mb-4">User Information</h6>
                            <div class="pl-lg-4">
                             
                              <div class="row">
                                <div class="col-lg-6">
                                  <div class="form-group">
                                    <label class="form-control-label" for="first_name">First Name</label>
                                    
                                    <?php
                                        if(isset($error)){
                                            echo "<span class='pull-right' style='color:red;'>$error</span>";
                                        }
                                        else if(isset($msg)){
                                           echo "<span class='pull-right' style='color:green;'>$msg</span>";
                                        }
                                    ?>
                                    
                                    <input type="text" id="first_name" name="first_name" class="form-control" placeholder="First Name" value="<?php echo $e_first_name;?>">
                                  </div>
                                </div>
                                
                                <div class="col-lg-6">
                                  <div class="form-group">
                                    <label class="form-control-label" for="last_name">Last Name</label>
                                    <input type="text" id="last_name" name="last_name" class="form-control" placeholder="Last Name" value="<?php echo $e_last_name;?>">
                                  </div>
                                </div>
                              </div>
                            </div>
                            <hr class="my-4">
                            <!-- Address -->
                            <h6 class="heading-small text-muted mb-4">Contact Information</h6>
                            <div class="pl-lg-4">
                              <div class="row">
                                <div class="col-md-12">
                                  <div class="form-group">
                                    <label class="form-control-label" for="contact_no">Contact No:</label>
                                    <input id="contact_no" type="text" name="contact_no" class="form-control" placeholder="Contact No" value="<?php echo $e_contact_no;?>">
                                  </div>
                                </div>
                              </div>
                              
                            </div>
                            <hr class="my-4">
                            <h6 class="heading-small text-muted mb-4">Password</h6>
                            <div class="pl-lg-4">
                             <div class="row">
                                <div class="col-lg-6">
                                  <div class="form-group">
                                    <label class="form-control-label" for="password">Password</label>
                                    <input type="password" id="password" class="form-control" placeholder="Password" value="<?php echo $e_password;?>">
                                  </div>
                                </div>
                                <div class="col-lg-6">
                                  <div class="form-group">
                                    <label class="form-control-label" for="confirm_password">Confirm Password</label>
                                    <input type="password" id="confirm_password" class="form-control" placeholder="Confirm Password" value="">
                                  </div>
                                </div>
                              </div>
                            </div>
                            
                            <hr class="my-4">
                            <h6 class="heading-small text-muted mb-4">Choose Image</h6>
                            <div class="pl-lg-4">
                             <div class="row">
                                <div class="col-lg-6">
                                  <div class="form-group">
                                    <label class="form-control-label" for="image">Change Profile Image</label>
                                    <input type="file" id="image" name="image">
                                  </div>
                                </div>
                               
                              </div>
                            </div>
                            
                          </form>
                        </div>
                      </div>
                          
                             </div>
                           
                           </div>
                       </div>
                       <div class="col-md-4">
                           <?php
                               echo "<img src='assets/images/$e_image' width='100%'>";
                           ?>
                       </div>
                   </div>
            
        </div><!--  .col-md-9/ -->  
    </div>
</div>

       <!-- =========================================================  -->
       
       
       
       <!-- =========================================================  -->

<?php include "footer.php"; ?> 