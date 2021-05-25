<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require 'vendor/autoload.php';

//Instantiation and passing `true` enables exceptions
$mail = new PHPMailer(true);

require_once 'session.php';

//handle add note ajax request
if (isset($_POST['action']) && $_POST['action'] == "add_note") {
    $title = $cauth->cleanInputData($_POST['title']);
    $note = $cauth->cleanInputData($_POST['note']);
    $noteAdded = $cauth->addNewNote($cid, $title, $note);

    //for Notification
    $cauth->notification($cid, 'admin', 'Note Added');
}
//handle Display all Notes of an User via Ajax request
if (isset($_POST['action']) && $_POST['action'] == "displayNote") {
    $output = '';
    $notes = $cauth->getNotes($cid); //$cid er value Session.php theke eseche
    if ($notes) {
        $output .= '<table class="table table-stripted ">
    <thead>
        <tr>
            <th>#</th>
            <th>Titile</th>
            <th>Note</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>';
        foreach ($notes as $row) {
            $output .= ' <tr>
       <td>' . $row['id'] . '</td>
      
    ';
            if (strlen($row['title']) > 30) {
                $output .= '<td>' . substr($row['title'], 0, 30) . '....</td>';
            } else {
                $output .= '<td>' . $row['title'] . '</td>';
            }

            if (strlen($row['note']) > 75) {
                $output .= '<td>' . substr($row['note'], 0, 70) . '....</td>';
            } else {
                $output .= '<td>' . $row['note'] . '</td>';
            }
            $output .= ' <td>
          <a href="#" id=' . $row['id'] . ' title="View" class="text-success btn veiwBtn"><i class="fas fa-info-circle fa-lg"></i></a>
          <a href="#" id=' . $row['id'] . ' title="Delete" class="text-primary btn editBtn" data-bs-toggle="modal" data-bs-target="#editNoteModal"><i class="fas fa-edit fa-lg"></i></a>
          <a href="#" id=' . $row['id'] . ' title="Edit" class="text-danger btn deleteBtn"><i class="fas fa-trash-alt fa-lg"></i></a>
       </td>
    </tr>';
        }
        $output .= ' </tbody></table>';
        echo $output;
    } else {
        echo '<h3 class="text-center text-secondary">:( You have not Written any note Yet! Write your first note now!</h3>';
    }
}

//handle edit Note of an User ajax requers


if (isset($_POST['id']) && $_POST['id'] != NULL) {
    $id = $_POST['id'];
    $editRow = $cauth->editNote($id);
    echo  json_encode($editRow);
}
//Handel edit / update note of an User via ajax request

if (isset($_POST['action']) && $_POST['action'] == 'update') {
    $id = $cauth->cleanInputData($_POST['id']);
    $title = $cauth->cleanInputData($_POST['title']);
    $note = $cauth->cleanInputData($_POST['note']);
    $cauth->updateNote($id, $title, $note);

    //for Notification
    $cauth->notification($cid, 'admin', 'Note Updated');
}

//Handel Delete note of an User via ajax request
if (isset($_POST['del_id']) && $_POST['del_id'] != Null) {
    $delteId = $cauth->cleanInputData($_POST['del_id']);
    $cauth->deleteNote($delteId);
    //for Notification
    $cauth->notification($cid, 'admin', 'Note Deleted');
}

//display a note details
if (isset($_POST['viewId']) && $_POST['viewId'] != Null) {
    $viewId = $cauth->cleanInputData($_POST['viewId']);
    $row = $cauth->editNote($viewId);
    echo json_encode($row);
}

//Handle Profile Update Ajax Requerst

if (isset($_FILES["image"])) {
    $name = $cauth->cleanInputData($_POST['name']);
    $gender = $cauth->cleanInputData($_POST['gender']);
    $phone = $cauth->cleanInputData($_POST['phone']);
    $dob = $cauth->cleanInputData($_POST['dob']);
    $oldImage = $_POST['oldImage'];
    // echo $_FILES['image']['name'];

    $folder = 'uploads/';
    if (isset($_FILES['image']['name']) && $_FILES['image']['name'] != '') {
        $newImage = $folder . $_FILES['image']['name'];
        move_uploaded_file($_FILES['image']['tmp_name'], $newImage);
        if ($oldImage != null) {
            unlink($oldImage);
        }
    } else {
        $newImage = $oldImage;
    }
    // echo $newImage;
    $cauth->updateProfile($name, $gender, $dob, $phone, $newImage, $cid);
    echo $newImage;
    //for Notification
    $cauth->notification($cid, 'admin', 'Profile Updated');
}



//  Handle Password Change
if (isset($_POST['action']) && $_POST['action'] == 'change_pass') {
    $currentPass = $cauth->cleanInputData($_POST['currentPass']);
    $newPass = $cauth->cleanInputData($_POST['newPass']);
    $conPass = $cauth->cleanInputData($_POST['conPass']);
    $newHash = password_hash($newPass, PASSWORD_DEFAULT);

    if ($newPass != $conPass) {
        echo $cauth->errorMsg('danger', 'Password Did not mateched!');
    } else {

        if (password_verify($currentPass, $cpassword)) {
            $cauth->changePassword($newHash, $cid);
            echo $cauth->errorMsg('success', 'Password Changed Successfully!');
            //for Notification
            $cauth->notification($cid, 'admin', 'Password Changed');
        } else {
            echo $cauth->errorMsg('danger', 'Current password is Wrong!');
        }
    }
}

//Handle verify E-mail ajax request


if (isset($_POST['action']) && $_POST['action'] == 'verify_email') {
    try {
        $mail->isSMTP(); // ei method e emai send hobe
        $mail->Host = 'smtp.gmail.com'; // Gmail er server er name
        $mail->SMTPAuth = true;
        $mail->Username = Database::USERNAME;
        $mail->Password = Database::PASSWORD;
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         //Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
        $mail->Port  = 587;

        //Recipients
        $mail->setFrom(Database::USERNAME);
        $mail->addAddress($cemail); // kon email e pathabo
        $mail->setFrom('idbmannaf@gmail.com', 'User Management System');

        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = 'E-mail Verification';
        $mail->Body    = '<h3>Click the below linik to Verify your Email <br> <a href="http://localhost/All_Project/user-management/verify-email.php?email=' . $cemail . '">http://localhost/All_Project/user-management/verify-email.php?email=' . $cemail . '</a> <br> Regards <br> Abdul Mannaf! </h3>';
        $mail->send();

        echo $cauth->errorMsg('success', 'Verification Sent to your email  email id please check your email');
    } catch (Exception $e) {
        echo $cauth->errorMsg('danger', 'Something Went Wrong Please try again!');
    }
}

////Handle FeedBack to admin ajax request
if (isset($_POST['action']) && $_POST['action'] == 'feedback') {
    $subject = $cauth->cleanInputData($_POST['subject']);
    $feedback = $cauth->cleanInputData($_POST['feedback']);
    $cauth->feedback($subject, $feedback, $cid);
    //for Notification
    $cauth->notification($cid, 'admin', 'Feedback Writen');
}

// Fetch Nofification Controls 

if (isset($_POST['action']) && $_POST['action'] == 'notifiaction') {

    $notificatin = $cauth->fetchNotification($cid);
    $output = '';
    if ($notificatin) {
        foreach ($notificatin as $row) {
            $output .= '<div class="alert alert-danger alert-dismissible fade show" role="alert">
           <button type="button" id="' . $row['id'] . '" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
           <h5 class="alert-heading">New Notification</h5>
           <p class="mb-0 lead">' . $row['msg'] . '</p>
           <hr class="my-t">
           <p class="float-start mb-0"> Reply of feedback From Admin!</p>
           <p class="float-end mb-0">' . $cauth->timeToAgo($row['created_at']) . '</p>
           <dif class="clearfix"></dif>
       </div>';
        }
        echo $output;
    } else {
        echo '<h3 class="text-center text-secondary mt-5">No any New Notification</h3>';
    }
}
//check Nofitication

if (isset($_POST['action']) && $_POST['action'] == 'checknotifiaction') {
    if ($cauth->fetchNotification($cid)) {
        echo '<i class="fas fa-circle fa-sm text-danger"></i>';
    } else {
        echo '';
    }
}


// Handel Remove Notification Ajax request
if (isset($_POST['notificationId']) && $_POST['notificationId'] != null) {
    $id = $_POST['notificationId'];
    $cauth->removeNotification($id);
}
