  <!-- sidebar -->
<!-- .widgets -->
<script defer src="assets/js/face-api.min.js"></script>
<script defer src="assets/js/script.js"></script>

<div class="widgets">
    <form class="form-inline my-2 my-lg-0" action="index.php" method="post">
      <input class="form-control mr-sm-2" type="search" name="search-title" placeholder="Search" aria-label="Search">
      <button class="btn btn-outline-primary my-2 my-sm-0" value="Go" name="search" type="submit">Search</button>
      
  <style>
    
    canvas {
      position: absolute;
      top: 0;
      left: 0;
    }
  </style>
<body>
  <input type="file" id="imageUpload">
</body>
      
    </form>
</div>
<!-- /widgets -->
<!-- .widgets -->
<!-- latest Posts -->
<div class="widgets bg-white rounded p-3 mt-3">
    <div class="latest ">
        <h4><a href="index.php?cat=1" class="text-dark">Found Peoples posts</a></h4>
         <?php 
            $p_query = "SELECT * FROM posts WHERE categories = 'Found' ORDER BY id DESC LIMIT 3";
            $p_run = mysqli_query($con,$p_query);
            if(mysqli_num_rows($p_run) > 0){
                while($p_row = mysqli_fetch_array($p_run)){
                    $p_id = $p_row['id'];
                    $day = date('d', strtotime($row['cdate']));
                    $mon_year = date('M, Y', strtotime($row['cdate']));
                    /*$p_date = getdate($p_row['cdate']);
                    $p_day = $p_date['mday'];
                    $p_month = $p_date['month'];
                    $p_year = $p_date['year'];*/
                    $p_title = $p_row['title'];
                    $p_image = $p_row['image'];
            ?>
        <hr>
        <div class="container">
        <div class="row">
            <div class="col-sm-4">
                <a href="single_post.php?post_id=<?php echo $p_id;?>"><img src="assets/images/<?php echo $p_image;?>" class="w-100"></a>
            </div>
            <div class="col-sm-8">
                <a href="single_post.php?post_id=<?php echo $p_id;?>"><h4><?php echo $p_title;?></h4></a>
                <p><i class="far fa-clock"></i> <?php echo $day;?> <?php echo $mon_year;?></p>
            </div>
        </div>
        </div>
        <hr>
         <?php
                }
            }
            else{
                echo "<h3>No Post Available</h3>";
            }
            ?>
    </div>
</div>
<!-- /widget -->
<!-- Missing Post -->
<div class="widgets bg-white rounded p-3 mt-3">
    <div class="latest ">
        <h4><a href="index.php?cat=2" class="text-dark">Missing Peoples posts</a></h4>
        <?php 
            $p_query = "SELECT * FROM posts WHERE categories = 'Missing' ORDER BY id DESC LIMIT 3";
            $p_run = mysqli_query($con,$p_query);
            if(mysqli_num_rows($p_run) > 0){
                while($p_row = mysqli_fetch_array($p_run)){
                    $p_id = $p_row['id'];
                    $day = date('d', strtotime($row['cdate']));
                    $mon_year = date('M, Y', strtotime($row['cdate']));
                    /*$p_date = getdate($p_row['cdate']);
                    $p_day = $p_date['mday'];
                    $p_month = $p_date['month'];
                    $p_year = $p_date['year'];*/
                    $p_title = $p_row['title'];
                    $p_image = $p_row['image'];
            ?>
        <hr>
        <div class="container">
         <div class="row">
            <div class="col-sm-4">
                <a href="single_post.php?post_id=<?php echo $p_id;?>"><img src="assets/images/<?php echo $p_image;?>" class="w-100"></a>
            </div>
            <div class="col-sm-8">
                <a href="single_post.php?post_id=<?php echo $p_id;?>"><h4><?php echo $p_title;?></h4></a>
                <p><i class="far fa-clock"></i> <?php echo $day;?> <?php echo $mon_year;?> </p>
            </div>
        </div>
        </div>
        <hr>
        <?php
                }
            }
            else{
                echo "<h3>No Post Available</h3>";
            }
            ?>
    </div>
</div>
<!--- recent Posts -->
<div class="widgets bg-white rounded p-3 mt-3">
    <div class="latest ">
        <h4 class="text-dark">Recent posts</h4>
         <?php 
            $p_query = "SELECT * FROM posts WHERE status = 'publish' ORDER BY id DESC LIMIT 5";
            $p_run = mysqli_query($con,$p_query);
            if(mysqli_num_rows($p_run) > 0){
                while($p_row = mysqli_fetch_array($p_run)){
                    $p_id = $p_row['id'];
                    $day = date('d', strtotime($row['cdate']));
                    $mon_year = date('M, Y', strtotime($row['cdate']));
                    /*$p_date = getdate($p_row['date']);
                    $p_day = $p_date['mday'];
                    $p_month = $p_date['month'];
                    $p_year = $p_date['year'];*/
                    $p_title = $p_row['title'];
                    $p_image = $p_row['image'];
            ?>
        <hr>
        <div class="container">
        <div class="row">
            <div class="col-sm-4">
                <a href="single_post.php?post_id=<?php echo $p_id;?>"><img src="assets/images/<?php echo $p_image;?>" class="w-100"></a>
            </div>
            <div class="col-sm-8">
                <a href="single_post.php?post_id=<?php echo $p_id;?>"><h4><?php echo $p_title;?></h4></a>
                <p><i class="far fa-clock"></i> <?php echo $day;?> <?php echo $mon_year;?> </p>
            </div>
        </div>
        </div>
        <hr>
         <?php
                }
            }
            else{
                echo "<h3>No Post Available</h3>";
            }
            ?>
    </div>
</div>

<!-- categories -->
<div class="widgets bg-white rounded p-3 mt-3">
    <div class="latest ">
        <h4>Categories</h4>
        <hr>
        <div class="container">
        <div class="row">
            <div class="col-sm-6">
                <ul class="list-unstyled" >
                 <?php
                    $c_query = "SELECT * FROM categories";
                    $c_run = mysqli_query($con,$c_query);
                    if(mysqli_num_rows($c_run) > 0){
                        $count = 2;
                        while($c_row = mysqli_fetch_array($c_run)){
                            $c_id = $c_row['id'];
                            $c_category = $c_row['category'];
                            $count = $count + 1;

                            if(($count % 2) == 1){
                                echo "<li><a href='index.php?cat=".$c_id."'>".(ucfirst($c_category))."</a></li>";
                            }

                        }
                    }
                    else{
                        echo "<p>No Category</p>";
                    }
                ?>
                </ul>
            </div>
            <div class="col-sm-6">
                <ul class="list-unstyled">
                    <?php
                        $c_query = "SELECT * FROM categories";
                        $c_run = mysqli_query($con,$c_query);
                        if(mysqli_num_rows($c_run) > 0){
                            $count = 2;
                            while($c_row = mysqli_fetch_array($c_run)){
                                $c_id = $c_row['id'];
                                $c_category = $c_row['category'];
                                $count = $count + 1;

                                if(($count % 2) == 0){
                                    echo "<li><a href='index.php?cat=".$c_id."'>".(ucfirst($c_category))."</a></li>";
                                }

                            }
                        }
                        else{
                            echo "<p>No Category</p>";
                        }
                    ?>

                </ul>
            </div>
        </div>
        </div>
    </div>
</div>