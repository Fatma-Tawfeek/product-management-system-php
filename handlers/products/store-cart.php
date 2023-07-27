<?php 

session_start();

include '../../database/connection.php';
include '../../core/functions.php';
include '../../core/validations.php';

   $user_id = $_GET['user_id'];
   $product_id = $_GET['product_id'];
   $price = $_GET['price'];


   $sql = "SELECT * FROM `carts` WHERE `user_id` = '$user_id' AND `status` = '0'";
   $result = mysqli_query($conn, $sql);
   
   if(mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $cart_id = $row['id'];
    $sql = "INSERT INTO `product_cart`(`cart_id`, `product_id`, `cart_price`, `total`) VALUES('$cart_id', '$product_id', '$price', '$price')";
    mysqli_query($conn, $sql);

    if(mysqli_affected_rows($conn) == 1) {
        $_SESSION['success'] = "Product added to the cart successfully";
    }

    // redirection
    redirect("../../views/products.php");

  } else {

    $sql = "INSERT INTO `carts`(`user_id`, `total`, `status`) VALUES('$user_id', '$price', '0')";
    mysqli_query($conn, $sql);

    if(mysqli_affected_rows($conn) == 1) {
        $sql = "SELECT * FROM `carts` WHERE `user_id` = '$user_id' AND `status` = '0'";
        $result = mysqli_query($conn, $sql);

        $row = mysqli_fetch_assoc($result);
        $cart_id = $row['id'];

        $sql = "INSERT INTO `product_cart`(`cart_id`, `product_id`, `cart_price`, `total`) VALUES('$cart_id', '$product_id', '$price', '$price')";
        mysqli_query($conn, $sql);
        if(mysqli_affected_rows($conn) == 1) {
            $_SESSION['success'] = "Product added to the cart";
        }
    }

    // redirection
    header("location: ../../products.php");

}