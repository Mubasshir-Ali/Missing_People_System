<?php include "header.php"; ?> 
<?php include "menu.php"; ?> 

<?php
    if(!isset($_SESSION['email'])){
    header('Location: login.php');
    }
    else if(isset($_SESSION['email']) && ($_SESSION['role'] == 'user')){
    header('Location: index.php');
    }
?>


<div class="container-fluid w-100 float-left position-relative ">
    <div class="row">
        <div class="col-md-3">
            <?php include "side_menu.php"; ?>   
        </div>
        <div class="col-md-9">
            
            
           
            <h1 class="text-primary pt-4">
                <i class="fa fa-user-plus"></i> Add User: <small class="text-dark"> Add New User</small>
            </h1>
            <hr>
            <ol class="breadcrumb">
                <li><a href="index.php" class="pr-1"><i class="fa fa-tachometer"></i> Dashboard / </a></li>
              <li class="active pl-1"><i class="fa fa-user-plus"></i> Add New User</li>
            </ol>
             
             <?php
                
                if(isset($_POST['submit'])){
                    $date = date('Y-m-d');
                    $first_name = mysqli_real_escape_string($con,$_POST['first-name']);
                    $last_name = mysqli_real_escape_string($con,$_POST['last-name']);
                    $username = mysqli_real_escape_string($con,strtolower($_POST['username']));
                    $username_trim = preg_replace('/\s+/','',$username);
                    $email = mysqli_real_escape_string($con,strtolower($_POST['email']));
                    $password = mysqli_real_escape_string($con,$_POST['password']);
                    $contact_no = mysqli_real_escape_string($con,$_POST['contact-no']);
                    $role = $_POST['role'];
                    $image = $_FILES['image']['name'];
                    $image_tmp = $_FILES['image']['tmp_name'];
                    
                    $check_query = "SELECT * FROM users WHERE username = '$username' or email = '$email'";
                    $check_run = mysqli_query($con, $check_query);
                    
                    $salt_query = "SELECT * FROM users ORDER BY id DESC LIMIT 1";
                    $salt_run = mysqli_query($con, $salt_query);
                    $salt_row = mysqli_fetch_array($salt_run);
                    $salt = $salt_row['salt'];
                    
                    $password = crypt($password);
                    
                    if(empty($first_name) or empty($last_name) or empty($username) or empty($first_name) or empty($email) or empty($password) or empty($contact_no) or empty($image)){
                        $error = "All (*) Feilds Are Required";
                    }
                    else if($username != $username_trim){
                        $error ="Don't Use Spaces In Username";
                    }
                    else if (mysqli_num_rows($check_run) > 0){
                        $error = "Username or Email Already Exist";
                    }
                    else{
                        $insert_query = "INSERT INTO `users` (`id`, `cdate`, `first_name`, `last_name`, `username`, `email`, `contact_no`, `image`, `password`, `role`) VALUES (NULL, '$date', '$first_name', '$last_name', '$username', '$email', '$contact_no', '$image', '$password', '$role')";
                        if (mysqli_query($con,$insert_query)){
                            $msg = "User Has Been Added Successfully";
                            move_uploaded_file($image_tmp,"assets/images/$image");
                            $image_check = "SELECT * FROM users ORDER BY id DESC LIMIT 1";
                            $image_run = mysqli_query($con, $image_check);
                            $image_row = mysqli_fetch_array($image_run);
                            $check_image = $image_row['image'];
                            
                            $first_name = "";
                            $last_name = "";
                            $username = "";
                            $email = "";
                            $contact_no = "";
                        }
                        else{
                            $msg = "User Has Not Been Added Successfully";
                        }
                    }
                }
            
             ?>
              
              <div class="row" style="margin-bottom:5px">
                  <div class="col-md-6">
                      <form action="" method="post" enctype="multipart/form-data">
                          <div class="form-group">
                              <label for="first-name">First Name:*</label>
                              <?php
                                if(isset($error)){
                                    echo "<span style='color:red; float:right;'>$error</span>";
                                }
                                else if(isset($msg)){
                                    echo "<span class='pull-right' style='color:green;'>$msg</span>";
                                }
                              ?>
                              <input type="text" id="first-name" name="first-name" class="form-control" value="<?php if(isset($first_name)){echo $first_name;} ?>" placeholder="First Name">
                          </div>
                          <div class="form-group">
                              <label for="last-name">Last Name:*</label>
                              <input type="text" id="last-name" name="last-name" class="form-control" value="<?php if(isset($last_name)){echo $last_name;} ?>" placeholder="Last Name">
                          </div>
                          <div class="form-group">
                              <label for="username">Username:*</label>
                              <input type="text" id="username" name="username" class="form-control" value="<?php if(isset($username)){echo $username;} ?>" placeholder="Username">
                          </div>
                          <div class="form-group">
                              <label for="email">Email:*</label>
                              <input type="text" id="email" name="email" class="form-control" value="<?php if(isset($email)){echo $email;} ?>" placeholder="Email Address">
                          </div>
                          <div class="form-group">
                              <label for="contact-no">Contact No:*</label>
                              <input type="text" id="contact-no" name="contact-no" class="form-control" value="<?php if(isset($contact_no)){echo $contact_no;} ?>" placeholder="Contact No">
                          </div>
                          <div class="form-group">
                              <label for="password">Password:*</label>
                              <input type="password" id="password" name="password" class="form-control" placeholder="Password">
                          </div>
                          <!--<div class="form-group">
                              <label for="role">Role:*</label>
                              <select name="role" id="role" class="form-control">
                                  <option value="user">User</option>
                                  <option value="admin">Admin</option>
                              </select>
                          </div>-->
                          <div class="form-group">
                              <label for="image">Profile Picture:*</label>
                              <input type="file"id="image" name="image">
                          </div>
                          <input type="submit" value="Add User" name="submit" class="btn btn-primary">
                      </form>
                 </div>
                  <div class="col-md-6">
                      <?php
                        if(isset($check_image)){
                            echo "<img src='assets/images/$check_image' width='100%'>";
                        }
                      ?>
                  </div>
              </div>
               
        </div>
        <!--  .col-md-9/ -->  
    </div>
</div>

       

<?php include "footer.php"; ?> 