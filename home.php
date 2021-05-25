
<?php require_once 'assets/php/header.php'; ?>

<div class="container">
   <div class="row">
      <div class="col-lg-12">
         <?php if ($verified == 'Not Verified!') { ?>
            <div class="alert alert-danger alert-dismissible fade show text-center mt-2 m-0" role="alert">
               <strong>Your email is not verified We've sent you and E-mail Verification link on your E-mail check and verify now!</strong>
               <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
         <?php } ?>
      </div>
      <h4 class="text-center text-primary mt-2"> Write Your Note Here & Access Anytime!</h4>
      <div class="card border-primary p-0">
         <h5 class="card-header bg-primary d-flex justify-content-between ">
            <span class="text-light lead align-self-center">All Notes</span>
            <a href="#" class="btn btn-light" data-bs-toggle="modal" data-bs-target="#addNoteModal"><i class="fas fa-plus-circle fa-lg" aria-hidden="true"></i>&nbsp; Add New Note</a>
         </h5>
         <div class="card-body">
            <div class="table-responsive" id="showNote">
               <p class="text-center lead mt-5">Please Wait ....!</p>
            </div>
         </div>
      </div>
   </div>
</div>

<!-- Start add New Note Model  -->
<div class="modal fade" id="addNoteModal">
   <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
         <div class="modal-header bg-success">
            <h5 class="modal-title text-light">Add New Note</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
         </div>
         <div class="modal-body">
            <form action="" method="post" id="add-note-form" class="px-3">
               <div id="addNoteAlert"></div>
               <div class="form-group">
                  <input type="text" name="title" id="title" class="form-control form-control-lg" placeholder="Enter Title" required>
               </div>
               <div class="form-group my-3">
                  <textarea name="note" class="form-control form-control-lg" placeholder="Writhe Your Note Here...." rows="6" required></textarea>
               </div>
               <div class="form-group">
                  <input type="submit" class=" btn btn-success form-control" value="Add Note" name="addNote" id="addNoteBtn">
               </div>
            </form>
         </div>
      </div>
   </div>
</div>
<!-- End add New Note Model  -->
<!-- Start Edit Note Model  -->
<div class="modal fade" id="editNoteModal">
   <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
         <div class="modal-header bg-info">
            <h5 class="modal-title text-light">Edit Note</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
         </div>
         <div class="modal-body">
            <form action="" method="post" id="edit-note-form" class="px-3">
               <input type="hidden" name="id" id="id">
               <div class="form-group">
                  <input type="text" name="title" id="etitle" class="form-control form-control-lg" placeholder="Enter Title" required>
               </div>
               <div class="form-group my-3">
                  <textarea name="note" id="note" class="form-control form-control-lg" placeholder="Writhe Your Note Here...." rows="6" required></textarea>
               </div>
               <div class="form-group">
                  <input type="submit" class=" btn btn-info form-control" value="Update Note" name="editNote" id="editNoteBtn">
               </div>
            </form>
         </div>
      </div>
   </div>
</div>
<!-- End Edit Note Model  -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="assets/js/bootstrap.bundle.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.24/datatables.min.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script>
   $(document).ready(function() {
      $("table").DataTable();

      //Add New Note Ajaax Request
      $("#addNoteBtn").click(function(e) {
         if ($("#add-note-form")[0].checkValidity()) {
            e.preventDefault();
            $("#addNoteBtn").val("Please Wait...");
            $.ajax({
               url: 'assets/php/proccess.php',
               method: 'post',
               data: $("#add-note-form").serialize() + '&action=add_note',
               success: function(response) {
                  $("#addNoteBtn").val("Add Note");
                  $("#add-note-form")[0].reset();
                  $("#addNoteModal").modal('hide');
                  Swal.fire({
                     title: 'Note Added Successfully!',
                     icon: 'success'
                  });
                  displayUserNote();
               }

            });
         }
      });

      //edit Note of An user Ajax Request
      $("body").on("click", ".editBtn", function(data) {
         data.preventDefault();
         edit_id = $(this).attr('id');
         // console.log(edit_id);
         $.ajax({
            url: 'assets/php/proccess.php',
            method: 'post',
            data: {
               id: edit_id
            },
            success: function(response) {
               data = JSON.parse(response);
               $("#id").val(data.id);
               $("#etitle").val(data.title);
               $("#note").val(data.note);
            }
         });

      });

      //Update Note in modal
      $("#editNoteBtn").click(function(e) {
         if ($("#edit-note-form")[0].checkValidity()) {
            e.preventDefault();
            $.ajax({
               url: 'assets/php/proccess.php',
               method: 'post',
               data: $("#edit-note-form").serialize() + '&action=update',
               success: function(response) {
                  Swal.fire({
                     title: 'Note Updated Successfully!',
                     icon: 'success',
                  });
                  $("#edit-note-form")[0].reset();
                  $("#editNoteModal").modal('hide');
                  displayUserNote();
               }
            });
         }
      });
      //Delete a note of an user

      $("body").on("click", ".deleteBtn", function(e) {
         e.preventDefault();
         delete_id = $(this).attr('id');
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
               url: 'assets/php/proccess.php',
            method: 'post',
            data: { del_id: delete_id },
            success: function(response){
               console.log(response);
               Swal.fire(
                  'Deleted!',
                  'Your file has been deleted.',
                  'success'
               )
               displayUserNote();
            }
              }); 
               
            }
         })
      });
      //Display Note Details
      $("body").on("click",".veiwBtn",function (e){
         e.preventDefault();
         viewId= $(this).attr("id");
        $.ajax({
         url: 'assets/php/proccess.php',
            method: 'post',
            data: { viewId: viewId },
            success: function(response){
               data= JSON.parse(response);
               Swal.fire({
                  title: '<strong>Note: ID('+data.id+')</strong>',
                  icon: 'info',
                  html: '<b>Title: </b>' + data.title +'<br><br><b>Note: </b>'+data.note+'<br><br><b>Written on: </b>'+ data.created_at+'<br><br><b>Updated on: </b>'+ data.updated_at ,
                  showCloseButton:true,
               })
            }
        });

      });

      displayUserNote();
      //Display All Note of an User
      function displayUserNote() {
         $.ajax({
            url: 'assets/php/proccess.php',
            method: 'post',
            data: {
               action: 'displayNote'
            },
            success: function(response) {
               $("#showNote").html(response);
               $("table").DataTable({
                  order: [0, 'desc']
               });
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