<?php 

session_start();

include '../../database/connection.php';
include '../../core/functions.php';
include '../../core/validations.php';

   $user_id = $_POST['user_id'];
   $product_id = $_POST['product_id'];
   $price = $_POST['price'];
   $product_quantity = $_POST['quantity'];
   $cart_quantity = $_POST['qt'];

   if($product_quantity > $cart_quantity) {


   $sql = "SELECT * FROM `carts` WHERE `user_id` = '$user_id' AND `status` = '0'";
   $result = mysqli_query($conn, $sql);
   
   if(mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $cart_id = $row['id'];
    $total = $price*$cart_quantity;

    $sql = "INSERT INTO `product_cart`(`cart_id`, `product_id`, `price`, `quantity`, `total` ) VALUES('$cart_id', '$product_id', '$price', '$cart_quantity', '$total')";
    mysqli_query($conn, $sql);

    if(mysqli_affected_rows($conn) == 1) {
        $_SESSION['success'] = "Product added to the cart successfully";
    }

    // redirection
    redirect("../../views/products.php");

  } else {

    $sql = "INSERT INTO `carts`(`user_id`, `total`, `status`) VALUES('$user_id', 0, '0')";
    mysqli_query($conn, $sql);

    if(mysqli_affected_rows($conn) == 1) {
        $sql = "SELECT * FROM `carts` WHERE `user_id` = '$user_id' AND `status` = '0'";
        $result = mysqli_query($conn, $sql);

        $row = mysqli_fetch_assoc($result);
        $cart_id = $row['id'];
        $total = $price*$cart_quantity;

        $sql = "INSERT INTO `product_cart`(`cart_id`, `product_id`, `price`, `quantity`, `total` ) VALUES('$cart_id', '$product_id', '$price', '$cart_quantity', '$total')";        mysqli_query($conn, $sql);
        if(mysqli_affected_rows($conn) == 1) {
            $_SESSION['success'] = "Product added to the cart";
        }
    }

    // redirection
    redirect("../../views/products.php");

}
   }else {
    $errors[] = "product quantity is not enough";
    $_SESSION['errors'] = $errors;
    redirect("../../views/products.php");
    die();
   }