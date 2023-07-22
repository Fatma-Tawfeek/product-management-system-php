<?php

session_start();

include '../../database/database.php';

if(isset($_POST["id"])) {

    $id = $_POST["id"];
    $name = trim(htmlspecialchars(htmlentities($_POST["name"])));
    $price = $_POST["price"];
    $brand = trim(htmlspecialchars(htmlentities($_POST["brand"])));
    $color = trim(htmlspecialchars(htmlentities($_POST["color"])));
    $cat_id = $_POST["cat_id"];

    $sql = "UPDATE `products` SET 
    `name`='$name',
    `price`='$price',
    `category_id`='$cat_id',
    `brand`='$brand',
    `color`='$color'
     WHERE `id`= '$id'";
    $result = mysqli_query($conn, $sql);
    if($result) {
        $_SESSION['success'] = "Data is updated successfully";
    }

    // redirection

    header("location: ../../index.php");
}