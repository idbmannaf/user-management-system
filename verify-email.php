<?php
require_once 'assets/php/session.php';
// if (!isset($_GET['email']) && $_GET ==null) {
//     # code...
// }
if (isset($_GET['email'])) {
   $email = $_GET['email'];
   $cauth->emailVerify($email);
   header('location:profile.php');
   exit();

}else{
    header('location:index.php');
    exit();
}

?>