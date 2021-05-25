<?php

class Database
{
    const USERNAME = 'abdemannafbd@gmail.com';
    const PASSWORD = 'mannaf01744';
    private $dsn =  "mysql:host=localhost;dbname=usermanagment"; //(DSN)Date Source Network
    private $user = "root";
    private $pass = "";

    public $conn;

    private $error;
    function __construct()
    {
        try {
            $this->conn = new PDO($this->dsn, $this->user, $this->pass); // for connection use new PDO(DSN/ host &databae name, User,Password0)
        } catch (PDOException $e) {
            echo 'error' . $e->getMessage();
        }
        return $this->conn;
    }
    public function errorMsg($type, $message)
    {
        // return '<div class="alert alert-'.$type.' alert-dismissible">
        // <button type="button" class="close" data-dismiss="alert">&times;</button>
        // <strong class="text-center">'.$message.'</strong></div>';
        return '<div class="alert alert-' . $type . ' alert-dismissible fade show">
            <strong>' . $message . '</strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>';
    }

    //text format checking
    public function cleanInputData($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = stripcslashes($data);
        $data = strip_tags($data);
        return $data;
    }
    public function shortText($data, $lenght = 400)
    {
        $data = substr($data, 0, $lenght);
    }
    //Time to age

    public function timeToAgo($timestamp)
    {
        date_default_timezone_set('Asia/Dhaka');  //Time Zone
        $timestamp = strtotime($timestamp) ?  strtotime($timestamp) : $timestamp;
        $time = time() - $timestamp;
        switch ($time) {

                //Seccond
            case $time <= 60:
                return "Just Not";
                //Minutes
            case $time >= 60 && $time < 6300:
                return (round($time / 60) == 1) ? 'a minute ago' : round($time / 60) . 'minute ago';
                // Hours
            case $time >= 3600 && $time < 86400:
                return (round($time / 3600) == 1) ? 'a hour ago' : round($time / 3600) . 'hours ago';

                //days
            case $time >= 86400 && $time < 604800:
                return (round($time / 86400) == 1) ? 'a day ago' : round($time / 86400) . 'day ago';
                //Week
            case $time >= 604800 && $time < 2600640:
                return (round($time / 604800) == 1) ? 'a week ago' : round($time / 604800) . 'week ago';
                //Month
            case $time >= 2600640 && $time < 31207680:
                return (round($time / 2600640) == 1) ? 'a month ago' : round($time / 2600640) . 'Month ago';
                //years
            case $time >= 31207680:
                return (round($time / 31207680) == 1) ? 'a year ago' : round($time / 2600640) . 'year ago';
                
        }
    }
  
    
}

?>