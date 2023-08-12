<?php 

session_start();

require_once '../../core/functions.php';
require_once '../../core/Validation.php';

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
    } elseif(!Validation::uniqueEmail($email)){
        $errors[] = "This Email already exists";
    }


    // Password validations
    if(!Validation::requiredVal($password)) {
        $errors[] = "password is required";
    } elseif(!Validation::minVal($password,6)) {
        $errors[] = "password must be more than 6 chars";
    } elseif(!Validation::maxVal($password, 20)) {
        $errors[] = "password must be less than 20 chars";
    }

    if(empty($errors)) {

            $name = $_POST["name"];
            $email = $_POST["email"];
            $phone = $_POST["phone"];
            $password = password_hash($_POST["password"], PASSWORD_DEFAULT);
                        
            require '../../database/connection.php';

            $sql = "INSERT INTO `users`(`name`, `email`, `phone`, `password`) VALUES('$name', '$email', '$phone', '$password')";
            $result = mysqli_query($conn, $sql);
            if(mysqli_affected_rows($conn) == 1) {
                $query = "SELECT * FROM `users` where `email` = '$email' AND `password` = '$password'";
                $auth_user = mysqli_query($conn, $query);
                $row = mysqli_fetch_assoc($auth_user); 
                $_SESSION['auth'] = [$row['id'], $row['name'], $row['role']];
                 // redirect
                redirect("../../views/products.php");
                die();

            } else {
                $_SESSION['errors'] = $errors;
                redirect("../../views/register.php");
                die();
            }

    } else {
        $_SESSION['errors'] = $errors;
        redirect("../../views/register.php");
        die();
    }

}