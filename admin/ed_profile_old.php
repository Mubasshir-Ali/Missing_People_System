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
<div class="container position-relative ">
    <div class="row">
        <div class="col-md-3">
            <?php include "side_menu.php"; ?>   
        </div>
        <div class="col-md-9  pd-5 md-5">                     
            <h1 class="text-primary pt-4">
                <i class="fa fa-user"></i> Profile: <small class="text-dark"> Personal Details</small>
            </h1>
            <hr>
            <ol class="breadcrumb">
                <li><a href="index.php" class="pr-1"><i class="fa fa-tachometer"></i> Dashboard / </a></li>
              <li class="active pl-1"><i class="fa fa-user"></i> Profile</li>
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
                   <div class="row">
                       <div class="col-md-8 pb-5 mb-5">
                           <form action="" method="post" enctype="multipart/form-data">
                               <div class="form-group">
                                   <label for="first_name">First Name:*</label>
                                   <?php
                                    if(isset($error)){
                                        echo "<span class='pull-right' style='color:red;'>$error</span>";
                                    }
                                   else if(isset($msg)){
                                       echo "<span class='pull-right' style='color:green;'>$msg</span>";
                                   }
                                   ?>
                                   <input type="text" id="first_name" name="first_name" class="form-control" value="<?php echo $e_first_name;?>" placeholder="First Name">
                               </div>
                               
                               <div class="form-group">
                                   <label for="last_name">Last Name:*</label>
                                   <input type="text" id="last_name" name="last_name" class="form-control" value="<?php echo $e_last_name;?>" placeholder="Last Name">
                               </div>
                               <div class="form-group">
                                   <label for="contact_no">Contact No:</label>
                                   <input type="text" id="contact_no" name="contact_no" class="form-control" value="<?php echo $e_contact_no;?>" placeholder="Contact No">
                               </div>
                               
                               <div class="form-group">
                                   <label for="Password">Password:</label>
                                   <input type="password" id="password" name="password" class="form-control"<?php echo $e_contact_no;?> value="<?php echo $e_password;?>" placeholder="Password">
                               </div>
                               <div class="form-group">
                                   <label for="Password">Conform Password:</label>
                                   <input type="password" id="password" name="password" class="form-control" placeholder="Password">
                               </div>
                               
                               <div class="form-group">
                                   <label for="image">Profile Picture:</label>
                                   <input type="file" id="image" name="image">
                               </div>
                               
                               
                               
                               <input type="submit" value="Update User" name="submit" class="btn btn-primary">
                           </form>
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

       

<?php include "footer.php"; ?> 