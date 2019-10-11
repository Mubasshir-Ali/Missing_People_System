 <?php
$session_role2 = $_SESSION['role'];
$session_email2 = $_SESSION['email'];
?>
 

 <div class="w-100 float-left h-63">
  <nav class="navbar navbar-expand-lg  bg-primary fixed-top ">
   <div class="container-fluid">
       <a class="navbar-brand text-white font-weight-bold" href="index.php"><h3 class="m-0"><i class="fas fa-users"></i> MPFRS</h3></a>
    <button class="navbar-toggler bg-light" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    
            <!--<div class="navbar-header">
              <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
              </button>
              <a class="navbar-brand" href="index.php"></a>
            </div>-->

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        
        
            <ul class="navbar-nav ml-auto">
            <li class="nav-item dropdown ">
              <a class="nav-link pr-0 py-0" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <div class="media align-items-center ">
                  <span class="avatar avatar-sm rounded-circle">
                    <img alt="Image" src="assets/images/client.png" class="img_rounded rounded-circle">
                  </span>
                  <div class="media-body ml-2 d-block">
                    <span class="text-white  font-weight-bold">
                    <?php echo ucfirst($session_email2);?></span>
                  </div>
                </div>
              </a>
              <div class="dropdown-menu dropdown-menu-right col-sm-6">
                <div class="dropdown-header noti-title">
                  <h6 class="text-overflow m-0">Welcome!</h6>
                </div>
                <a href="profile.php" class="dropdown-item">
                  <i class="fa fa-user"></i>
                  <span>My profile</span>
                </a>
                
                <?php
                  if($session_role2 == 'admin'){
                  ?>
            
           <!-- <li class="nav-item ">
                <a class="nav-link text-white" href="add_user.php"><i class="fa fa-user-plus"></i> Add User </a>
            </li>-->
            
                <?php }?>
                
                <a href="add_post.php" class="dropdown-item">
                  <i class="fas fa-plus-square"></i>
                  <span>Add Post</span>
                </a>
                <div class="dropdown-divider"></div>
                <a href="logout.php" class="dropdown-item  text-danger">
                  <i class="fas fa-power-off"></i>
                  <span class="text-dark">Logout</span>
                </a>
              </div>
            </li>
          </ul>
        
    </div>
    </div>
</nav>
</div>