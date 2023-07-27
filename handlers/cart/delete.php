<?php

session_start();

include '../../database/connection.php';
include '../../core/functions.php';

if(isset($_GET["id"])) {

    $id = $_GET["id"];

    $sql = "SELECT * FROM `product_cart` WHERE `product_id` = '$id'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_row($result);

    if(!$row) {
        $_SESSION['errors'] = "Data is not exist";
    } else {
        $sql = "DELETE FROM `product_cart` WHERE `product_id` = '$id'";
        mysqli_query($conn, $sql);
        $_SESSION['success'] = "Data deleted successfully";
    }

    // redirection

    redirect("../../views/cart.php");
}