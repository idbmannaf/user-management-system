<?php
session_start();
require_once 'adminDb.php';
$admin = new Admin();

if (isset($_POST['action']) && $_POST['action'] == 'adminloginForm') {
    //    print_r($_POST);
    $username = $admin->cleanInputData($_POST['username']);
    $password = $admin->cleanInputData($_POST['password']);

    $sha1 = sha1($password);
    // echo $username .'<br>';
    // echo $password .'<br>';
    // echo $sha1 .'<br>';
    $login = $admin->admin_login($username, $sha1);
    if ($login != null) {
        echo "admin Login";
        $_SESSION['username'] = $username;
        $_SESSION['adminLogged'] = true;
    } else {
        echo $admin->errorMsg('danger', "Username or Password incorrect");
    }
}
//handle all users ajax request (deleted 0 means Deleted)

if (isset($_POST['action']) && $_POST['action'] == 'fetchUsers') {
    
    $users = $admin->showAllusers(0);
    if ($users) {
       $output = ' <table class="table table-striped table-hover text-center">
       <thead>
          <tr>
          <th>#</th>
           <th>Image</th>
           <th>Name</th>
           <th>Email</th>
           <th>Phone</th>
           <th>Gender</th>
           <th>Verified</th>
           <th>Action</th>
          </tr>
       </thead><tbody>';
       foreach ($users as $row) {
           if ($row['photo'] !='') {
               $photo = '../assets/php/'.$row['photo'];
           }else{
            $photo = '../assets/img/dummy.png'; 
           }
           if ($row['verified'] == 0) {
             $veried=  '<span class="text-danger">Unverified</span>';
           }else{
            $veried= '<span class="text-success">Verified</span>';
           }
         $output .= '   <tr>
                <td>'.$row['id'].'</td>
                <td><img width="40px" height="40px" class="rounded-circle" src="'.$photo.'"></td>
                <td>'.$row['name'].'</td>
                <td>'.$row['email'].'</td>
                <td>'.$row['phone'].'</td>
                <td>'.$row['gender'].'</td>
                <td>'.$veried.'</td>
                <td>
                <a href="#" id='. $row['id'] .' title="View User" data-bs-toggle="modal" data-bs-target="#userinfo"  class="text-success btn userVeiwBtn"><i class="fas fa-info-circle fa-lg"></i></a>
                <a href="#" id=' . $row['id'] . ' title="Delete user" class="text-primary btn userEditBtn" data-bs-toggle="modal" data-bs-target="#editNoteModal"><i class="fas fa-edit fa-lg"></i></a>
                <a href="#" id=' . $row['id'] . ' title="Edit user" class="text-danger btn userDeleteBtn"><i class="fas fa-trash-alt fa-lg"></i></a>
             
                </td>
                              </tr>';
       }
       $output .='</tbody></table>';
       echo $output;
    }else{
       echo '<h3 class="text-center align-self-center lead text-danger">Users Not Found</h3>';
    }

}

//Handle Display Specific Users Details

if (isset($_POST['user_id'])) {
    $id = $_POST['user_id'];
    $userDetails= $admin->userDetailsById($id);
   echo json_encode($userDetails);
    
}

//Handle Delete an users 

if (isset($_POST['delete_user'])) {
   $delid= $_POST['delete_user'];
   $admin->deleteUser($delid,"0");
}

//Handle All deleted Users


if (isset($_POST['action']) && $_POST['action'] == 'deletedUsers') {
    
    $users = $admin->showAllusers(1);
    if ($users) {
       $output = ' <table class="table table-striped table-hover text-center">
       <thead>
          <tr>
          <th>#</th>
           <th>Image</th>
           <th>Name</th>
           <th>Email</th>
           <th>Phone</th>
           <th>Gender</th>
           <th>Verified</th>
           <th>Action</th>
          </tr>
       </thead><tbody>';
       foreach ($users as $row) {
           if ($row['photo'] !='') {
               $photo = '../assets/php/'.$row['photo'];
           }else{
            $photo = '../assets/img/dummy.png'; 
           }
           if ($row['verified'] == 0) {
             $veried=  '<span class="text-danger">Unverified</span>';
           }else{
            $veried= '<span class="text-success">Verified</span>';
           }
         $output .= '   <tr>
                <td>'.$row['id'].'</td>
                <td><img width="40px" height="40px" class="rounded-circle" src="'.$photo.'"></td>
                <td>'.$row['name'].'</td>
                <td>'.$row['email'].'</td>
                <td>'.$row['phone'].'</td>
                <td>'.$row['gender'].'</td>
                <td>'.$veried.'</td>
                <td>
                 <a href="#" id=' . $row['id'] . ' title="Restore Users" class="text-white btn btn-dark p2 restoreUser">Restore</a>
             
                </td>
                              </tr>';
       }
       $output .='</tbody></table>';
       echo $output;
    }else{
       echo '<h3 class="text-center align-self-center lead text-danger">Users Not Found</h3>';
    }

}

// Handle Restore Users

if (isset($_POST['restore_user'])) {
    $restorUserId= $_POST['restore_user'];
    $admin->deleteUser($restorUserId,1);
}

//Handle Fetch All Notes
if (isset($_POST['action']) && $_POST['action'] == 'showAllNotes') {
    
    $users = $admin->showAllNotes();
    if ($users) {
       $output = ' <table class="table table-striped table-hover text-center">
       <thead>
          <tr>
          <th>#</th>
       
           <th>Name</th>
           <th>Email</th>
           <th>Title</th>
           <th>Note</th>
           <th>Created</th>
           <th>Updated</th>
           <th>Action</th>
          </tr>
       </thead><tbody>';
       foreach ($users as $row) {
           if ($row['photo'] !='') {
               $photo = '../assets/php/'.$row['photo'];
           }else{
            $photo = '../assets/img/dummy.png'; 
           }
           if (strlen($row['note']) >30) {
              $note= substr($row['note'],0,30)."...";
           }else{
               $note= $row['note'];
           }
          
           if (strlen($row['title']) >20) {
              $title= substr($row['title'],0,20)."...";
           }else{
               $title= $row['title'];
           }
          
         $output .= '   <tr>
                <td>'.$row['id'].'</td>
               
                <td>'.$row['name'].'</td>
                <td>'.$row['email'].'</td>
                <td title="'.$row['title'].'"> '.$title.'</td>
                <td title="'.$row['note'].'">'.$note.'</td>
                <td>'.$row['cdate'].'</td>
                <td>'.$row['udate'].'</td>
                <td width="10%">
                <a href="#" id='. $row['id'] .' title="View" data-bs-toggle="modal" data-bs-target="#noteDetails"  class="text-success btn noteBtn"><i class="fas fa-info-circle fa-lg"></i></a>
                <a href="#" id=' . $row['id'] . ' title="Delete Note" class="text-danger btn noteDeleteBtn"><i class="fas fa-trash-alt fa-lg"></i></a>
             
                </td>
                              </tr>';
       }
       $output .='</tbody></table>';
       echo $output;
    }else{
       echo '<h3 class="text-center align-self-center lead text-danger">Users Not Found</h3>';
    }

}

// Handle Delete Note

if (isset($_POST['delete_note'])) {
   $noteId= $_POST['delete_note'];
   $admin->deleteNote($noteId);
}

//Handel Note Details



if (isset($_POST['view_notes'])) {
    $id = $_POST['view_notes'];
    // echo $id;
    $NoteDetails= $admin->noteDetailsById($id);
   echo json_encode($NoteDetails);
    
}

// Handle All Feedbacks

if(isset($_POST['action']) && $_POST['action'] == 'showAllFeedback'){
    $feedback = $admin->showAllFeedback();
    if ($feedback) {
       $output = ' <table class="table table-striped table-hover text-center">
       <thead>
          <tr>
          <th>#</th>
           <th>Name</th>
           <th>Email</th>
           <th>Subject</th>
           <th>Feedback</th>
           <th>Sent On</th>
           <th>Replied</th>
           <th>Action</th>
          </tr>
       </thead><tbody>';
       foreach ($feedback as $row) {
           if (strlen($row['feedback']) >30) {
              $feedback= substr($row['feedback'],0,30)."...";
           }else{
               $feedback= $row['feedback'];
           }
          
           if (strlen($row['subject']) >20) {
              $subject= substr($row['subject'],0,20)."...";
           }else{
               $subject= $row['subject'];
           }
          
         $output .= '   <tr>
                <td>'.$row['id'].'</td>
               
                <td>'.$row['name'].' (<span class="text-danger fw-bold">'.$row['uid'].')</span></td>
                <td>'.$row['email'].'</td>
                <td title="'.$subject.'"> '.$subject.'</td>
                <td title="'.$feedback.'">'.$feedback.'</td>
                <td>'.$row['cdate'].'</td>
                <td>'.$row['replied'].'</td>
                <td width="10%">
                <a href="#" fid='.$row['id'].' uid='. $row['uid'] .' title="Replay" data-bs-toggle="modal" data-bs-target="#feedbackModal"  class="text-success btn replyFeedbackBtn"><i class="fas fa-reply fa-lg"></i></a>
                <a href="#" id=' . $row['id'] . ' title="Delete Feedback" class="text-danger btn feedBackDeleteBtn"><i class="fas fa-trash-alt fa-lg"></i></a>
             
                </td>
                              </tr>';
       }
       $output .='</tbody></table>';
       echo $output;
    }else{
       echo '<h3 class="text-center align-self-center lead text-danger">No FeedbackFound</h3>';
    }
}

// Handle Feedback Delete
if (isset($_POST['delete_feed'])) {
    $feedbackdid= $_POST['delete_feed']; 
    $admin->deleteFeedback($feedbackdid);

}

//Handle Feedback Reply

if (isset($_POST["msg"])) {
    // print_r($_POST);
    $uid= $_POST["uid"];
    $fid= $_POST["fid"];
    $msg= $admin->cleanInputData($_POST["msg"]);
    $reply = $admin->replyFeedback($uid,$msg);
    if ($reply) {
        $admin->feedbackRiplied($fid);
    }else{
        $admin->errorMsg('danger','Something Worng..!');
    }
    
}

//Handle All Notifiaction

if(isset($_POST['action']) && $_POST['action'] == 'showAllNotification'){
    $notification = $admin->fetchNotification();
    $output='';
    if ($notification) {
        foreach ($notification as $row) {
            $output .= '<div class="alert alert-dark alert-dismissible fade show" role="alert">
            <button type="button" id="'.$row['id'].'" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            <h5 class="alert-heading">New Notification</h5>
            <p class="mb-0 lead">'.$row['msg'].'</p>
            <hr class="my-t">
            <p class="float-start mb-0"><b>User E-Mail: </b> '.$row['email'].'</p>
            <p class="float-end mb-0">'.$admin->timeToAgo($row['created_at']).'</p>
            <dif class="clearfix"></dif>
        </div>';
        }
        echo $output;
    }else{
        echo '<h3 class="text-center text-secondary mt-5">No any New Notification</h3>';
    }
}
////Handle check Nofitication

if (isset($_POST['action']) && $_POST['action']== 'checkNotification') {
    if ($admin->fetchNotification()) {
        echo '<i class="fas fa-circle fa-sm text-danger"></i>';
    }else{
        echo '';
    }
}

//Handle remove Notofication

if (isset($_POST['notificationId'])) {
    $notiId= $_POST['notificationId'];
   $d= $admin->removeNotification($notiId);
   if ($d) {
       echo "Yes";
   }else{
       echo "NO";
   }
}

//// Handle Export All Users
if (isset($_GET['export']) && $_GET['export'] == 'excel') {
   header("Content-Type: application/xls");
   header("Content-Disposition: attachment; filename=users.xls");
   header("Pragma: no-cache");
   header("Expires: 0");
   $data= $admin->exportAllUsers();
   echo '<table border="1" align="center">';
   echo '<tr>
                <th>#</th>
                <th>Name</th>
                <th>E-Mail</th>
                <th>Phone</th>
                <th>Gender</th>
                <th>DOB</th>
                <th>Join On</th>
                <th>Verified</th>
                <th>Deleted</th>
    
        </tr>';
        foreach ($data as $row ) {
            if ($row['verified'] == 0) {
               $verified= "<span style='color:red;'>Not Verified (".$row['verified'].")</span>";
            }else{
                $verified= "<span style='color:green;'>Verified (".$row['verified'].")</span>";
            }
            if ($row['deleted'] == 0) {
               $deleted= "<span style='color:red;'>User Deleted (".$row['deleted'].")</span>";
            }else{
                $deleted= "<span style='color:green;'>Not Deleted (".$row['deleted'].")</span>";
            }
            echo '<tr>
                    <td>'.$row['id'].'</td>
                    <td>'.$row['name'].'</td>
                    <td>'.$row['email'].'</td>
                    <td>'.$row['phone'].'</td>
                    <td>'.$row['gender'].'</td>
                    <td>'.$row['dob'].'</td>
                    <td>'.$row['crated_at'].'</td>
                    <td>'.$verified.'</td>
                    <td>'.$deleted.'</td>
            
            </tr>';
        }
   echo'</table>';
}