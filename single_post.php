<!-- header -->
<?php include "header.php"; ?> 
<!-- slider -->
<?php include "slider.php"; ?> 

<!-- ======================================== PHP ============================================  -->

<?php 
if(isset($_GET['post_id'])){
    $post_id = $_GET['post_id'];  
    
    $views_query = "UPDATE `posts` SET `views` = views + 1 WHERE `posts`.`id` = $post_id";
    mysqli_query($con, $views_query);
    
    $query = "SELECT * FROM posts WHERE status = 'publish' and id = $post_id";
    $run = mysqli_query($con, $query);
    if(mysqli_num_rows($run) > 0){
        $row = mysqli_fetch_array($run);
        $id = $row['id'];
        $day = date('d', strtotime($row['cdate']));
        $mon_year = date('M, Y', strtotime($row['cdate']));

        $title = $row['title'];
        $user = $row['user'];
        $user_image = $row['user_image'];
        $image = $row['image'];
        $person_name = $row['person_name'];
        $gender = $row['gender'];
        $categories= $row['categories'];
        $countries = $row['countries'];
        $states = $row['states'];
        $cities = $row['cities'];
        $address = $row['address'];
        $missing_date = $row['missing_date'];
        $contact_no = $row['contact_no'];
        $post_data = $row['post_data'];
        $views = $row['views'];
        $status = $row['status'];
    }
    else{
        header('Location: index.php');
    }
}      
?>


<!-- ==============single_post ============================ -->
<section class="w-100 float-left pt-3 bg-white">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="posts bg-white mt-4 ">
                <div class="container">
                    <div class="row">
                       <div class="text-center w-100">
                            <img class="rounded-circle border border-primary sp_img" src="assets/images/<?php echo $image;?>">
                        </div>            
                        <div class="col-md-6 post-title py-4 ">
                            <h4 class="pb-2 mb-0 text-primary  border-bottom border-primary">Title: <p class="bg-light text-center text-uppercase text-secondary py-3 h6"><?php echo $title;?></p>  </h4>
                                     
                        </div>
                        <div class="col-md-6 py-4 ">
                           <h4 class="pb-2 mb-0 text-primary  border-bottom border-primary">Category: 
                           <p class="bg-light text-center text-uppercase text-secondary py-3 h6"><?php echo $categories;?></p>  </h4>
                        </div>
                    
                        <div class="col-md-3 py-3">
                            <h4 class="pb-2 mb-0 text-primary text-center  border-bottom border-primary">Person Name</h4>
                            <p class="bg-light text-center text-uppercase text-secondary py-3 h6"><?php echo ucfirst($person_name);?> </p>
                        </div>
                        
                        <div class="col-md-3 py-3">
                            <h4 class="pb-2 mb-0 text-primary text-center  border-bottom border-primary">Gender</h4>
                            <p class="bg-light text-center text-uppercase text-secondary py-3 h6"><?php echo ucfirst($gender);?> </p>
                        </div>
                        <div class="col-md-3 py-3">
                            <h4 class="pb-2 mb-0 text-primary text-center  border-bottom border-primary">Missing Date: </h4>
                            <p class="bg-light text-center text-uppercase text-secondary py-3 h6"><?php echo date('d M, Y', strtotime($missing_date));?></p>
                        </div>
                        <div class="col-md-3 py-3">
                            <h4 class="pb-2 mb-0 text-primary text-center  border-bottom border-primary">Post Date: </h4>
                            <p class="bg-light text-center text-uppercase text-secondary py-3 h6">
                                <?php echo $day;?> <?php echo $mon_year;?>
                            </p>
                        </div>
                        <div class="col-md-3 py-3">
                            <h4 class="pb-2 mb-0 text-primary text-center  border-bottom border-primary">countries</h4>
                            <p class="bg-light text-center text-uppercase text-secondary py-3 h6"><?php 
                                    $Res_C = mysqli_query($con, "SELECT country_name from countries where country_id = ". $countries);
                                    $Row_C = mysqli_fetch_array($Res_C); echo $Row_C[0];
                                ?></p>
                        </div>
        
                        <div class="col-md-3 py-3">
                            <h4 class="pb-2 mb-0 text-primary text-center  border-bottom border-primary">states</h4>
                            <p class="bg-light text-center text-uppercase text-secondary py-3 h6"><?php 
                                    $Res_C = mysqli_query($con, "SELECT state_name from states where state_id = ". $states);
                                    $Row_C = mysqli_fetch_array($Res_C); echo $Row_C[0];
                                ?></p>
                        </div>
                        <div class="col-md-3 py-3">
                            <h4 class="pb-2 mb-0 text-primary text-center  border-bottom border-primary">cities</h4>
                            <p class="bg-light text-center text-uppercase text-secondary py-3 h6"><?php 
                                    $Res_C = mysqli_query($con, "SELECT city_name from cities where city_id = ". $cities);
                                    $Row_C = mysqli_fetch_array($Res_C); echo $Row_C[0];
                                ?></p>
                        </div>
                        <div class="col-md-3 py-3 text-center">
                             <h4 class="pb-2 mb-0 text-primary text-center  border-bottom border-primary">Contact No.</h4>
                             <p class="bg-light text-center text-uppercase text-secondary py-3 h6"><?php echo ucfirst($contact_no);?> </p>
                        </div>
                        <div class="col-md-12 py-3">
                            <h4 class="pb-2 mb-0 text-primary text-center  border-bottom border-primary">address:</h4>
                            <p class="bg-light text-center text-uppercase text-secondary py-3 h6"><?php echo ucfirst($address);?> </p>
                        </div>
                        <div class="p-4">
                        <h4 class="pb-2 mb-0 text-primary border-bottom border-primary">Description:</h4>
                        <p class="description bg-light text-center text-uppercase text-secondary py-3 px-3">
                            <?php echo ($post_data);?>
                        </p>
                        
                        </div>
                    </div>
                </div>
            </div>
                <div class="post_comments">
                    <!-- comments -->
            <?php
                $c_query = "SELECT * FROM comments WHERE status = 'approved' and post_id = $post_id ORDER BY id DESC";
                $c_run = mysqli_query($con,$c_query);
                if(mysqli_num_rows($c_run) > 0){
            ?>
                <div>

                    <div class="container pb-5">
                       <?php
                        while($c_row = mysqli_fetch_array($c_run)){
                            $c_id = $c_row['id'];
                            $c_name = $c_row['name'];
                            $c_date = $c_row['date'];
                            $c_username = $c_row['username'];
                            $c_image = $c_row['image'];
                            $c_comment = $c_row['comment'];
                        ?>
                        <div class="row mb-3 border rounded">
                            <div class="col-sm-3">
                                <div class="mx-3 mt-3 px-3">
                                    <img class="rounded-circle img-thumbnail" src="assets/images/<?php echo $c_image; ?>" alt="user-image">
                                </div>
                            </div>
                            <div class="col-sm-9">
                                <div class="py-3 px-4">
                                    <div class=" mb-10">
                                        <b class="text-primary"><?php echo ucfirst($c_name);?></b>
                                        <span class="font-weight-light"><?php echo $c_date ?></span><br>
                                        
                                        <p><?php echo $c_comment;?></p>
                                    </div>                            
                                </div>
                            </div>
                        </div>
                        <?php 
                        }
                        ?>
                    </div>
                     
                    <?php
                        } 
                    
                    if(isset($_POST['submit'])){
                        $cs_name = $_POST['name'];
                        $cs_email = $_POST['email'];
                        $cs_contact_no = $_POST['contact_no'];
                        $cs_comment = $_POST['comment'];
                        $cs_date = time();
                        if(empty($cs_name) or empty($cs_email) or empty($cs_contact_no) or empty($cs_comment)){
                          $error_msg = "All  feilds are Required";  
                        }
                        else{
                            $cs_query = "INSERT INTO `comments` (`id`, `date`, `name`, `username`, `post_id`, `email`, `contact_no`, `image`, `comment`, `status`) VALUES (NULL, '$cs_date', '$cs_name', 'user', '$post_id', '$cs_email', '$cs_contact_no', 'client.png', '$cs_comment', 'pending')";
                            if(mysqli_query($con, $cs_query)){
                                $msg = "Comment Submited and waiting for Approval";
                                $cs_name = "";
                                $cs_email = "";
                                $cs_contact_no = "";
                                $cs_comment = "";
                            }
                            else{
                                $error_msg = "Comment has not be sumited";
                            }
                        }
                    }
                    ?>
                    
                        
                    <!-- comment form -->
                    <div class="pb-5">
                        <h4 class="text-primary">Add your comment:</h4>
                        <p class="mb-3 text-danger">Your email address will not be published. Required fields are marked *</p>
                        <form action="#" class="row" method="post">
                            <div class="col-lg-12">
                                <textarea name="comment" id="comment" class="form-control mb-3 p-2" placeholder="Your comment here" style="height: 180px;" required ><?php if(isset($cs_comment)){echo $cs_comment;}?></textarea>
                            </div>
                            <div class="col-lg-6">
                                <input type="text" value="<?php if(isset($cs_name)){echo $cs_name;}?>" class="form-control mb-4" id="user-name" name="name" placeholder="Your name here" required>
                            </div>
                            <div class="col-lg-6">
                                <input type="text" value="<?php if(isset($cs_contact_no)){echo $cs_contact_no;}?>" id="contact_no" name="contact_no" class="form-control mb-4" placeholder="Your Contact Number here" required>
                            </div>
                            <div class="col-12">
                                <input type="email" value="<?php if(isset($cs_email)){echo $cs_email;}?>"id="user-email" name="email" class="form-control mb-4" placeholder="Your email address here" required>
                            </div>
                            <div class="col-12 mb-2">
                                <button class="btn btn-sm btn-primary" type="submit" value="send" name="submit">Submit</button>
                                <?php
                                    if(isset($error_msg)){
                                        echo "<span style='color:red;' class='pull-right text-danger'>$error_msg</span>";
                                    }
                                    else if(isset($msg)){
                                        echo "<span style='color:green;' class='pull-right text-success'>$msg</span>";
                                    }
                                    ?>
                            </div>
                        </form>
                    </div>
                    </div>
                </div>
            </div>
                
        </div>
    </div>
</section>




<!-- footer -->
<?php include "footer.php"; ?> 