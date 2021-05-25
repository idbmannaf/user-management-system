<?php require_once 'assets/php/header.php'; ?>

<div class="container">
    <div class="row justify-content-center my3">
        <div class="col-lg-6 mt-4" id="showAllNotification">
            
        </div>
    </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="assets/js/bootstrap.bundle.min.js"></script>
<script>
$(document).ready(function(){

    //Fetch notification of an User
    fetchNotification();
    function fetchNotification(){
        $.ajax({
            url:'assets/php/proccess.php',
            method: 'post',
            data: {action: 'notifiaction'},
            success: function (response){
               $("#showAllNotification").html(response);
            // console.log(response);
            }
        });
    }
// Check Notification
checkNotification();
    function checkNotification(){
        $.ajax({
            url:'assets/php/proccess.php',
            method: 'post',
            data: {action: 'checknotifiaction'},
            success: function (response){
              $("#checkNotification").html(response);
            // console.log(response);
            }
        });
    }
    // Remove Notification
    $("body").on("click",".btn-close", function (e){
        e.preventDefault();
        notificationId = $(this).attr("id");
        $.ajax({
            url:'assets/php/proccess.php',
            method: 'post',
            data: {notificationId: notificationId},
            success: function(response){
                checkNotification();
                fetchNotification();

            }
        });
    });
   //Checking User Is Logged in or Not

   $.ajax({
      url: 'assets/php/action.php',
      method: 'post',
      data: {action:'checkUser'},
      success: function(response){
         console.log(response);
         if (response == 'bye') {
            window.location="index.php";
         }
      }
    });
    
});
</script>
</body>

</html>