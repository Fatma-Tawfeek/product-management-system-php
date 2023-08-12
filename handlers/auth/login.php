<?php 

session_start();

require_once '../../core/functions.php';
require_once '../../core/Validation.php';

$errors = [];

if(checkRequestMethod("POST")) {
    foreach($_POST as $key => $value) {
        $$key = sanitizeInput($value);
    }

    // Email validations
    if(!Validation::requiredVal($email)) {
        $errors[] = "email is required";
    } elseif(!Validation::emailVal($email)) {
        $errors[] = "please type a valid email";
    } 

    // Password validations
    if(!Validation::requiredVal($password)) {
        $errors[] = "password is required";
    }

    // Login validations
    if(!Validation::checkLogin($email, $password)) {
        $errors[] = "Email or Password is incorrect";
    }

    if(empty($errors)) {

        // redirect
        redirect("../../views/products.php");
        die();

    } else {
        
        $_SESSION['errors'] = $errors;
        redirect("../../views/login.php");
        die();
    }

} 