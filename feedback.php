<?php require_once 'assets/php/header.php'; ?>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-8 mt-3">
            <?php if ($verified == 'Verified!') : ?>
                <div class="card border-primary">
                    <div class="card-header lead text-center bg-primary text-white">
                        Send FeedBack to Admin</div>
                    <div class="card-body">
                        <form action="" method="post" id="feedback_form" class="px-4">
                            <div class="form-group">
                                <input type="text" name="subject" placeholder="Write your Subject" class="form-control form-control-lg rounded-0" required>
                            </div>
                            <div class="form-group">
                                <textarea name="feedback" class="form-control form-control-lg" placeholder="Write Your Feedback Here..." rows="8"></textarea>
                            </div>
                            <div class="form-group">
                                <input type="submit" value="Send FeedBack" name="feedBackBtn" id="feedBackBtn" class="btn btn-primary btn-block btn-lg rounded-0">
                            </div>
                        </form>
                    </div>
                </div>
            <?php else : ?>
                <h1 class="text-center text-secondery mt-5">Verify Your E-mail First to send FeedBack </h1>
            <?php endif; ?>
        </div>
    </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="assets/js/bootstrap.bundle.min.js"></script>
<!-- <script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script> -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script>
    $(document).ready(function() {
        //Send FeedBack to admin ajax request
        $("#feedBackBtn").click(function(e) {
            e.preventDefault()
            if ($("#feedback_form")[0].checkValidity()) {

                $("#feedBackBtn").val("Please Wait..");
                $.ajax({
                    url: 'assets/php/proccess.php',
                    method: 'post',
                    data: $("#feedback_form").serialize() + '&action=feedback',
                    success: function(response) {
                        $("#feedback_form")[0].reset();
                        $("#feedBackBtn").val("Send FeedBack");
                        // Swal.fire({
                        //     title: 'Feedback Successfully Sent to the Admin',
                        //     icon: 'success'
                        // });
                        toastr.success('Feedback Successfully Sent to the Admin');
                        toastr.options = {
                            "closeButton": false,
                            "debug": false,
                            "newestOnTop": true,
                            "progressBar": false,
                            "positionClass": "toast-top-right",
                            "preventDuplicates": false,
                            "onclick": null,
                            "showDuration": "300",
                            "hideDuration": "1000",
                            "timeOut": "5000",
                            "extendedTimeOut": "1000",
                            "showEasing": "swing",
                            "hideEasing": "linear",
                            "showMethod": "fadeIn",
                            "hideMethod": "fadeOut"
                        }
                    }
                });
            }
        });
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