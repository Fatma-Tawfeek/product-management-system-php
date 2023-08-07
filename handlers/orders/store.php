<?php 

session_start();

include '../../database/connection.php';
include '../../core/functions.php';
include '../../core/validations.php';

if(checkRequestMethod("POST") && isset($_POST["address"])) {

    foreach($_POST as $key => $value) {
        $$key = $value;
    }

     // address validations
     if(!requiredVal($address)) {
        $errors[] = "address is required";
    } 

    // payment_method validations
    if(!requiredVal($payment_method)) {
        $errors[] = "payment_method is required";
    } 

    if(empty($errors)) {

        $address = $_POST['address'];
        $payment_method = $_POST['payment_method'];
        $user_id = $_POST['user_id'];
        $products = unserialize($_POST['products']);

        $sql = "INSERT INTO `orders`(`address`, `payment_method`, `user_id`) VALUES('$address', '$payment_method', '$user_id')";
        mysqli_query($conn, $sql);

        $sql = "SELECT `id` FROM `orders` WHERE `user_id` = '$user_id' AND `status` = '0'";
        $result = mysqli_query($conn, $sql);

        $record = mysqli_fetch_assoc($result);
        $order_id = $record['id'];

        foreach($products as $product) {

            $product_id = $product[0];
            $price = $product[2];
            $quantity = $product[3];
            $total = $product[4];

            $sql = "INSERT INTO `product_order`(`order_id`, `product_id`, `price`, `quantity`, `total`) VALUES('$order_id', '$product_id', '$price', '$quantity', '$total')";
            mysqli_query($conn, $sql);
        }

        $user_id = $_SESSION['auth'][0];
        $sql = "UPDATE `carts` SET `status` = '1' WHERE `user_id` = $user_id";
        mysqli_query($conn, $sql);

        if(mysqli_affected_rows($conn)) {
            $_SESSION['success'] = "Data is inserted successfully";
        }
        // redirection
        redirect("../../views/orders.php");
        die();
    } else {
        $_SESSION['errors'] = $errors;
        redirect("../../views/cart.php");
        die();
    }
}