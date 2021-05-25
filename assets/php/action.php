<?php
session_start();
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require 'vendor/autoload.php';

//Instantiation and passing `true` enables exceptions
$mail = new PHPMailer(true);

include 'auth.php';
$auth= new Auth();
//registetion handeler with Ajax request
if (isset($_POST['action']) and $_POST['action']=='register') {
    $name= $auth->cleanInputData($_POST['name']);
    $email= $auth->cleanInputData($_POST['remail']);
    $password= $auth->cleanInputData($_POST['rpassword']);
    $hash_Pass= password_hash($password,PASSWORD_DEFAULT);
    if ($auth->user_exist($email)) {
      echo $auth->errorMsg("warning","This email Already Registered"); // jodi email already db te chake taile else e giye data insert hobe
    }else{
        if ($auth->register($name,$email,$hash_Pass)) {
            echo 'Register';
            $_SESSION['user']=$email;
            $_SESSION['reg']=true;
            $mail->isSMTP(); // ei method e emai send hobe
            $mail->Host= 'smtp.gmail.com'; // Gmail er server er name
            $mail->SMTPAuth= true;
            $mail->Username= Database::USERNAME;
            $mail->Password= Database::PASSWORD ;
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         //Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
            $mail->Port  = 587;     
        
            //Recipients
            $mail->setFrom(Database::USERNAME);
            $mail->addAddress($email); // kon email e pathabo
            $mail->setFrom('idbmannaf@gmail.com', 'User Management System');
        
            $mail->isHTML(true);                                  //Set email format to HTML
            $mail->Subject = 'E-mail Verification';
            $mail->Body    = '<h3>Click the below linik to Verify your Email <br> <a href="http://localhost/All_Project/user-management/verify-email.php?email='.$email.'">http://localhost/All_Project/user-management/verify-email.php?email='.$email.'</a> <br> Regards <br> Abdul Mannaf! </h3>';
            $mail->send();
        
            echo $auth->errorMsg('success', 'Verification Sent to your email  email id please check your email');
                // header('location:../home.php');
        }else{
            echo $auth->errorMsg("danger","Something went Worng! try again latter");
        }
    }
}
//login handeler with Ajax request
if (isset($_POST['action']) && $_POST['action']== 'login') {
    // print_r($_POST);
    $email= $auth->cleanInputData($_POST['email']);
    $password= $auth->cleanInputData($_POST['password']);
    $loginUser= $auth->login($email);
    if ($loginUser !=null) {
        $passwordVerify= password_verify($password,$loginUser['password']);
        if ($passwordVerify) {

            if (!empty($_POST['rem'])) { /// jodi remember e click kore tahole 30 din access thakbe
                setcookie("email",$email,time()+(30*24*60*60),'/'); // cookie 30 day thakbe and cookie ('/') jekono jayga theke acces kora jabe
                setcookie("pass",$password,time()+(30*24*60*60),'/'); // cookie 30 day thakbe and cookie ('/') jekono jayga theke acces kora jabe
                
                // $_SESSION['3user']=$email;

            }else{
                setcookie("email","",1,"/");
                setcookie("pass","",1,"/");
                

            }
            echo 'login';
            $_SESSION['logged']=true;
            $_SESSION['user']=$email;
            $_SESSION['uuser']=$email;
            $_SESSION['ppass']=$password;
        }else{
        echo $auth->errorMsg("danger","Password is Incorect!");
        }
       
    }
    else{
        echo $auth->errorMsg("danger","User not Found!");
    }
}

//forgot password handeler

if (isset($_POST['action']) && $_POST['action']== 'forgot') {
    // $email= $_POST['email'];
    // echo $email;
    $email= $auth->cleanInputData($_POST['email']);
    $user_found= $auth->currentUser(($email));
    if ($user_found !=NULL) {
        $token= uniqid(); //generate random alpha numaric charecters
        $token= str_shuffle($token); // random value genarate korbe ba Saffal Dibe
        $auth->forgotPassword($token,$email);

        try{
            $mail->isSMTP(); // ei method e emai send hobe
            $mail->Host= 'smtp.gmail.com'; // Gmail er server er name
            $mail->SMTPAuth= true;
            $mail->Username= Database::USERNAME;
            $mail->Password= Database::PASSWORD ;
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         //Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
            $mail->Port  = 587;     

            //Recipients
            $mail->setFrom(Database::USERNAME);
            $mail->addAddress($email); // kon email e pathabo
            $mail->setFrom('idbmannaf@gmail.com', 'User Management System');

            $mail->isHTML(true);                                  //Set email format to HTML
            $mail->Subject = 'Reset Password';
            $mail->Body    = '<h3>Click the below linik to reset your password <br> <a href="http://localhost/All_Project/user-management/reset-pass?email='.$email.'&token='.$token.'">http://localhost/All_Project/user-management/reset-pass?email='.$email.'&token='.$token.'</a> <br> Regards <br> Abdul Mannaf! </h3>';
            $mail->send();

            echo $auth->errorMsg('success', 'We have send you the reset link in your email id please check your email');


        } catch (Exception $e) {
          echo $auth->errorMsg('danger','Something Went Wrong Please try again!');
         }

    }else{
        echo $auth->errorMsg('info','This email not registerd!');
    }
}

//Handle checking User is Logged in Or Not
if (isset($_POST['action']) && $_POST['action']=='checkUser') {
    
   if (!$auth->currentUser($_SESSION['user'])) {
       echo 'bye';
       unset($_SESSION['user']);
   }
}
?>