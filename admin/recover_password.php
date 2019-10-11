<?php include "header.php"; ?>
<?php 

    if(isset($_POST['submit'])){
        
            $email = $_POST['email'];
            $pass = $_POST['password'];
            $password = crypt($pass);
            $sql = "SELECT * FROM users WHERE email='$email'";
            $result=mysqli_query($con,$sql);
            $count1 = mysqli_num_rows($result);
        
            if ($count1 > 0)
            {
                $query = "UPDATE users SET password = '$password' where email = '$email'";

                if(mysqli_query($con, $query)){

                       header("location: recover_password.php?status=succ");
                    }
                    else{ header("location: recover_password.php?status=ERR");}
                }
                
            
            else{ 
                header("location: recover_password.php?status=Err");
            } 
    }
?>    
<!-- Mirrored from coderthemes.com/ubold/layouts/light/pages-recoverpw.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 21 Aug 2019 19:18:16 GMT -->

    <body class="bg-primary">

        <div class="account-pages mt-5 mb-5">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-8 col-lg-6 col-xl-5">
                        <div class="card bg-pattern">

                            <div class="card-body p-4">
                                
                                <div class="text-center w-75 m-auto">
                                    <!--<a href="index.html">
                                        <span><img src="assets/images/logo-dark.png" alt="" height="22"></span>
                                    </a>-->
                                    <a class="text-primary font-weight-bold" href="index.php">
                                        <h3 class="m-0"><i class="fas fa-users"></i> MPFRS </h3>
                                    </a>
                                    <p class="text-muted mb-4 mt-3">Enter your email address and new and confirm password then we will reset your password.</p>
                                </div>

                                <form action="recover_password.php" method="POST" enctype="multipart/form-data" autocomplete="off">

                                    <div class="form-group mb-3">
                                      
                                      <?php if(isset($_GET["status"])){

                                                if($_GET["status"] == "succ"){?>
                                                    <div class="alert alert-success" role="alert" style="height: 50px !important">
                                                 <?php echo "<p style='color:black      ;'><strong>Success </strong>Successfully Changed</p>";?></div>
                                                 <?php
                                                }      
                                          }
                                    ?>
                                       
                                    <?php if(isset($_GET["status"])){

                                                if($_GET["status"] == "ERR"){?>
                                                    <div class="alert alert-danger" role="alert" style="height: 50px !important">
                                                 <?php echo "<p style='color:red;'><strong>Error: </strong>Incorrect password</p>";?></div>
                                                 <?php
                                                }      
                                          }
                                    ?>
                                       
                                       <?php if(isset($_GET["status"])){

                                                if($_GET["status"] == "Err"){?>
                                                    <div class="alert alert-danger" role="alert" style="height: 50px !important">
                                                 <?php echo "<p style='color:red;'><strong>Error: </strong>Email mot match  </p>";?></div>
                                                 <?php
                                                }      
                                          }
                                    ?>
                                        <label for="emailaddress">Email address</label>
                                        <input class="form-control" type="email" id="emailaddress" required="required" placeholder="Enter your email" name="email">
                                        
                                        
                                        <label for="newpassword">New Password</label>
                                        <input class="form-control" type="password" id="newpassword" required="" placeholder="Enter Your New Password" name="password">
                                        
                                        <label for="confirmpassword">Confirm Password</label>
                                        <input class="form-control" type="password" id="confirmpassword" required="" placeholder="Enter Your Confirm Password" name="password" onkeyup='check_pass();'>
                                        <span id="match"></span>
                                    </div>

                                    <div class="form-group mb-0 text-center">
                                        <button class="btn btn-primary btn-block" type="submit" name="submit"> Submit </button>
                                    </div>

                                </form>
                                
                                <div class="row mt-3">
                            <div class="col-12 text-center">
                                <p class="text-black-50">Back to <a href="login.php" class="text-black ml-1"><b>Log in</b></a></p>
                            </div> <!-- end col -->
                        </div>
                        <!-- end row -->

                            </div> <!-- end card-body -->
                        </div>
                        <!-- end card -->

                        

                    </div> <!-- end col -->
                </div>
                <!-- end row -->
            </div>
            <!-- end container -->
        </div>
        <!-- end page -->

        
    </body>

<!-- Mirrored from coderthemes.com/ubold/layouts/light/pages-recoverpw.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 21 Aug 2019 19:18:16 GMT -->

<?php include "footer.php"; ?>


<script>
  var check_pass = function(){
    if (document.getElementById('newpassword').value !=
      document.getElementById('confirmpassword').value) {
      document.getElementById('match').innerHTML = 'Password is not matching';
      document.getElementById('match').style.color = 'red';
    }
    else{
      document.getElementById('match').innerHTML = 'Password matching';
      document.getElementById('match').style.color = 'green';
    }
  }
</script>
