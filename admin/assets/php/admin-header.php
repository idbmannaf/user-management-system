<?php

session_start();
if (!isset($_SESSION['username'])) {
    header('location:index.php');
exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php
    $title= basename($_SERVER['PHP_SELF'],'.php');
    $title= explode('-',$title);
    $title= ucfirst($title[1]);

    ?>
    <title><?php echo $title;?> | Admin Panel</title>
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.24/datatables.min.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" />
    <style>
        
.admin-nav{
    width: 220px;
    min-height: 100vh;
    overflow: hidden;
    background-color: #343a40;
    transition: 0.3s all ease-in-out;
}
.adminLink{
    background-color: #343a40;
}
.adminLink:hover, .nav-active{
    background-color: #212529;
    text-decoration: none;
}
.animate{
    width: 0;
    transition: 0.3s all ease-in-out;
}
    </style>
</head>

<body>
    <div class="container-fluid ">
        <div class="row ">
            <div class="admin-nav p-0">
                <h4 class="text-light text-left p-2">Admin Panel</h4>
                <div class="list-group list-group-flush">
                    <a href="admin-dashboard.php" class='list-group-item text-white adminLink <?php echo basename($_SERVER['PHP_SELF'])== 'admin-dashboard.php'? 'nav-active': ''; ?>'><i class="fas fa-chart-pie"></i> &nbsp; Dashboard</a>
                    <a href="admin-users.php" class='list-group-item text-white adminLink <?php echo basename($_SERVER['PHP_SELF'])== 'admin-users.php'? 'nav-active': ''; ?>'><i class="fas fa-user-friends"></i> &nbsp; Users</a>
                    <a href="admin-notes.php" class='list-group-item text-white adminLink <?php echo basename($_SERVER['PHP_SELF'])== 'admin-notes.php'? 'nav-active': ''; ?>'><i class="fas fa-sticky-note"></i> &nbsp; Notes</a>
                    <a href="admin-feedback.php" class='list-group-item text-white adminLink <?php echo basename($_SERVER['PHP_SELF'])== 'admin-feedback.php'? 'nav-active': ''; ?>'><i class="fas fa-comment"></i> &nbsp; FeedBack</a>
                    <a href="admin-notification.php" class='list-group-item text-white adminLink <?php echo basename($_SERVER['PHP_SELF'])== 'admin-notification.php'? 'nav-active': ''; ?>'><i class="fas fa-bell"></i> &nbsp; Notification&nbsp;<span id="checkNotificationIcon"></span></a>
                    <a href="admin-deleteduser.php" class='list-group-item text-white adminLink <?php echo basename($_SERVER['PHP_SELF'])== 'admin-deleteduser.php'? 'nav-active': ''; ?>'><i class="fas fa-user-slash"></i> &nbsp; Deleted Users</a>
                    <a href="assets/php/admin-action.php?export=excel" class='list-group-item text-white adminLink '><i class="fas fa-table"></i> &nbsp; Export Users</a>
                    <a href="#" class='list-group-item text-white adminLink '><i class="fas fa-id-card"></i> &nbsp; Profile</a>
                    <a href="#" class='list-group-item text-white adminLink '><i class="fas fa-cog"></i> &nbsp; Setting</a>
                </div>
            </div>

            <div class="col">
                <div class="row">
                    <div class="col-lg-12 bg-primary pt-0 justify-content-between d-flex">
                        <a href="#" class="text-white mt-1" id="open-nav"><h3><i class="fas fa-bars "></i></h3></a>
                        <h4 class="text-light mt-1"><?php echo $title;?></h4>
                        <a href="assets/php/logout.php" class="text-light mt-2 text-decoration-none"><i class="fas fa-sign-out-alt"></i>&nbsp;Logout</a>
                    </div>
                </div>