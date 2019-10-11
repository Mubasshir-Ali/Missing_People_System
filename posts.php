<?php

  $number_of_posts = 20;
      
      if(isset($_GET['page'])){
          $page_id = $_GET['page'];
      }
      else{
          $page_id = 1;
      }
      
      if(isset($_GET['cat'])){
          $cat_id = $_GET['cat'];
          $cat_query = "SELECT * FROM categories WHERE id = $cat_id";
          $cat_run = mysqli_query($con, $cat_query);
          $cat_row = mysqli_fetch_array($cat_run);
          $cat_name = $cat_row['category'];
      }
      
      
      if(isset($_POST['search'])){
          $search = $_POST['search-title'];
          $all_posts_query = "SELECT * FROM posts WHERE status = 'publish'";
          $all_posts_query .= " and person_name LIKE '%$search%'";
          $all_posts_run = mysqli_query($con, $all_posts_query);
          $all_posts = mysqli_num_rows($all_posts_run);
          $total_pages = ceil($all_posts / $number_of_posts);
          $posts_start_from = ($page_id - 1) * $number_of_posts;
      }
      else{
          $all_posts_query = "SELECT * FROM posts WHERE status = 'publish'";
          if(isset($cat_name)){
              $all_posts_query .= " and category = '$cat_name'";
          }
          $all_posts_run = mysqli_query($con, $all_posts_query);
          $all_posts = mysqli_num_rows($all_posts_run);
          $total_pages = ceil($all_posts / $number_of_posts);
          $posts_start_from = ($page_id - 1) * $number_of_posts;
      }
      

?>
<!-- =========================================================================================  --->
<?php


if(isset($_POST['search'])){
        $search = $_POST['search-title'];
        $query = "SELECT * FROM posts WHERE status = 'publish'";
        $query .= " and person_name LIKE '%$search%'";
        $query .= " ORDER BY id DESC LIMIT $posts_start_from, $number_of_posts";
    }
    else{
        $query = "SELECT * FROM posts WHERE status = 'publish'";
        if(isset($cat_name)){
            $query .= " and category = '$cat_name'";
        }
        $query .= " ORDER BY id DESC LIMIT $posts_start_from, $number_of_posts";
    }
$run = mysqli_query($con,$query);
if(mysqli_num_rows($run) > 0){
    while($row = mysqli_fetch_array($run)){
        $id = $row['id'];
        $day = date('d', strtotime($row['cdate']));
        $mon_year = date('M, Y', strtotime($row['cdate']));
        /*$date = getdate($row['cdate']);
        $day = $date['mday'];
        $month = $date['month'];
        $year = $date['year'];*/
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
        $contact_no = $row['contact_no'];
        $post_data = $row['post_data'];
        $views = $row['views'];
        $status = $row['status'];
        
?>
<div class="posts col-md-3 ">
  
        <div class="row">
           <div class="mt-2 mx-2 rounded">
            <div class="bg-primary text-white w-100 text-center">
                <span class="text-white"> <?php echo strtoupper($categories);?></span>
            </div>
          
           <a href="single_post.php?post_id=<?php echo $id;?>"class="w-100 p-img pb-5 d-inline-block">
                <img style="height:137px;" class="w-100" src="assets/images/<?php echo $image;?>">
           </a>
           
            <div class="w-100 bg-white post-title py-1 s-detail ">
                <p class="paragraph mb-0">Name: <span class="ml-1 "> <?php echo ucfirst($person_name);?> </span></p>
            </div>
           
          
            </div>
        </div>
    </div>

<?php
     }
}
else{
    echo "<center><h2>No Posts Available</h2></center>";
}
?>
<div class="col-md-12 mt-2">
<nav aria-label="...">
  <ul class="pagination justify-content-center">
 <!--   <li class="page-item ">
      <span class="page-link">Previous</span>
    </li> -->
    <?php
        for($i = 1; $i <= $total_pages; $i++){
            echo "
                <li class='page-item  ".($page_id == $i ? 'active': ' ')."'>
                    <a class='page-link' href='index.php?page=".$i."&".(isset($cat_name)?"cat=$cat_id":" ")."' >$i</a>
                </li>";
        }
        ?>    
  <!--  <li class="page-item">
      <a class="page-link" href="#">Next</a>
    </li> -->
  </ul>
</nav>
</div>