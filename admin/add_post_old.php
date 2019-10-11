<?php include "header.php"; ?> 
<?php include "menu.php"; ?> 
<?php
    if(!isset($_SESSION['email'])){
    header('Location: login.php');
    }
?>
<?php
    $session_email = $_SESSION['email'];
    //$session_user_image = $_SESSION['user_image'];
?>


<div class="container-fluid w-100 float-left position-relative <h-100xx></h-100xx>">
    <div class="row">
        <div class="col-md-3">
            <?php include "side_menu.php"; ?>   
        </div>
        <div class="col-md-9">
             <h1 class="text-primary pt-4">
                <i class="fas fa-plus-square"></i> Add Post <small>Add New Post</small>
            </h1>
            <hr>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li><a href="index.php"><i class="fas fa-tachometer-alt"></i> Dashboard / </a></li>
                    <li class="active pl-1"><i class="fas fa-plus-square"></i> Add Post </li>
                </ol>
            </nav>  
            
             <?php
                    if(isset($_POST['submit'])){
                        $date = date('Y-m-d');

                        $title = mysqli_real_escape_string($con,$_POST['title']);
                        //$post_data = mysqli_real_escape_string($con,$_POST['post-data']);
                        $categories = $_POST['categories'];
                       // $tags = mysqli_real_escape_string($con,$_POST['tags']);
                        //$status = $_POST['status'];
                        $gender = $_POST['gender'];
                        $countries = $_POST['countries'];
                        $states = $_POST['states'];
                        $cities = $_POST['cities'];
                        $image = $_FILES['image']['name'];
                        $tmp_name = $_FILES['image']['tmp_name'];
                        $person_name = $_POST['person_name'];
                        $contact_no = $_POST['contact_no'];
                        $address = $_POST['address'];
                        $missing_date = $_POST['missing_date'];
                     //   $views = $_POST['views'];
                        if(empty($title) or empty($image) or empty($person_name) or empty($gender) or empty($categories) or empty($countries) or empty($states) or empty($cities) or empty($contact_no) or empty($address)){
                            $error = "All (*) Feilds Are Required";
                            
                        }
                        else{
                            $insert_query = "INSERT INTO `posts` (`cdate`, `title`, `user`, `image`, `person_name`, `gender`, `categories`, `countries`, `states`, `cities`, `contact_no`, `address`, `missing_date`, `views`, `status`) VALUES ('$date', '$title', '$session_email', '$image', '$person_name', '$gender', '$categories', '$countries', '$states', '$cities', '$contact_no', '$address', '$missing_date', '0', 'draft')";
                            if(mysqli_query($con, $insert_query)){
                                
                                $msg = "Post Has Been Added Successfully";
                                $path = "assets/images/$image";
                                
                                $title = "";
                                //$tags = "";
                                $gender = "";
                                $countries = "";
                                $states = "";
                                $cities = "";
                                $contact_no = "";
                                
                                //$views = "";
                                //$status = "";
                                $categories = "";
                                
                                /*if(move_uploaded_file($tmp_name, $path)){
                                    copy($path, "..assets/images/$path");
                                }*/
                            }
                            else{
                                $error = "Post Has Not Been Added Successfully";
                            }
                        }
                    }
                    ?>
                    <div class="row">
                        <div class="col-xs-12">
                            <form action="add_post.php" method="post" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label for="title">Title:*</label>
                                    <?php
                                    if(isset($msg)){
                                        echo "<span class='pull-right' style='color:green;'>$msg</span>";
                                    }
                                    else if(isset($error)){
                                        echo "<span class='pull-right' style='color:red;'>$error</span>";
                                    }
                                    ?>
                                    <input type="text" name="title" placeholder="Type Post Title Here" value="<?php if(isset($title)){echo $title;}?>" class="form-control">
                                </div>
                                
                                <!--<div class="form-group">
                                    <a href="media.php" class="btn btn-primary">Add Media</a>
                                </div>-->
                                
                                <!--<div class="form-group">
                                    <textarea name="post-data" id="textarea" rows="10" class="form-control"><?php //if(isset($post_data)){echo $post_data;}?></textarea>
                                </div>-->
                                
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="file">Post Image:*</label>
                                            <input type="file" name="image">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="categories">Categories:*</label>
                                            <select class="form-control" name="categories" id="categories">
                                                <?php
                                                $cat_query = "SELECT * FROM categories ORDER BY id DESC";
                                                $cat_run = mysqli_query($con, $cat_query);
                                                if(mysqli_num_rows($cat_run) > 0){
                                                    while($cat_row = mysqli_fetch_array($cat_run)){
                                                        $cat_name = $cat_row['category'];
                                                        echo "<option value='".$cat_name."' ".((isset($categories) and $categories == $cat_name)?"selected":"").">".ucfirst($cat_name)."</option>";
                                                        
                                                    }
                                                }
                                                else{
                                                    echo "<cetner><h6>No Category Available</h6></center>";
                                                }
                                                ?>
                                            </select>
                                        <?php  
                                            $cou_query = "SELECT country_name,country_id FROM countries";
                                            $cou_run = mysqli_query($con, $cou_query);
                                   
                                            ?>    
                                            <label for="countries">Countries:*</label>
                                            <select class="form-control" name="countries" id="countries">
                                                <option value="">Select Country</option>
                                                <?php 
                                                
                                                if(mysqli_num_rows($cou_run) > 0){
                                                    while($cou_row = mysqli_fetch_array($cou_run)){
                                                        $country_id = $cou_row['country_id'];
                                                        $cou_name = $cou_row['country_name'];
                                                         echo "<option value='".$country_id."' ".((isset($country) and $country == $cou_name)?"selected":"").">".ucfirst($cou_name)."</option>";
                                                        
                                                    }
                                                }
                                                ?>
                                            </select>
                                            
                                            <label for="states">States:*</label>
                                            <select class="form-control" name="states" id="states">
                                                <option value="">Select State</option>
                                            </select>
                                            
                                             <label for="cities">Cities:*</label>
                                            <select class="form-control" name="cities" id="cities">
                                                <option value="">Select City</option>
                                            </select>
                                            
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <!--<label for="tags">Tags:*</label>
                                            <input type="text" name="tags" placeholder="Your Tags Here" value="<?php// if(isset($tags)){echo $tags;}?>" class="form-control">-->
                                            
                                            <label for="person">Person Name:*</label>
                                            <input type="text" name="person_name" placeholder="Enter Person Name" id="person" value="<?php if(isset($person_name)){echo $person_name;}?>" class="form-control">
                                            
                                            <label for="cont">Contact No:*</label>
                                            <input type="text" name="contact_no" placeholder="Enter Contact No" id="contact" value="<?php if(isset($contact_no)){echo $contact_no;}?>" class="form-control">
                                            
                                            <label for="address">Address:*</label>
                                            <input type="text" name="address" placeholder="Enter Address" id="address" value="<?php if(isset($address)){echo $address;}?>" class="form-control">
                                            
                                            <label for="missing_date">Missing Date:</label>
                                            <input name="missing_date" type="date" placeholder="mm/dd/yyyy" id="" value="<?php if(isset($missing_date)){echo date('Y-m-d', strtotime($missing_date));}?>" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <!--<label for="status">Status:*</label>
                                            <select class="form-control" name="status" id="status">
                                                <option value="draft" <?php //if(isset($status) and $status == 'draft'){echo "selected";}?>>Draft</option>
                                                <option value="publish" <?php //if(isset($status) and $status == 'publish'){echo "selected";}?>>Publish</option>
                                            </select>-->
                                            
                                            <label for="gender">Gender:*</label>
                                            <select class="form-control" name="gender" id="gender">
                                                <option value="male" <?php if(isset($gender) and $gender == 'male'){echo "selected";}?>>Male</option>
                                                <option value="female" <?php if(isset($gender) and $gender == 'female'){echo "selected";}?>>Female</option>
                                                <option value="others" <?php if(isset($gender) and $gender == 'others'){echo "selected";}?>>Others</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <input type="submit" class="btn btn-primary" value="Add Post" name="submit">
                            </form>
                        </div>
                    </div>
               
        </div>
    </div>
</div>
       
       
       

 <!-- Ajax Code -->      

<?php include "footer.php"; ?>

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<script src="https://unpkg.com/gijgo@1.9.13/js/gijgo.min.js" type="text/javascript"></script>
<link href="https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css" rel="stylesheet" type="text/css" />
<script>
        $('#missing_date').datepicker({
            uiLibrary: 'bootstrap4'
        });
</script>

<script>

    $(function() {

  $('#countries').bind('change', function(ev) {

     var value = $(this).val();

      var request = $.ajax({
          url: "ajax.php",
          type: "POST",
          data: {country_id : value, action : "getStates"} 
        });

        request.done(function(msg) { 
          $("#states").html( msg );
        });

        request.fail(function(jqXHR, textStatus) {
          alert( "Request failed: " + textStatus );
        });

  });


});

</script>


<script>

    $(function() {

  $('#states').bind('change', function(ev) {

     var value = $(this).val();

      var request = $.ajax({
          url: "ajax.php",
          type: "POST",
          data: {state_id : value, action : "getCities"} 
        });

        request.done(function(msg) { 
          $("#cities").html( msg );
        });

        request.fail(function(jqXHR, textStatus) {
          alert( "Request failed: " + textStatus );
        });

  });


});

</script>