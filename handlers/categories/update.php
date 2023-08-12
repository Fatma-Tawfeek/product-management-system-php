<?php

session_start();

require_once '../../database/connection.php';
require_once '../../core/functions.php';
require_once '../../core/Validation.php';

if(checkRequestMethod("POST") && isset($_POST["name"])) {

    foreach($_POST as $key => $value) {
        $$key = sanitizeInput($value);
    }

     // Name validations
     if(!Validation::requiredVal($name)) {
        $errors[] = "name is required";
    } elseif(!Validation::minVal($name, 3)) {
        $errors[] = "name must be more than 3 chars";
    } elseif(!Validation::maxVal($name, 25)) {
        $errors[] = "name must be less than 25 chars";
    }

    if(empty($errors)) {

       $name = $_POST['name'];
        $sql = "UPDATE `categories` SET 
        `cat_name`='$name'
        WHERE `cat_id`= '$id'";
        $result = mysqli_query($conn, $sql);
        if($result) {
            $_SESSION['success'] = "Data is updated successfully";
        }
        // redirection
        redirect("../../views/categories.php");
    }else {
        $_SESSION['errors'] = $errors;
        redirect("../../views/categories.php");
        die();
    }
}