<?php

require_once 'config.php';
class Auth extends Database{
    // Register New User
    public function register($name,$email, $password){
        $sql= "INSERT INTO users (name, email, password) VALUES(:name,:email,:pass)";
        $statement= $this->conn->prepare($sql); // prepear kora holo ekhono value dhukeni
        $statement->execute(['name'=>$name, 'email'=>$email, 'pass'=>$password]); // value bind kora holo
        return true;
    }
    //check if User alreaedy registered
    public function user_exist($email){
        $sql= "SELECT email FROM users WHERE email=:email";
        $stmt= $this->conn->prepare($sql); //bind kora holo
        $stmt->execute(['email'=>$email]); // data sql e probes korra holo and dhukano holo
        $result = $stmt->fetch(PDO::FETCH_ASSOC); // eivabe fetch assoc korte hoy
        return $result;
    }
    public function login($email){
        $sql= "SELECT email, password FROM users WHERE email=:email AND deleted !=0";
        $stmt= $this->conn->prepare($sql);
        $stmt->execute(['email'=>$email]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result;
    }
    //Check current user in session
    public function currentUser($email){
        $sql= "SELECT * FROM users WHERE email=:email AND deleted !=0";
        $stmt=$this->conn->prepare($sql);
        $stmt->execute(['email'=>$email]);
        $row= $stmt->fetch(PDO::FETCH_ASSOC);
        // $row= $stmt->fetch(PDO::FETCH_ASSOC);
        return $row;
    }
    //forgot password

    public function forgotPassword($token,$email){
        $sql= "UPDATE users SET token=:token, token_expire= DATE_ADD(now(),interval 10 MINUTE ) WHERE email = :email"; //ekhane interval babohar kora hoyeche (email je confirmation link jabe tar expeire time)
        $stmt= $this->conn->prepare($sql);
        $stmt->execute(['token'=>$token, 'email'=>$email]);
        return true;
    }
    //add new Note
    public function addNewNote($uid,$title,$note){
    $sql= "INSERT INTO notes (uid,title,note) VALUES(:uid,:title,:note)";
    $stmt= $this->conn->prepare($sql);
    $stmt->execute(['uid'=>$uid, 'title'=>$title, 'note'=>$note]);
    return true;
    }
    //fetch ALl Note of an User

    public function getNotes($uid){
        $sql= "SELECT * FROM notes WHERE uid=:uid";
        $stmt= $this->conn->prepare($sql);
        $stmt->execute(['uid'=>$uid]);
        $result= $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;

    }

    //Edit Note of an User
    public function editNote($id){
        $sql= "SELECT * FROM notes WHERE id=:id";
        $stmt= $this->conn->prepare($sql);
        $stmt->execute(['id'=>$id]);
        $result= $stmt->fetch(PDO::FETCH_ASSOC);
        return $result;
    }
   
    //Update Note of an User

    public function updateNote($id,$title,$note){
        $sql= "UPDATE notes SET title=:title, note=:note, updated_at=NOW() WHERE id=:id";
        $stmt= $this->conn->prepare($sql);
        $stmt->execute(['title'=>$title, 'note'=>$note,'id'=>$id]);
        return true;

    }
    //Delete Note of an User
    public function deleteNote($deletId){
        $sql= "DELETE FROM notes WHERE id=:deleteId";
        $stmt= $this->conn->prepare($sql);
        $stmt->execute(['deleteId'=>$deletId]);
        return true;
    }

    //Update Profile of an User

    public function updateProfile($name,$gender,$dob,$phone,$photo,$id){
        $sql= "UPDATE users SET name=:name, gender=:gender, dob=:dob, phone=:phone, photo=:photo WHERE id=:id AND deleted !=0";
        $stmt= $this->conn->prepare($sql);
        $stmt->execute(['name'=>$name, 'gender'=>$gender, 'dob'=>$dob, 'phone'=>$phone, 'photo'=>$photo,'id'=>$id]);
        return true;

    }
    //Change password Of an Users

    public function changePassword($pass, $id){
        $sql= "UPDATE users SET password=:pass WHERE id =:id AND DELETED !=0";
        $stmt= $this->conn->prepare($sql);
        $stmt->execute(['pass'=>$pass, 'id'=>$id]);
        return true;
    }
    //Email verify 

    public function emailVerify($email){
        $sql= 'UPDATE users SET verified=1 WHERE email=:email AND deleted !=0';
        $stmt= $this->conn->prepare($sql);
        $stmt->execute(['email'=>$email]);
        return true;
    }
    // Feedback to Admin

    public function feedback($subject, $feedback, $uid){
        $sql= "INSERT INTO feedback (uid,subject,feedback) VALUES(:uid, :subject, :feedback)";
        $stmt= $this->conn->prepare($sql);
        $stmt->execute(['uid'=>$uid, 'subject'=>$subject, 'feedback'=>$feedback]);
        return true;
    }
    // Insert Notifiactin 
    public function notification($uid,$type,$msg){
        $sql = "INSERT INTO notification (uid,type,msg) VALUES (:uid,:type,:msg)";
        $stmt= $this->conn->prepare($sql);
        $stmt->execute(['uid'=>$uid, 'type'=>$type, 'msg'=>$msg]);
        return true;
    }

    //Fetch Notification
    public function fetchNotification($uid){
    $sql= "SELECT * FROM notification WHERE uid=:uid AND type='user'";
    $stmt= $this->conn->prepare($sql);
    $stmt->execute(['uid'=>$uid]);
    $result= $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $result;
    }

    //Remove Notification
    public function removeNotification($id){
        $sql= "DELETE FROM notification WHERE id=:id AND type='user'";
        $stmt= $this->conn->prepare($sql);
        $stmt->execute(['id'=>$id]);
        return true;
    }
}

?>