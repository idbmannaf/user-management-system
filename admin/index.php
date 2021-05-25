
<?php
session_start();

if (isset($_SESSION['username'])) {
    header('location:admin-dashboard.php');
    // echo $_SESSION['username'];

}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" />
    <style>
        
        html,body{
            height: 100%;
        }
    </style>
</head>

<body>
    <div class="bg-dark">
        <div class="container" style="height: 100vh;">
            <div class="row h-100 align-items-center justify-content-center">
                <div class="col-lg-5">
                    <div class="card border-danger shadow-lg">
                        <div class="card-header bg-danger">
                            <h3 class="m-0 text-white"><i class="fas fa-cog" aria-hidden="true"></i> &nbsp; Admin Panel Login</h3>
                        </div>
                        <div class="card-body">
                            <form action="" method="post" class="px-3" id="adminLoginForm">
                            <div id="adminLoginError"></div>
                                <div class="form-group">
                                    <input type="text" name="username" placeholder="Username" class="form-control form-control-lg">
                                </div>
                                <div class="form-group my-2">
                                    <input type="password" name="password" placeholder="Password" class="form-control form-control-lg">
                                </div>
                                <div class="form-group">
                                    <input type="submit" name="login" value="Login" class="form-control form-control-lg btn btn-danger" id="adminLoginBtn">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="../assets/js/jquery-3.6.0.min.js"></script>
    <script src="../assets/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script>
    
    $(document).ready(function(){
        $("#adminLoginBtn").click(function (e){
            if ($("#adminLoginForm")[0].checkValidity()) {
                e.preventDefault();
                $("#adminLoginBtn").val("Please Wait...");
                $.ajax({
                    url: 'assets/php/admin-action.php',
                    method: 'post',
                    data: $("#adminLoginForm").serialize() + '&action=adminloginForm',
                    success: function (response){
                        if(response == "admin Login"){
                            window.location= 'admin-dashboard.php';
                        }else{
                           $("#adminLoginError").html(response);
                           $("#adminLoginBtn").val("Login");
                        }
                    }
                });

                
            }
        });
    });
    </script>

</body>

</html>