
<?php
session_start();
require_once 'auth.php';
$cauth= new Auth();



if (!isset($_SESSION['user'])) {
 header('location:index.php');
 die;
}
// if($_SESSION['logged'] == false){
//     header('location:index.php');
// //  die();
// }
$cemail= $_SESSION['user'];
$data= $cauth->currentUser($cemail);


$cid= $data['id'];
$cname= $data['name'];
$cpassword= $data['password'];
$cphone= $data['phone'];
$cgender= $data['gender'];
$cdob= $data['dob'];
$cphoto= $data['photo'];
$created= $data['crated_at'];
$reg_on= date('d M Y', strtotime($created));
$verified= $data['verified'];

$fname= strtok($cname," "); // Only show First Name

if ($verified == 0) {
   $verified= "Not Verified!";
}else{
    $verified= "Verified!";
}


?>