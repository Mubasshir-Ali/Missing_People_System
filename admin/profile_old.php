<?php include "header.php"; ?> 
<?php include "menu.php"; ?> 
<!-- ================================================ -->
<?php 

if(!isset($_SESSION['email'])){
    header('Location: login.php');
}

$session_email = $_SESSION['email'];

$query = "SELECT * FROM users WHERE email = '$session_email'";
$run = mysqli_query($con, $query);
$row = mysqli_fetch_array($run);

$image = $row['image'];
$id = $row['id'];
//$get_users_row['cdate'];
//$date = date('d-m-Y', strtotime($get_users_row['cdate']));
$date = getdate($row['cdate']);
$day = $date['mday'];
$month = substr($date['month'],0,3);
$year = $date['year'];
$first_name = $row['first_name'];
$last_name = $row['last_name'];
$username = $row['username'];
$contact_no = $row['contact_no'];
$email = $row['email'];
$role = $row['role'];

?>

<!-- ================================================ -->
<div class="container-fluid position-relative ">
    <div class="row">
        <div class="col-md-3">
            <?php include "side_menu.php"; ?>   
        </div>
        <div class="col-md-9">                     
            <h1 class="text-primary pt-4">
                <i class="fa fa-user"></i> Profile: <small class="text-dark"> Personal Details</small>
            </h1>
            <hr>
            <ol class="breadcrumb">
                <li><a href="index.php" class="pr-1"><i class="fa fa-tachometer"></i> Dashboard / </a></li>
              <li class="active pl-1"><i class="fa fa-user"></i> Profile</li>
            </ol>
        <div class="row">
            
                       
                         
            <div class="col-md-12">
                
                  <h3>Profile Details</h3>
            </div>
                      
                       <div class="row md-5 pd-5 px-5">
                       <div class="col-md-4 p-0">
                           <img src="assets/images/<?php echo $image;?>" width="200px" class="img-thumbnail w-100" id="profile-image"><br>
                            
                       </div>
                       
                       <div class="col-md-8 pt-4">
                          <div class="row">
                              
                              
                                <div class="col-md-12 ">
                                   
                                   <h4 class="pb-2 mb-0 text-primary   border-bottom border-primary">First Name</h4>
                                    <p class="bg-light text-center text-uppercase text-secondary py-3 h6"><?php echo $first_name;?></p>
                                </div>
                               
                               <div class="col-md-12 ">
                                   
                                   <h4 class="pb-2 mb-0 text-primary  border-bottom border-primary">Last Name</h4>
                                    <p class="bg-light text-center text-uppercase text-secondary py-3 h6"><?php echo $last_name;?></p>
                               </div>
                               
                              
                           </div>
                       </div>
                       
                       
                       <div class="col-md-12 pb-5 mb-5">
                           <div class="row">
                                <div class="col-md-6 ">
                                    <h4 class="pb-2 mb-0 text-primary  border-bottom border-primary">User Name</h4>
                                    <p class="bg-light text-center text-uppercase text-secondary py-3 h6"><?php echo $username;?></p>
                                </div>
                                
                                <div class="col-md-6 ">
                                    <h4 class="pb-2 mb-0 text-primary  border-bottom border-primary">Email</h4>
                                    <p class="bg-light text-center text-uppercase text-secondary py-3 h6"><?php echo $email;?></p>
                                </div>
                                 <div class="col-md-6 py-3">
                                    <h4 class="pb-2 mb-0 text-primary  border-bottom border-primary">Contact No.</h4>
                                    <p class="bg-light text-center text-uppercase text-secondary py-3 h6"><?php echo $contact_no;?></p>
                                </div>
                                <div class="col-md-6 py-3">
                                    <h4 class="pb-2 mb-0 text-primary  border-bottom border-primary">Date</h4>
                                    <p class="bg-light text-center text-uppercase text-secondary py-3 h6"><?php echo "$day $month $year";?></p>
                                </div>
                                 <div class="col-md-6 py-3">
                                    <h4 class="pb-2 mb-0 text-primary  border-bottom border-primary">Role</h4>
                                    <p class="bg-light text-center text-uppercase text-secondary py-3 h6"><?php echo $role;?></p>
                                </div>
                                <div class="col-md-12">
                                <a href="edit_profile.php?edit=<?php echo $id;?>" class="btn btn-primary mt-2">Edit Profile</a>
                                </div>
                           </div>
                           </div>
                       </div>
                   </div>
               </div>     
          
            
            
        </div><!--  .col-md-9/ -->  
    </div>


       

<?php include "footer.php"; ?> 