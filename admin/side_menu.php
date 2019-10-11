<?php
$session_role1 = $_SESSION['role'];

$get_comment = "SELECT * FROM comments WHERE status = 'pending'";
$get_comment_run = mysqli_query($con, $get_comment);
$num_of_rows = mysqli_num_rows($get_comment_run);
?>

<?php
$session_role2 = $_SESSION['role'];

$get_post = "SELECT * FROM posts WHERE status = 'draft'";
$get_post_run = mysqli_query($con, $get_post);
$num_of_rows1 = mysqli_num_rows($get_post_run);
?>


<div class="w-100 float-left">
<ul class="list-group">
    <li class="list-group-item list-group-item-action active">
        <a href="index.php" class="text-white"><i class="fas fa-tachometer-alt"></i> Dashboard</a>
    </li>
    <!--<li class="list-group-item list-group-item-action ">
        <a href="posts.php"><i class="fas fa-file-alt"></i> All Posts</a>
        
    </li>
    <li class="list-group-item list-group-item-action ">
        <a href="media.php"><i class="fab fa-medium"></i> Media</a>
        
    </li>-->
    
                    
                      <a href="posts.php" class="list-group-item">
                          
                         <i class="fas fa-file-alt"></i> All Posts 
                          
                           <?php
                          if($num_of_rows1 > 0){
                              echo "<span class='badge badge-primary badge-pill'>$num_of_rows1</span>";
                          }
                          ?> 
                      </a>
    
    
                     <?php
                        if($session_role1 == 'admin'){
                            
                        
                        ?>
                      <a href="comments.php" class="list-group-item">
                          
                         <i class="far fa-comment-dots"></i> Comments 
                          
                           <?php
                          if($num_of_rows > 0){
                              echo "<span class='badge badge-primary badge-pill'>$num_of_rows</span>";
                          }
                          ?> 
                      </a>
    <li class="list-group-item list-group-item-action ">
        <a href="categories.php"><i class="fa fa-folder-open"></i> Categories  </a> 
        
    </li>
    <li class="list-group-item list-group-item-action">
        <a href="users.php"><i class="fa fa-user"></i> Users</a>
        
    </li>
</ul>
                <?php }?>
                
</div>






