<?php 
//include "header.php";
if(!isset($_SESSION['email'])){
    header('Location: login.php');
}

$comment_tag_query = "SELECT * FROM comments WHERE status = 'pending'";
$category_tag_query = "SELECT * FROM categories";
$users_tag_query = "SELECT * FROM users";
$posts_tag_query = "SELECT * FROM posts  WHERE status = 'draft'";

$com_tag_run = mysqli_query($con, $comment_tag_query);
$cat_tag_run = mysqli_query($con, $category_tag_query);
$user_tag_run = mysqli_query($con, $users_tag_query);
$post_tag_run = mysqli_query($con, $posts_tag_query);


$com_rows = mysqli_num_rows($com_tag_run);
$cat_rows = mysqli_num_rows($cat_tag_run);
$user_rows = mysqli_num_rows($user_tag_run);
$post_rows = mysqli_num_rows($post_tag_run);
?>







<h1 class="text-primary pt-4">
    <i class="fas fa-tachometer-alt"></i> Dashboard: <small class="text-dark">Static Dashboard</small>
</h1>
<hr>
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item active" aria-current="page"><i class="fas fa-tachometer-alt"></i> Dashboard</li>
  </ol>
</nav>


<div class="row tag-boxes">
    <div class="col-md-6 col-lg-3">
        <div class="border border-primary rounded">
            <div class="container-fluid bg-primary text-white py-3">
                <div class="row">
                    <div class="col-sm-3 ">
                        <i class="fa fa-comments fa-3x"></i>
                    </div>
                    <div class="col-sm-9">
                        <div class="text-right h2 font-weight-normal"><?php echo $com_rows;?></div>
                        <div class="text-right font-weight-normal">New Comments</div>
                    </div>
                </div>
            </div>
            <a href="comments.php" class="d-inline d-block px-3 py-2">
                <div class="panel-footer">
                    <span class="float-left">View All Comments</span>
                    <span class="float-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-md-6 col-lg-3">
        <div class="border border-danger rounded">
            <div class="container-fluid bg-danger text-white py-3">
                <div class="row">
                    <div class="col-sm-3 ">
                        <i class="fa fa-file-alt fa-3x"></i>
                    </div>
                    <div class="col-sm-9">
                        <div class="text-right h2 font-weight-normal"><?php echo $post_rows;?></div>
                        <div class="text-right font-weight-normal">New Posts</div>
                    </div>
                </div>
            </div>
            <a href="posts.php" class="d-inline d-block px-3 py-2 text-danger">
                <div class="panel-footer">
                    <span class="float-left">View All Posts</span>
                    <span class="float-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-md-6 col-lg-3">
        <div class="border border-warning rounded">
            <div class="container-fluid bg-warning text-white py-3">
                <div class="row">
                    <div class="col-sm-3 ">
                        <i class="fa fa-users fa-3x"></i>
                    </div>
                    <div class="col-sm-9">
                        <div class="text-right h2 font-weight-normal"><?php echo $user_rows;?></div>
                        <div class="text-right font-weight-normal">All Users</div>
                    </div>
                </div>
            </div>
            <a href="users.php" class="d-inline d-block px-3 py-2 text-warning">
                <div class="panel-footer">
                    <span class="float-left">View All Users</span>
                    <span class="float-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-md-6 col-lg-3">
                            <div class="border border-success rounded">
                                <div class="container-fluid bg-success text-white py-3">
                                    <div class="row">
                                        <div class="col-sm-3 ">
                                            <i class="fa fa-folder-open fa-3x"></i>
                                        </div>
                                        <div class="col-sm-9">
                                            <div class="text-right h2 font-weight-normal"><?php echo $cat_rows;?></div>
                                            <div class="text-right font-weight-normal">All Categories</div>
                                        </div>
                                    </div>
                                </div>
                                <a href="categories.php" class="d-inline d-block px-3 py-2 text-success">
                                    <div class="panel-footer">
                                        <span class="float-left">View All Categories</span>
                                        <span class="float-right"><i class="fa fa-arrow-circle-right"></i></span>
                                        <div class="clearfix"></div>
                                    </div>
                                </a>
                            </div>
                        </div>
</div>

<hr>

                    <?php

                        $get_users_query = "SELECT * FROM users ORDER BY id DESC LIMIT 5";
                        $get_users_run = mysqli_query($con,$get_users_query);
                        if(mysqli_num_rows($get_users_run) > 0){
                            
                    ?>

                    <h3>New Users</h3>
                    <table class="table table-hover table-striped">
                        <thead>
                            <tr>
                                <th>Sr #</th>
                                <th>Date</th>
                                <th>Name</th>
                                <th>Username</th>
                                <th>Email</th>
                                <!--<th>Role</th>-->
                            </tr>
                        </thead>
                        <tbody>
                           <?php 
                            while($get_users_row = mysqli_fetch_array($get_users_run)){
                                $users_id = $get_users_row['id'];
                                $get_users_row['cdate'];
                                $users_date = date('d-m-Y', strtotime($get_users_row['cdate']));
                                //$users_day = $users_date['mday'];
                                //$users_month = substr($users_date['month'],0,3);
                                //$users_year = $users_date['year'];
                                $users_firstname = $get_users_row['first_name'];
                                $users_lastname = $get_users_row['last_name'];
                                $users_fullname = "$users_firstname $users_lastname";
                                $users_username = $get_users_row['username'];
                                $users_email = $get_users_row['email'];
                               // $users_role = $get_users_row['role'];
                            
                            ?>
                            <tr>
                                <td><?php echo $users_id;?></td>
                                <td><?php if($users_date!='' && $users_date!='01-01-1970') {echo $users_date;} else {echo "-";}?></td>
                                <td><?php echo $users_fullname;?></td>
                                <td><?php echo ucfirst($users_username);?></td>
                                <td><?php echo ucfirst($users_email);?></td>
                                <td><?php //echo ucfirst($users_role);?></td>
                            </tr>
                            <?php }?>
                        </tbody>
                    </table>
                    <a href="users.php" class="btn btn-primary">View All Users</a><hr>
                    <?php } ?>


 <?php
                    $get_posts_query = "SELECT * FROM posts ORDER BY id DESC LIMIT 5";
                    $get_posts_run = mysqli_query($con,$get_posts_query);
                    if(mysqli_num_rows($get_posts_run) > 0){
                        
                    
                    ?>
                    <h3>New Posts</h3>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Sr #</th>
                                <th>Date</th>
                                <th>Post Title</th>
                                <th>Gender</th>
                                <th>Category</th>
                                <th>Views</th>
                            </tr>
                        </thead>
                        <tbody>
                           <?php 
                            while($get_posts_row = mysqli_fetch_array($get_posts_run)){
                                $posts_id = $get_posts_row['id'];
                                $date = date('Y-m-d');
                                //$get_users_row['cdate'];
                                //$posts_users_date = date('d-m-Y', strtotime($get_users_row['cdate']));
                                //$posts_date = getdate($get_posts_row['date']);
                                //$posts_day = $posts_date['mday'];
                                //$posts_month = substr($posts_date['month'],0,3);
                                //$posts_year = $posts_date['year'];
                                $posts_title = $get_posts_row['title'];
                                $posts_gender = $get_posts_row['gender'];
                                $posts_categories = $get_posts_row['categories'];
                                $posts_views = $get_posts_row['views'];
                            
                            ?>
                            <tr>
                                <td><?php echo $posts_id;?></td>
                                <td><?php if(isset($date)){echo date('Y-m-d', strtotime($date));}?></td>
                               <!-- <td><?php// echo "$posts_day $posts_month $posts_year";?></td>-->
                                <td><?php echo $posts_title;?></td>
                                <td><?php echo ucfirst($posts_gender);?></td>
                                <td><?php echo ucfirst($posts_categories);?></td>
                                <td><i class="fa fa-eye"></i> <?php echo $posts_views;?></td>
                            </tr>
                            <?php }?>
                        </tbody>
                    </table>
                    <a href="posts.php" class="btn btn-primary">View All Posts</a>
                    <?php } ?>