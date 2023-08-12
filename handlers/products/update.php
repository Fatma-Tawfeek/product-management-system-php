<?php

session_start();

require_once '../../database/connection.php';
require_once '../../core/functions.php';
require_once '../../core/Validation.php';

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

    // brand validations
    if(!Validation::requiredVal($brand)) {
        $errors[] = "brand is required";
    } elseif(!Validation::minVal($brand, 2)) {
        $errors[] = "brand must be more than 3 chars";
    } elseif(!Validation::maxVal($brand, 25)) {
        $errors[] = "brand must be less than 25 chars";
    }

    // quantity validations
    if(!Validation::requiredVal($quantity)) {
        $errors[] = "quantity is required";
    } 

    // price validations
    if(!Validation::requiredVal($price)) {
        $errors[] = "price is required";
    }

    // price validations
    if(!Validation::requiredVal($cat_id)) {
        $errors[] = "category is required";
    }

    if(empty($errors)) {

        $name = $_POST['name'];
        $brand = $_POST['brand'];
        $quantity = $_POST['quantity'];
        $price = $_POST['price'];
        $cat_id = $_POST['cat_id'];
        $id = $_GET['id'];

        $sql = "UPDATE `products` SET 
        `name`='$name',
        `price`='$price',
        `category_id`='$cat_id',
        `brand`='$brand',
        `quantity`='$quantity'
        WHERE `id`= '$id'";
        $result = mysqli_query($conn, $sql);
        if($result) {
            $_SESSION['success'] = "Data is updated successfully";
        }

         // redirection
         redirect("../../views/products.php");
         die();
     } else {
         $_SESSION['errors'] = $errors;
         redirect("../../views/products.php");
         die();
     }
}