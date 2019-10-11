 <?php
$session_role2 = $_SESSION['role'];
$session_email2 = $_SESSION['email'];
?>
 

 <div class="w-100 float-left h-63">
  <nav class="navbar navbar-expand-lg  bg-primary fixed-top ">
   <div class="container">
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
        
        <ul class="nav navbar-nav ml-auto">
            <li>
            <a href="" class="nav-link text-white">Welcome: <i class="fas fa-door-open"></i> <?php echo ucfirst($session_email2);?></a>
            </li>
            <li class="nav-item ">
                <a class="nav-link text-white" href="add_post.php"><i class="fas fa-plus-square"></i> Add Post </a>
            </li>
            
            <?php
                  if($session_role2 == 'admin'){
                  ?>
            
           <!-- <li class="nav-item ">
                <a class="nav-link text-white" href="add_user.php"><i class="fa fa-user-plus"></i> Add User </a>
            </li>-->
            
            <?php }?>
            
            <li class="nav-item">
                <a class="nav-link text-white" href="profile.php"><i class="fa fa-user"></i> Profile</a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white" href="logout.php" ><i class="fas fa-power-off"></i> Logout</a>
            </li>
        </ul>
    </div>
    </div>
</nav>
</div>