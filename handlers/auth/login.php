<?php 

session_start();

include '../../core/functions.php';
include '../../core/validations.php';

$errors = [];

if(checkRequestMethod("POST") && checkPostInput('email')) {
    foreach($_POST as $key => $value) {
        $$key = sanitizeInput($value);
    }

    // Email validations
    if(!requiredVal($email)) {
        $errors[] = "email is required";
    } elseif(!emailVal($email)) {
        $errors[] = "please type a valid email";
    } 

    // Password validations
    if(!requiredVal($password)) {
        $errors[] = "password is required";
    }

    // Login validations
    if(!checkLogin($email, $password)) {
        $errors[] = "Email or Password is incorrect";
    }

    if(empty($errors)) {
        // redirect
      //  $_SESSION['auth'] = [checkLogin($email, $password)];
        redirect("../../views/products.php");
        die();
    } else {
        $_SESSION['errors'] = $errors;
        redirect("../../views/login.php");
        die();
    }

} else {
    $_SESSION['errors'] = $errors;
    redirect("../../views/login.php");
    die();
}