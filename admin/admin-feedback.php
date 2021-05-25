<?php
require_once 'assets/php/admin-header.php';
?>
<div class="row">
    <div class="col-lg-12">
        <div class="card my-2 border-warning">
            <div class="card-header bg-warning text-white">
                <h4 class="m-0">Feedback By All Users</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive" id="showAllFeedback">
                    <p class="text-center align-self-center lead">Please wait...</p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Reply feedback Modal -->
<div class="modal fade" id="feedbackModal">
    <div class="modal-dialog modal-dialog-center mw-100 w-50">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title ">Reply This Feedback</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="" method="post" class="px-3" id="feedbackReply">
                    <div class="form-group">
                        <textarea name="msg" id="msg" cols="6" rows="5" placeholder="Write Your Message Here..." class="form-control" required></textarea>
                    </div>
                    <div class="form-group">
                        <input type="submit" value="Send Reply" name="feedReplyBtn" id="feedReplyBtn" class="btn btn-primary mt-3 form-control">
                    </div>
                </form>

            </div>
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
<script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.24/datatables.min.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script>
    $(document).ready(function() {
        $('#open-nav').click(function() {
            // e.preventDefault();
            $(".admin-nav").toggleClass('animate');
        })
        showAllFeedback();
        //Show All Feedback
        function showAllFeedback() {
            $.ajax({
                url: 'assets/php/admin-action.php',
                method: 'post',
                data: {
                    action: 'showAllFeedback'
                },
                success: function(response) {
                    $("#showAllFeedback").html(response);
                    $("table").DataTable({
                        order: [0, 'desc'],
                    });
                }

            });
        }
        //Feedback Delete
        $("body").on("click", ".feedBackDeleteBtn", function(e) {
            e.preventDefault();
            delete_feed = $(this).attr('id');
            // console.log(delete_feed);
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({ //Here ajax request
                        url: 'assets/php/admin-action.php',
                        method: 'post',
                        data: {
                            delete_feed: delete_feed
                        },
                        success: function(response) {
                            Swal.fire(
                                'Deleted!',
                                'Your file has been deleted.',
                                'success'
                            )
                            console.log(response);
                            showAllFeedback();
                        }
                    });

                }
            })
        });

        //Current Selected Userid and Feedback id 
        var uid;
        var fid;
        $("body").on("click", ".replyFeedbackBtn", function() {
            uid = $(this).attr("uid");
            fid = $(this).attr("fid");

            //Send Feedback replay
            $("#feedReplyBtn").click(function(e) {

                if ($("#feedbackReply")[0].checkValidity()) {
                    let msg = $("#msg").val()
                    e.preventDefault()
                    $("#feedReplyBtn").val("Please Wait..");
                    $.ajax({
                        url: 'assets/php/admin-action.php',
                        method: 'post',
                        data: {
                            uid: uid,
                            fid: fid,
                            msg: msg
                        },
                        success: function(response) {
                            $("#feedReplyBtn").val("Send Reply");
                            $("#feedbackModal").modal('hide');
                            $("#feedbackReply")[0].reset();
                            Swal.fire(
                                'Sent !',
                                'Reply set succesfully to the user !'
                            )
                            showAllFeedback();
                        }
                    })
                }
            });

        });
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


    });
</script>

</body>

</html>