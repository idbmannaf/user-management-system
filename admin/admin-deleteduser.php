<?php
require_once 'assets/php/admin-header.php';
?>
<div class="row">
<div class="col-lg-12">
        <div class="card my-2 border-danger">
            <div class="card-header bg-success text-white">
                <h4 class="m-0">Total Registered Users</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive" id="showAllDeletedUsers">
                    <p class="text-center align-self-center lead">Please wait...</p>
                </div>
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
    
    $(document).ready(function(){
        $('#open-nav').click(function(){
            // e.preventDefault();
            $(".admin-nav").toggleClass('animate');
        })
        showAllDeletedUsers();
// Fetch Deleted users Ajax Request
        function showAllDeletedUsers() {
            $.ajax({
                url: 'assets/php/admin-action.php',
                method: 'post',
                data: {
                    action: "deletedUsers"
                },
                success: function(response) {
                    $("#showAllDeletedUsers").html(response);
                    //Pagination
                    $("table").DataTable({
                        order: [0, 'desc'],
                    });
                }
            })
        }
        //  Restore Deleted Users Ajax Request
        $("body").on("click",".restoreUser", function(e){
            restore_user = $(this).attr('id');
            // console.log(restore_user);
         Swal.fire({
            title: 'Are you sure want Restore This User?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, Restored It!'
         }).then((result) => {
            if (result.isConfirmed) {
              $.ajax({//Here ajax request
               url: 'assets/php/admin-action.php',
            method: 'post',
            data: { restore_user: restore_user },
            success: function(response){
               console.log(response);
               Swal.fire(
                  'Restored!',
                  'User has been restored.',
                  'success'
               )
               showAllDeletedUsers();
            }
              }); 
               
            }
         })
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