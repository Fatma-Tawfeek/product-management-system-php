<?php 

class Validation {

    public static function requiredVal($input) {
        if(empty($input)) {
            return false;
        }
        return true;
    }

    public static function minVal($input, $length) {
        if(strlen($input) < $length) {
            return false;
        }
        return true;
    }

    public static function maxVal($input, $length) {
        if(strlen($input) > $length) {
            return false;
        }
        return true;
    }

    public static function emailVal($email) {
        if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return false;
        }
        return true;
    }

    public static function uniqueEmail($email) {
        include '../../database/connection.php';
        $sql = "SELECT * FROM `users` where `email` = '$email' ";
        $result = mysqli_query($conn, $sql);
        $num_rows = mysqli_num_rows($result);
        if($num_rows > 0){
            return false;       
        }
        return true;
    }
    
    public static function checkLogin($email, $password) {

        include '../../database/connection.php';
        $sql = "SELECT * FROM `users` where `email` = '$email'";
        $result = mysqli_query($conn, $sql);   

        $row = mysqli_fetch_assoc($result);

        $count = mysqli_num_rows($result);  
            
        if($count == 1){  

            if(password_verify($password, $row['password'])){ 
            $_SESSION['auth'] = [$row['id'], $row['name'], $row['role']];
            return true;  
        }  
        else{  
            return false;  
        }  
        
        
        } else{  
            return false;  
        }  

    }

}