<?php 
require_once 'config.php';
class Admin extends Database{
    // Admin Login

    public function admin_login($user, $pass){
        $sql= "SELECT username,password FROM admin WHERE username=:user AND password=:pass";
        $stmt= $this->conn->prepare($sql);
        $stmt->execute(['user'=>$user, 'pass'=>$pass]);
       $row= $stmt->fetch(PDO::FETCH_ASSOC);
       return $row;
    }
    //Count Total No . of Rows
    public function totalCount($tablename){
        $sql= "SELECT * FROM $tablename";
        $stmt= $this->conn->prepare($sql);
        $stmt->execute();
        $count= $stmt->rowCount();
        return $count;
    }
    //Count Total Verifyed/ Unverified Users
    public function verifyUnverifyUsers($status){
        $sql= "SELECT * FROM  users WHERE verified=:status";
        $stmt= $this->conn->prepare($sql);
        $stmt->execute(['status'=>$status]);
        $count= $stmt->rowCount();
        return $count;
    }
 
    //Gender Persentage

    public function genderPer(){
        $sql = "SELECT gender, COUNT(*) AS number FROM users WHERE gender !='' GROUP BY gender";
        $stmt= $this->conn->prepare($sql);
        $stmt->execute();
        $result= $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    // User's Verified/Univerified Percentage
    public function verfiedPer(){
        $sql = "SELECT verified, COUNT(*) AS number FROM users GROUP BY verified";
        $stmt= $this->conn->prepare($sql);
        $stmt->execute();
        $result= $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;

    }
    //Total Hits/Visitor count
    public function visitors(){
        $sql= "SELECT hits FROM visitors";
        $stmt= $this->conn->prepare($sql);
        $stmt->execute();
        $result= $stmt->fetch(PDO::FETCH_ASSOC);
        return $result;

    }
    //Fetch All registred Users

    public function showAllusers($val){
        $sql= "SELECT * FROM users WHERE deleted !=$val";
        $stmt= $this->conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
    //Fetch Users details by id

    public function userDetailsById($id){
        $sql= "SELECT * FROM users WHERE id= :id AND deleted !=0";
        $stmt= $this->conn->prepare($sql);
        $stmt->execute(['id'=>$id]);
        $row= $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $row;

    }
    //Delete An Users / Not Permanently

    public function deleteUser($id,$val){
        $sql= "UPDATE users SET deleted= $val WHERE id=:id";
        $stmt= $this->conn->prepare($sql);
        $stmt->execute(['id'=>$id]);
        return true;
    }
    //Fetch All Notes
    public function showAllNotes(){
        $sql= "SELECT notes.*, users.name, users.email, users.photo, date(notes.created_at) as cdate, date(notes.updated_at) as udate FROM notes INNER JOIN users on notes.uid = users.id";
        $stmt= $this->conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
    //Delete Note

    public function deleteNote($deletId){
        $sql= "DELETE FROM notes WHERE id=:deleteId";
        $stmt= $this->conn->prepare($sql);
        $stmt->execute(['deleteId'=>$deletId]);
        return true;
    }
    // Note Details

    public function noteDetailsById($id){
        $sql= "SELECT notes.*, users.name, users.email, users.photo, date(notes.created_at) as cdate, date(notes.updated_at) as udate FROM notes INNER JOIN users on notes.uid = users.id WHERE notes.id=:id";
        $stmt= $this->conn->prepare($sql);
        $stmt->execute(['id'=>$id]);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
    //Show All Notes
    public function showAllFeedback(){
        $sql= "SELECT feedback.*, users.name, users.email,date(feedback.created_at) as cdate FROM feedback INNER JOIN users on feedback.uid = users.id WHERE replied !=1 ORDER BY feedback.id DESC";
        $stmt= $this->conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
    //Delete Feedback 
    public function deleteFeedback($feedbackdid){
        $sql= "DELETE FROM feedback WHERE id=:id";
        $stmt= $this->conn->prepare($sql);
        $stmt->execute(['id'=>$feedbackdid]);
        return true;
    }
    //Sent Feedback Reply to user
    public function replyFeedback($uid,$msg){
        $sql= "INSERT INTO notification (uid,type,msg) VALUES(:uid,'user',:msg)";
        $stmt= $this->conn->prepare($sql);
        $stmt->execute(['uid'=>$uid,'msg'=>$msg]);
        return true;

    }
    //Set feedback riplied 1 
    public function feedbackRiplied($fid){
        $sql= "UPDATE feedback SET replied =1 WHERE id=:fid";
        $stmt= $this->conn->prepare($sql);
        $stmt->execute(['fid'=>$fid]);
        return true;
    }
    //Fetch Notification

    public function fetchNotification(){
        $sql= "SELECT notification.*, users.name, users.email,date(notification.created_at) as cdate FROM notification INNER JOIN users on notification.uid = users.id WHERE type ='admin' ORDER BY notification.id DESC LIMIT 5";
        $stmt= $this->conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;

    }
    //Remove Notification
    public function removeNotification($id){
        $sql= "DELETE FROM notification WHERE id=:id AND type='admin'";
        $stmt= $this->conn->prepare($sql);
        $stmt->execute(['id'=>$id]);
        return true;
    }
    //Fetch All Users from Database and Export
    public function exportAllUsers(){
        $sql= "SELECT * FROM users";
        $stmt= $this->conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

}

?>