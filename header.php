<?php include "connect.php"; ?>
<!DOCTYPE html>
<html>
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- bootstrap css -->
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css" >
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap-grid.min.css">
	<link rel="stylesheet" type="text/css" href="assets/css/bootstrap-reboot.min.css">
	<!-- fontawesome -->
    <link rel="stylesheet" type="text/css" href="assets/css/all.min.css">
    <!-- custom stylesheet -->
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">
    <!-- favicon.ico  -->
    <link rel="icon" type="image/png" href="assets/images/favicon.ico">
	<!-- title -->
    <title> MPFRS </title>
    
</head>
<body>

<div class="w-100 float-left">
<nav class="navbar navbar-expand-lg  bg-primary fixed-top">
   <div class="container">
       <a class="navbar-brand text-white font-weight-bold" href="index.php"><h3 class="m-0"><i class="fas fa-users"></i> MPFRS</h3></a>
    <button class="navbar-toggler " type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon  text-white"><i class="fas fa-bars"></i></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        
        <ul class="nav navbar-nav ml-auto">
            <li class="nav-item active">
                <a class="nav-link text-white" href="index.php"><i class="fa fa-home"></i> Home </a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle text-white" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="far fa-list-alt"></i> Categories
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                   <?php
                  $query = "SELECT * FROM categories ORDER BY id DESC";
                  $run = mysqli_query($con,$query);
                  if(mysqli_num_rows($run) > 0){
                      while($row = mysqli_fetch_array($run)){
                          $category = ucfirst($row['category']);
                          $id = $row['id'];
                          echo "<a class='dropdown-item' href='index.php?cat=".$id."'>$category</a>";
                      }
                  }
                  else{
                      echo "<a href='#'>No Categories Yet</a>";
                  }
                  ?>
                    
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white" href="contactus.php"><i class="fas fa-mobile-alt"></i> Contact</a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white" href="about.php" ><i class="far fa-address-card"></i> About</a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white" href="admin/login.php" ><i class="fas fa-sign-in-alt"></i> Sign In</a>
            </li>
        </ul>
    </div>
    </div>
</nav>
</div>