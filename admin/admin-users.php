<?php
require_once 'assets/php/admin-header.php';
?>

</style>
<div class="row">
    <div class="col-lg-12">
        <div class="card my-2 border-success">
            <div class="card-header bg-success text-white">
                <h4 class="m-0">Total Registered Users</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive" id="showAllUsers">
                    <p class="text-center align-self-center lead">Please wait...</p>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- display user's Details Modal  -->

<div class="modal fade" id="userinfo">
    <div class="modal-dialog modal-dialog-center mw-100 w-50">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="getName"></h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="card-group">
                    <div class="card border-primary">
                        <div class="card-body">
                            <p id="getEmail"></p>
                            <p id="getPhone"></p>
                            <p id="getDob"></p>
                            <p id="getGender"></p>
                            <p id="getCreated"></p>
                            <p id="getVerified"></p>
                        </div>
                    </div>
                    <div class="card align-self-center ms-3" id="getImage">
                        
                        
                    </div>
                </div>
                <div class="model-footer">
                    <button type="button" class="btn btn-secondary mt-2" data-bs-dismiss="modal">Close</button>
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
<script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.24/datatables.min.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script>
    $(document).ready(function() {
        $('#open-nav').click(function() {
            $(".admin-nav").toggleClass('animate');
        });

        showAllUser();
        //Fetch All Users
        function showAllUser() {
            $.ajax({
                url: 'assets/php/admin-action.php',
                method: 'post',
                data: {
                    action: "fetchUsers"
                },
                success: function(response) {
                    $("#showAllUsers").html(response);
                    //Pagination
                    $("table").DataTable({
                        order: [0, 'desc'],
                    });
                }
            })
        }

        //Display User Details
        $("body").on("click", ".userVeiwBtn", function (e){
                e.preventDefault();
               user_id= $(this).attr("id");
               $.ajax({
                url: 'assets/php/admin-action.php',
                method: 'post',
                data: {user_id: user_id},
                success: function(response) {
                 data= JSON.parse(response);
                //  console.log(data[0].id  +" "+"(ID:"+data[0].id+")");
                //  console.log(data[0].id + data[0].name);
                 $("#getName").text(data[0].name  +" "+"(ID:"+data[0].id+")");
                 $("#getPhone").html("<span class='fw-bold'>Gender:</span>  <span class='float-end'>"+data[0].phone+"</span>");
                 $("#getDob").html("<span class='fw-bold'>DOB:</span>  <span class='float-end'>"+data[0].dob+"</span>");
                 $("#getGender").html("<span class='fw-bold'>Gender:</span>  <span class='float-end'>"+data[0].gender+"</span>");
                 $("#getCreated").html("<span class='fw-bold'>Created:</span>  <span class='float-end'>"+data[0].crated_at+"</span>");
                 $("#getVerified").text("Verified: "+ data[0].verified);
                 if (data[0].verified == 1) {
                    $("#getVerified").html("<span class='fw-bold'>Verify_Status:</span>  <span class='text-danger'>Verified</span>" );
                 }else{
                    $("#getVerified").html("<span class='fw-bold'>Verify_Status:</span>  <span class='text-danger float-end'>Not Verified</span>" );
                 }
                 if (data[0].photo !='' ) {
                     $("#getImage").html('<img class="img-thumbnail img-fluid align-self-center" src="../assets/php/'+data[0].photo+'">');
                 }else{
                    $("#getImage").html('<img class="img-thumbnail img-fluid align-self-center " src="../assets/img/dummy.png">');
                 }
                }
               });

        });

        //Delete a Users

        $("body").on("click",".userDeleteBtn", function(e){
            delete_user = $(this).attr('id');
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
              $.ajax({//Here ajax request
               url: 'assets/php/admin-action.php',
            method: 'post',
            data: { delete_user: delete_user },
            success: function(response){
               console.log(response);
               Swal.fire(
                  'Deleted!',
                  'Your file has been deleted.',
                  'success'
               )
               showAllUser();
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