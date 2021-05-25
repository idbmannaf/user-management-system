<?php 
class Format{
    public function cleanData($data){
        $data= trim($data);
        $data= stripslashes($data);
        $data = stripcslashes($data);
        $data = strip_tags($data);
        return $data;
    }
    public function shortText($data, $lenght= 400){
        $data = substr($data,0,$lenght);
    }
}

?>