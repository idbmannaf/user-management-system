<?php
require_once 'assets/php/admin-header.php';
?>
<div class="row">

    <div class="row justify-content-center my2">
        <div class="col-lg-6 mt-4" id="showAllNotification">

        </div>
    </div>
</div>


<!-- Footer Area  -->
</div>
</div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="../assets/js/jquery-3.6.0.min.js"></script>
<script src="../assets/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script>
    $(document).ready(function() {
        $('#open-nav').click(function() {
            // e.preventDefault();
            $(".admin-nav").toggleClass('animate');
        })
        fetchNotification();
        // Fetch all Notification Ajax Request

        function fetchNotification(){
            $.ajax({
                url: 'assets/php/admin-action.php',
                method: 'post',
                data: {action:'showAllNotification'},
                success: function (response){
                    // console.log(response);
                    $("#showAllNotification").html(response);
                }
            });
        }

        //Check Noticiation
        checkNotification();
        function checkNotification(){
            $.ajax({
                url: 'assets/php/admin-action.php',
                method: 'post',
                data: {action:'checkNotification'},
                success: function (response){
                    $("#checkNotificationIcon").html(response);
                }
            });
        }

        //Delete Notification
        $("body").on("click",".btn-close",function(e){
            e.preventDefault();
            notificationId= $(this).attr('id');
            $.ajax({
                url: 'assets/php/admin-action.php',
                method: 'post',
                data: {notificationId:notificationId},
                success: function (response){
                    console.log(response);
                    checkNotification();
                    fetchNotification();
                    // $("#checkNotificationIcon").html(response);
                }
            });
        });

    });
</script>

</body>

</html>