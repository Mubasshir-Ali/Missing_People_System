<?php include "header.php"; ?>

    <body class="bg-primary">

        <div class="account-pages mt-5 mb-5">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-8 col-lg-6 col-xl-5">
                        <div class="card bg-pattern">

                            <div class="card-body p-4">
                                
                                <div class="text-center w-75 m-auto">
                                    <a class="text-primary font-weight-bold" href="#">
                                        <h3 class="m-0"><i class="fas fa-users"></i> MPFRS</h3>
                                    </a>
                                    <p class="text-muted mb-4 mt-3">Don't have an account? Create your account, it takes less than a minute</p>
                                </div>
                                
                                <div>
                                    
                                    <?php
                                    
                                        if(isset($_POST['create'])){
                                            
                                            $date = date('Y-m-d');
                                            $un      = $_POST['username'];
                                            $email       = $_POST['emailaddress'];
                                            $pass      = $_POST['password'];
                                            $cnfrm_pass = $_POST['confirmpassword'];
                                            $password = crypt($pass);
                                            
                                            if($pass == $cnfrm_pass){
                                            $sql = "INSERT INTO users (cdate, username, email, password, role ) VALUES('$date', '$un', '$email', '$password', 'user' )";
                                            
                                            if(mysqli_query($con, $sql) == TRUE){
                                                echo 'Saved Successfully.';
                                                header("location: index.php");
                                            }
                                            else{
                                                echo 'Error.';
                                            }
                                            
                                        }
                                            header("Location: register.php?status=True");
                                    }
                                    
                                        
                                    
                                    ?>
                                    
                                </div>

                                <form action="register.php" method="post" enctype="multipart/form-data" autocomplete="off">
                                   <?php include('errors.php') ?>
                                   
                                   <?php if(isset($_GET["status"])){

                                                if($_GET["status"] == "True"){?>
                                                    <div class="alert alert-success" role="alert" style="height: 50px !important">
                                                 <?php echo "<p style='color:green;'><strong> Registered Successully </strong></p>";?></div>
                                                 <?php
                                                }      
                                          }
                                    ?>
                                        
                                    <div class="form-group">
                                        <label for="username">Username</label>
                                        <input class="form-control" type="text" name="username" id="username" placeholder="Enter your username" required>

                                    <!--<div class="form-group">
                                        <label for="first_name">First Name</label>
                                        <input class="form-control" type="text" name="first_name" id="first_name" placeholder="Enter your first name" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="last_name">Last Name</label>
                                        <input class="form-control" type="text" name="last_name" id="last_name" placeholder="Enter your last name" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="contact_no">Phone Number</label>
                                        <input class="form-control" type="text" name="contact_no" required id="contact_no" placeholder="Enter your phone number">
                                    </div>-->
                                    <div class="form-group">
                                        <label for="emailaddress">Email address</label>
                                        <input class="form-control" type="email" name="emailaddress" id="emailaddress" required placeholder="Enter your email">
                                    </div>
                                    <div class="form-group">
                                        <label for="password">Password</label>
                                        <input class="form-control" type="password" name="password" required id="pass" placeholder="Enter your password">
                                    </div>
                                     <div class="form-group">
                                        <label for="confirmpassword">Confirm Password</label>
                                        <input class="form-control" type="password" name="confirmpassword" required id="cpas" placeholder="Enter your confirm password" onkeyup='check_pass();'>
                                        <span id="match"></span>
                                    </div>
                                    <div class="form-group">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="checkbox-signup">
                                            <label class="custom-control-label" for="checkbox-signup">I accept <a href="javascript: void(0);" class="text-dark">Terms and Conditions</a></label>
                                        </div>
                                    </div>
                                    <div class="form-group mb-0 text-center">
                                        <button class="btn btn-primary btn-block" name="create" type="submit"> Sign Up </button>
                                    </div>

                                </form>

                               

                        <div class="row mt-3">
                            <div class="col-12 text-center">
                                <p class="text-black-50">Already have account?  <a href="login.php" class="text-black ml-1"><b>Sign In</b></a></p>
                            </div> <!-- end col -->
                        </div>
                        <!-- end row -->

                    </div> <!-- end col -->
                </div>
                <!-- end row -->
            </div>
            <!-- end container -->
        </div>
        <!-- end page -->

        
<?php include "footer.php"; ?>


<script>
  var check_pass = function(){
    if (document.getElementById('pass').value !=
      document.getElementById('cpas').value) {
      document.getElementById('match').innerHTML = 'Password is not matching';
      document.getElementById('match').style.color = 'red';
    }
    else{
      document.getElementById('match').innerHTML = 'Password matching';
      document.getElementById('match').style.color = 'green';
    }
  }
</script>