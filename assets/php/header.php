<?php
require_once 'assets/php/session.php';
// echo "<pre>";
// print_r($data);

?>
<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title><?php echo ucfirst(basename($_SERVER['PHP_SELF'],'.php')).' | User Management System';?></title> 
   <link rel="stylesheet" href="assets/css/bootstrap.min.css">
   <!-- <link rel="stylesheet" href="assets/css/style.css"> -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" />
   <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.24/datatables.min.css"/>
 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

<style>
@import url('https://fonts.googleapis.com/css2?family=Maven+Pro:wght@400;500;600;700;800;900&display=swap');
*{
   font-family: 'Maven Pro', sans-serif;
}
</style>
</head>

<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand" title="User Management System" href="index.php"><i class="fa fa-code fa-lg"></i> &nbsp; &nbsp; UMS</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
      <ul class="navbar-nav ms-auto">
        <li class="nav-item">
          <a class="nav-link <?php echo basename($_SERVER['PHP_SELF']) == 'home.php' ? 'active':''; ?>"  aria-current="page" href="home.php"> <i class="fas fa-home" aria-hidden="true"></i>&nbsp; Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link <?php echo basename($_SERVER['PHP_SELF']) == 'profile.php' ? 'active':''; ?>" href="profile.php"><i class="fas fa-user-circle" aria-hidden="true"></i>&nbsp; Profile</a>
        </li>
        <li class="nav-item">
          <a class="nav-link <?php echo basename($_SERVER['PHP_SELF']) == 'feedback.php' ? 'active':''; ?>" href="feedback.php"><i class="fas fa-comment-dots" aria-hidden="true"></i>&nbsp; Feedback</a>
        </li>
        <li class="nav-item">
          <a class="nav-link <?php echo basename($_SERVER['PHP_SELF']) == 'nofification.php' ? 'active':''; ?>" href="notification.php"><i class="fas fa-bell" aria-hidden="true"></i>&nbsp;Notification &nbsp; <span id="checkNotification"></span></a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navlink" role="button" data-bs-toggle="dropdown">
           <i class="fas fa-user-cog"></i> &nbsp; Hi! <?php echo $fname ??'';?>
          </a>
          <ul class="dropdown-menu" aria-labelledby="navlink">
            <li><a class="dropdown-item" href="#"><i class="fas fa-cog" aria-hidden="true"></i> &nbsp; Setting</a></li>
            <li><a class="dropdown-item" href="logout.php"><i class="fas fa-sign-out-alt" aria-hidden="true"></i> &nbsp; Logout</a></li>
            
          </ul>
        </li>
      </ul>
    </div>
  </div>
</nav>
