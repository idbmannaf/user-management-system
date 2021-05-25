<?php 
session_start();
if (isset($_SESSION['user']) && $_SESSION['reg']=true) {
   echo "<script>window.location='home.php'</script>";
// header('loation:home.php');
}
include 'assets/php/config.php';

$conn= new Database();

$sql= "UPDATE visitors SET hits= hits+1 WHERE id=0";
$stmt= $conn->conn->prepare($sql);
$stmt->execute();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Management System</title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" />
</head>

<body>
    <div class="container">
        <!-- Login Form Start  -->
        <div class="row justify-content-center wrapper "  id="login-box">
            <div class="col-lg-10 my-auto">
                <div class="card-group shadow">
                    <div class="card rounded-left p-4" style="flex-grow:1.4;">
                        <h1 class="text-center font-weight-bold text-primary">Sign In to Account</h1>
                        <hr class="my-3">
                        <form action="" method="post" class="px-3" id="login-form">
                            <div id="loginError"></div>
                            <div class="input-group input-group-md form-group mb-3">
                                <span class="input-group-text"><i class="fas fa-envelope "></i></span>
                                <input type="email" class="form-control" placeholder="E-Mail" id="email" name="email" required value="<?php echo $_SESSION['uuser']?? '';?>">
                               
                            </div>
                            <div class="input-group input-group-md form-group mb-3 parenteye">
                                <span class="input-group-text"><i class="fas fa-key "></i></span>
                                <input type="password" class="form-control" placeholder="password" id="textPassword" value="<?php echo $_SESSION['ppass']?? '';?>" name="password" required>
                                <div class="eyes" id="eyes"><i class="fas fa-eye-slash" id="toggle_pwd"></i></div>
                                <!-- <div class="eyes"><i class="far fa-eye " id="eyes"></i></div> -->
                            </div>
                            <div class="form-group d-flex justify-content-between">
                                <div class="form-check float-right">
                                    <input class="form-check-input" type="checkbox" value="" id="rem" name="rem" id="custom-check">
                                    <label class="form-check-label" for="rem">
                                        Remember me
                                    </label>
                                </div>
                                <div class="forgot">
                                    <a href="#" id="forgot-link">Forgot Password</a>
                                </div>

                            </div>
                            <div class="form-group mt-3">
                                <input type="submit" name="submit" id="login" value="Sign In" class="form-control btn btn-primary sbtn">
                            </div>

                        </form>
                    </div>
                    <div class="card justify-content-center rounded-right mycolor p-4">
                        <h1 class="text-center fw-bold text-white">Hello Friends</h1>
                        <hr style="height: 5px; background-color:white" class="my-3 bg-white">
                        <p class="text-center fw-bolder text-light">Enter your personal details and start your journy with us!</p>
                        <button class="btn btn-outlin-light btn-lg align-self-center fw-bolder mt-4 myLinkbtn" id="signup">Sign Up</button>
                    </div>

                </div>
            </div>
        </div>
        <!-- Login Form End  -->
<!-- Register Form Start  -->
<div class="row justify-content-center wrapper " style="display: none;" id="register-box">
            <div class="col-lg-10 my-auto">
                <div class="card-group shadow">
                <div class="card justify-content-center rounded-right mycolor p-4">
                        <h1 class="text-center fw-bold text-white">Welcome Back! </h1>
                        <hr style="height: 5px; background-color:white" class="my-3 bg-white">
                        <p class="text-center fw-bolder text-light">Keep Connected With Us Please Login with your personal info!</p>
                        <button class="btn btn-outlin-light btn-lg align-self-center fw-bolder mt-4 myLinkbtn" id="login-btn">Log In</button>
                    </div>
                    <div class="card rounded-left p-4" style="flex-grow:1.4;">
                        <h1 class="text-center font-weight-bold text-primary">Create an Account</h1>
                        <hr class="my-3">
                        <form action="" method="post" class="px-3" id="register-form">
                            <div id="error"></div>
                        <div class="input-group input-group-md form-group mb-3">
                                <span class="input-group-text"><i class="fas fa-user "></i></span>
                                <input type="text" class="form-control" placeholder="Full name" id="name" name="name" required>
                            </div>
                            <div class="input-group input-group-md form-group mb-3">
                                <span class="input-group-text"><i class="fas fa-envelope "></i></span>
                                <input type="email" class="form-control" placeholder="E-Mail" id="remail" name="remail" required>
                            </div>
                            <div class="input-group input-group-md form-group mb-3">
                                <span class="input-group-text"><i class="fas fa-key "></i></span>
                                <input type="password" class="form-control" placeholder="password" id="rpassword" name="rpassword" minlength="5" required>
                                
                            </div>
                            <div class="input-group input-group-md form-group mb-3">
                                <span class="input-group-text"><i class="fas fa-key "></i></span>
                                <input type="password" class="form-control" placeholder="Confirm Password" id="crpassword" name="crpassword" minlength="5" required>
                            </div> 
                            <div class="form-group">
                                <div id="passError" class="text-center text-danger fw-bold"></div>
                            </div>
                           
                            <div class="form-group mt-3">
                                <input type="submit" name="submit" value="Sign Up" id="register-btn" class="form-control btn btn-primary sbtn">
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
<!-- Register Form End  -->
 <!-- forgot password start  -->
 <div class="row justify-content-center wrapper" style="display: none;" id="forgot-box">
            <div class="col-lg-10 my-auto">
                <div class="card-group shadow">
                <div class="card justify-content-center rounded-left mycolor p-4">
                        <h1 class="text-center fw-bold text-white">Reset Password</h1>
                        <hr style="height: 5px; background-color:white" class="my-3 bg-white">
                        <button class="btn btn-outlin-light btn-lg align-self-center fw-bolder mt-4 myLinkbtn" id="back-link">Back</button>
                    </div>
                    <div class="card rounded-left p-4" style="flex-grow:1.4;">
                        <h1 class="text-center font-weight-bold text-primary">Forgot Your Password</h1>
                        <hr class="my-3">
                        <p class="text-center text-secondery" >To reset your password. enter the registered e-mail address and we will send you the rest instructions on your e-mail</p>
                        
                        <form action="" method="post" class="px-3" id="forgot-form">
                            <div id="forgotAlert"></div>
                            <div class="input-group input-group-md form-group mb-3">
                                <span class="input-group-text"><i class="fas fa-envelope "></i></span>
                                <input type="email" class="form-control" placeholder="E-Mail" id="email" name="email" required>
                            </div>
                            <div class="form-group mt-3">
                                <input type="submit" name="submit" id="forgot-btn" value="Reset Password" class="form-control btn btn-primary sbtn">
                            </div>

                        </form>
                    </div>
                  

                </div>
            </div>
        </div>             
 <!-- forgot password End  -->

    </div>

    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/jquery-3.6.0.min.js"></script>
    <script>
    $(document).ready(function(){

        $("#signup").click(function(){
            $("#login-box").hide();
            $("#register-box").show();
           
        });

        $("#login-btn").click(function(){
            $("#register-box").hide();
            $("#login-box").show()
        });
        $("#forgot-link").click(function(){
            $("#forgot-box").show();
            $("#login-box").hide();
            
            
        });
        $("#back-link").click(function(){
            $("#forgot-box").hide();
            $("#login-box").show();
        });
        // password Seen 
       
            $("#toggle_pwd").click(function () {
                $(this).toggleClass("fa-eye fa-eye-slash");
               var d = $(this).hasClass("fa-eye-slash") ? "text" : "password";
                if (d== 'text') {
                    $("#textPassword").attr('type',"password");
                }else{
                    $("#textPassword").attr('type',"text");
                }
                
            });
      

        //register Ajax Request
        $("#register-btn").click(function(e){
           if($("#register-form")[0].checkValidity()){
                e.preventDefault();
                $("#register-btn").val("Please Wait....");
               let pass = $("#rpassword") .val();
               let repass= $("#crpassword").val();
                if( pass != repass){
                    $("#passError").text(" * Password did not Matched");
                    $("#register-btn").val("Sign Up");
                }else{
                    $("#passError").text("");
                    $.ajax({
                        url:'assets/php/action.php',
                        method:'post',
                        data: $('#register-form').serialize()+'&action=register', 
                        success: function(response){
                            $("#register-btn").val("Sign Up"); // button er value change korte
                           if (response === 'Register') {
                               window.location='home.php';
                           }else{
                                $("#error").html(response);
                           }
                        },

                    });
                }
           }
        });
        //Login
        $("#login").click(function(e){
            if($("#login-form")[0].checkValidity()){
                e.preventDefault();
                $("#login").val("Please Wait...");
                $.ajax({
                    url: 'assets/php/action.php',
                    method: 'post',
                    data: $("#login-form").serialize() +'&action=login',
                    success: function(response){
                        // console.log(response);
                        $("#login").val("Sign In");
                        if (response === 'login') {
                               window.location='home.php';
                           }else{
                                $("#loginError").html(response);
                           }
                    }
                });
            }
        });
        $("#forgot-btn").click(function(e){
           
          if($("#forgot-form")[0].checkValidity()){
            e.preventDefault();
            $("#forgot-btn").val("please wait");
            $.ajax({
                url: 'assets/php/action.php',
                method: 'post',
                data: $("#forgot-form").serialize() + '&action=forgot',
                success: function(response){
                    $("#forgot-btn").val("Reset Password");
                    $("#forgot-form")[0].reset();
                    $("#forgotAlert").html(response);
                    
                }
            });
          }
        });


    });
    </script>
</body>

</html>