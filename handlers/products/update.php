<?php

session_start();

include '../../database/connection.php';
include '../../core/functions.php';
include '../../core/validations.php';

if(checkRequestMethod("POST") && isset($_POST["name"])) {

    foreach($_POST as $key => $value) {
        $$key = sanitizeInput($value);
    }

     // Name validations
     if(!requiredVal($name)) {
        $errors[] = "name is required";
    } elseif(!minVal($name, 3)) {
        $errors[] = "name must be more than 3 chars";
    } elseif(!maxVal($name, 25)) {
        $errors[] = "name must be less than 25 chars";
    }

    // brand validations
    if(!requiredVal($brand)) {
        $errors[] = "brand is required";
    } elseif(!minVal($brand, 2)) {
        $errors[] = "brand must be more than 3 chars";
    } elseif(!maxVal($brand, 25)) {
        $errors[] = "brand must be less than 25 chars";
    }

    // quantity validations
    if(!requiredVal($quantity)) {
        $errors[] = "quantity is required";
    } 

    // price validations
    if(!requiredVal($price)) {
        $errors[] = "price is required";
    }

    // price validations
    if(!requiredVal($cat_id)) {
        $errors[] = "category is required";
    }

    if(empty($errors)) {

        $name = $_POST['name'];
        $brand = $_POST['brand'];
        $quantity = $_POST['quantity'];
        $price = $_POST['price'];
        $cat_id = $_POST['cat_id'];

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