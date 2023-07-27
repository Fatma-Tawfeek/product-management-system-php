<?php 

function requiredVal($input) {
    if(empty($input)) {
        return false;
    }
    return true;
}

function minVal($input, $length) {
    if(strlen($input) < $length) {
        return false;
    }
    return true;
}

function maxVal($input, $length) {
    if(strlen($input) > $length) {
        return false;
    }
    return true;
}

function emailVal($email) {
    if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        return false;
    }
    return true;
}

function uniqueEmail($email) {
    include '../../database/connection.php';
    $sql = "SELECT * FROM `users` where `email` = '$email' ";
    $result = mysqli_query($conn, $sql);
    $num_rows = mysqli_num_rows($result);
    if($num_rows > 0){
        return false;       
    }
    return true;
}
 
function checkLogin($email, $password) {
   include '../../database/connection.php';
   $sql = "SELECT * FROM `users` where `email` = '$email' AND `password` = '$password'";
   $result = mysqli_query($conn, $sql);   
   $count = mysqli_num_rows($result);  
    
   if($count == 1){  
      $row = mysqli_fetch_assoc($result); 
      $_SESSION['auth'] = [$row['id'], $row['name'], $row['role']];
      return true;  
   }  
   else{  
       return false;  
   }     
}