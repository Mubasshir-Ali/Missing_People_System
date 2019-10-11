<?php include "header.php"; ?> 
<?php include "menu.php"; ?> 
<?php
    if(!isset($_SESSION['email'])){
    header('Location: login.php');
    }
?>
<?php
    $session_email = $_SESSION['email'];
    $session_role = $_SESSION['role'];
    //$session_user_image = $_SESSION['user_image'];


    if(isset($_GET['edit'])){
    $edit_id = $_GET['edit'];
    if($session_role == 'admin'){
        $get_query = "SELECT * FROM posts WHERE id = $edit_id";
        $get_run = mysqli_query($con, $get_query);
    }
    else if($session_role == 'user'){
        $get_query = "SELECT * FROM posts WHERE id = $edit_id and user = '$session_role'";
        $get_run = mysqli_query($con, $get_query);
    }
    
    if(mysqli_num_rows($get_run) > 0){
        $get_row = mysqli_fetch_array($get_run);
        $title = $get_row['title'];
        $post_data = $get_row['post_data'];
        //$tags = $get_row['tags'];
        $image = $get_row['image'];
        //$tmp_name = $get_row['image']['tmp_name'];
        $status = $get_row['status'];
        $categories = $get_row['categories'];
        $gender = $get_row['gender'];
        $countries = $get_row['countries'];
        $states = $get_row['states'];
        $cities = $get_row['cities'];
        $person_name = $get_row['person_name'];
        $contact_no = $get_row['contact_no'];
        $address = $get_row['address'];
        $missing_date = $get_row['missing_date'];
        
    }
    else{
        header('location: posts.php');
    }
}
else{
    header('location: posts.php');
}
?>


<div class="container-fluid w-100 float-left position-relative <h-100xx></h-100xx>">
    <div class="row">
        <div class="col-md-3">
            <?php include "side_menu.php"; ?>   
        </div>
        <div class="col-md-9">
             <h1 class="text-primary pt-4">
                <i class="fas fa-file-signature"></i> Edit Post: <small>Edit Post Detail</small>
            </h1>
            <hr>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li><a href="index.php"><i class="fas fa-tachometer-alt"></i> Dashboard / </a></li>
                    <li class="active pl-1"><i class="fas fa-file-signature"></i> Edit Post </li>
                </ol>
            </nav>  
            
             <?php
                    if(isset($_POST['Update'])){
                        $date = time();
                        $up_title = mysqli_real_escape_string($con,$_POST['title']);
                       // $up_post_data = mysqli_real_escape_string($con,$_POST['post-data']);
                        $up_categories = $_POST['categories'];
                        //$up_tags = mysqli_real_escape_string($con,$_POST['tags']);
                        $up_status = $_POST['status'];
                        $up_gender = $_POST['gender'];
                        $up_countries = $_POST['countries'];
                        $up_states = $_POST['states'];
                        $up_cities = $_POST['cities'];
                        $up_image = $_FILES['image']['name'];
                        $up_tmp_name = $_FILES['image']['tmp_name'];
                        $up_person_name = $_POST['person_name'];
                        $up_contact_no = $_POST['contact_no'];
                        $up_address = $_POST['address'];
                        $up_missing_date = $_POST['missing_date'];
                     //   $views = $_POST['views'];
                        
                        if(empty($up_image)){
                            $up_image = $image;
                        }
                        
                        if(empty($up_title)){
                            $error = "All (*) Fields Are Required";
                            
                        }
                        else{
                            $update_query = "UPDATE posts SET title = '$up_title' , image = '$up_image', person_name = '$up_person_name', gender = '$up_gender', categories = '$up_categories', countries = '$up_countries', states = '$up_states', cities = '$up_cities', contact_no = '$up_contact_no', address = '$up_address', missing_date = '$up_missing_date', status = 'publish' WHERE id = '$edit_id'";
                            
                            if(mysqli_query($con, $update_query)){
                                
                                $msg = "Post Has Been Updated Successfully";
                                $path = "assets/images/$up_image";
                                
                                 header("location: edit_post.php?edit=$edit_id");
                                    if(!empty($up_image)){
                                        if(move_uploaded_file($up_tmp_name, $path)){
                                        copy($path, "../$path");
                                    }
                                
                               /* $title = "";
                                $post_data = "";
                                $tags = "";
                                $gender = "";
                                $country = "";
                                $province = "";
                                $city = "";
                                $contact_no = "";
                                //$views = "";
                                $status = "";
                                $categories = "";*/
                                
                            }
                            else{
                                $error = "Post Has Not Been Updated Successfully";
                                    }
                                }
                        }
                    }
                    ?>
                    <div class="row">
                        <div class="col-xs-12">
                            <form action="" method="post" enctype="multipart/form-data">
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
                                
                               <!-- <div class="form-group">
                                    <a href="media.php" class="btn btn-primary">Add Media</a>
                                </div>
                                
                                <div class="form-group">
                                    <textarea name="post-data" id="textarea" rows="10" class="form-control"><?php //if(isset($post_data)){echo $post_data;}?></textarea>
                                </div>-->
                                
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="file">Post Image:</label>
                                            <input type="file" name="image">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="categories">Categories:</label>
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
                                          
                                            <label for="countries">Countries:</label>
                                            <select class="form-control" name="countries" id="countries">
                                                <option value="">Select Country</option>
                                            <?php 
                                                if($edit_id!=''){
                                                $cou_query = "SELECT * FROM countries where country_id=".$country;
                                                $cou_run = mysqli_query($con, $cou_query);
                                                $cou_row = mysqli_fetch_array($cou_run);
                                                         echo "<option value='".$cou_row['country_id']."' ".((isset($countries) && $countries == $cou_row['country_id']) ? "selected":"").">".ucfirst($cou_row['country_name'])."</option>";
                                                    
                                                //Not Country ID
                                                $cou_query1 = "SELECT * FROM countries where NOT (country_id=".$countries.")";
                                                $cou_run1 = mysqli_query($con, $cou_query1);
                                                while($cou_row1 = mysqli_fetch_array($cou_run1)){
                                                         echo "<option value='".$cou_row1['country_id']."'>".ucfirst($cou_row1['country_name'])."</option>";
                                                }
                                        
                                                }
                                            ?>
                                            </select>
                                            
                                            <label for="states">States:</label>
                                            <select class="form-control" name="states" id="states">
                                                <option value="">Select States</option>
                                            </select>
                                            
                                             <label for="cities">Cities:</label>
                                            <select class="form-control" name="cities" id="cities">
                                                <option value="">Select City</option>
                                            </select>
                                            
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <!--<label for="tags">Tags:</label>
                                            <input type="text" name="tags" placeholder="Your Tags Here" value="<?php// if(isset($tags)){echo $tags;}?>" class="form-control">-->
                                            
                                            <label for="person">Person Name:</label>
                                            <input type="text" name="person_name" placeholder="Enter Person Name" id="person" value="<?php if(isset($person_name)){echo $person_name;}?>" class="form-control">
                                            
                                            <label for="cont">Contact No:</label>
                                            <input type="text" name="contact_no" placeholder="Enter Contact No" id="contact" value="<?php if(isset($contact_no)){echo $contact_no;}?>" class="form-control">
                                            
                                            <label for="address">Address:</label>
                                            <input type="text" name="address" placeholder="Enter Address" id="address" value="<?php if(isset($address)){echo $address;}?>" class="form-control">
                                            
                                            <label for="missing_date">Missing Date:</label>
                                            <input type="text" name="missing_date" placeholder="Enter Missing Date" id="missing_date" value="<?php if(isset($missing_date)){echo $missing_date;}?>" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <!--<label for="status">Status:</label>
                                            <select class="form-control" name="status" id="status">
                                                <option value="publish" <?php// if(isset($status) and $status == 'publish'){echo "selected";}?>>Publish</option>
                                                <option value="draft" <?php// if(isset($status) and $status == 'draft'){echo "selected";}?>>Draft</option>
                                            </select>-->
                                            
                                            <label for="gender">Gender:</label>
                                            <select class="form-control" name="gender" id="gender">
                                                <option value="male" <?php if(isset($gender) and $gender == 'male'){echo "selected";}?>>Male</option>
                                                <option value="female" <?php if(isset($gender) and $gender == 'female'){echo "selected";}?>>Female</option>
                                                <option value="others" <?php if(isset($gender) and $gender == 'others'){echo "selected";}?>>Others</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <input type="submit" class="btn btn-primary" value="Update Post Details" name="Update">
                            </form>
                        </div>
                    </div>
               
        </div>
    </div>
</div>
       
       
       

 <!-- Ajax Code -->      

<?php include "footer.php"; ?>


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