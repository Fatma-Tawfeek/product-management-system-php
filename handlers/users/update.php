<?php 

session_start();

require_once '../../core/functions.php';
require_once '../../core/Validation.php';
require_once '../../database/connection.php';

$errors = [];

if(checkRequestMethod("POST")) {
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

    // Email validations
    if(!Validation::requiredVal($email)) {
        $errors[] = "email is required";
    } elseif(!Validation::emailVal($email)) {
        $errors[] = "please type a valid email";
    }

    if(empty($errors)) {

            $name = $_POST["name"];
            $email = $_POST["email"];
            $phone = $_POST["phone"];
            $password = sha1($_POST["password"]);
            $role = $_POST["role"];

            $sql = "UPDATE `users` SET 
            `name`='$name',
            `email`='$email',
            `phone`='$phone',
            `role` = '$role',
            `password`='$password'
            WHERE `id`= '$id'";
            $result = mysqli_query($conn, $sql);
            if($result) {
                $_SESSION['success'] = "Data is updated successfully";
            }
            // redirection
            redirect("../../views/users.php");
           } else {
            $_SESSION['errors'] = $errors;
            redirect("../../views/users.php");
            die();
        }
}