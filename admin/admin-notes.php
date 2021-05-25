<?php
require_once 'assets/php/admin-header.php';
?>
<div class="row">
    <div class="col-lg-12">
        <div class="card my-2 border-danger">
            <div class="card-header bg-secondary text-white">
                <h4 class="m-0">Total Notes By All Users</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive" id="showAllNotes">
                    <p class="text-center align-self-center lead">Please wait...</p>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="noteDetails">
    <div class="modal-dialog modal-dialog-center mw-100 w-50">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title bg-success text-white" id="getNoteTitle"></h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="card-group">
                    <div class="card border-primary">
                        <div class="card-body">
                            <p id="getNote"></p>
                        </div>
                    </div>
                </div>
                <div class="model-footer d-flex justify-content-between">
                    <p class="text-dark" id="author"></p>
                    <p class="text-dark" id="created"></p>
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.24/datatables.min.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script>
    $(document).ready(function() {
        $('#open-nav').click(function() {
            // e.preventDefault();
            $(".admin-nav").toggleClass('animate');
        })

        showAllNotes();
        // Fetch Deleted users Ajax Request
        function showAllNotes() {
            $.ajax({
                url: 'assets/php/admin-action.php',
                method: 'post',
                data: {
                    action: "showAllNotes"
                },
                success: function(response) {
                    $("#showAllNotes").html(response);
                    //Pagination
                    $("table").DataTable({
                        order: [0, 'desc'],
                    });
                }
            })
        }

        //Delete Note
        $("body").on("click", ".noteDeleteBtn", function(e) {
            delete_note = $(this).attr('id');
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
                            delete_note: delete_note
                        },
                        success: function(response) {
                            Swal.fire(
                                'Deleted!',
                                'Your file has been deleted.',
                                'success'
                            )
                            showAllNotes();
                        }
                    });

                }
            })
        });
        // Notes Details ajax Request

        $("body").on("click", ".noteBtn", function() {
            view_notes = $(this).attr('id');
            $.ajax({
                url: 'assets/php/admin-action.php',
                method: 'post',
                data: {
                    view_notes: view_notes
                },
                success: function(response) {
                    data = JSON.parse(response);
                    $("#getNoteTitle").html(data[0].title);
                    $("#getNote").html("<b>Note : </b>" + data[0].note);
                    $("#author").html("<b>Author : </b>" + data[0].name);
                    $("#created").html("<b>Created : </b>" + data[0].cdate);

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