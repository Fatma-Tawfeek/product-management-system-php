<?php 

session_start();

include '../../database/database.php';

if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["name"])) {

    $name = trim(htmlspecialchars(htmlentities($_POST["name"])));
    $price = $_POST["price"];
    $brand = trim(htmlspecialchars(htmlentities($_POST["brand"])));
    $color = trim(htmlspecialchars(htmlentities($_POST["color"])));
    $cat_id = $_POST["cate_id"];


    $sql = "INSERT INTO `products`(`name`, `price`, `brand`, `color`, `category_id`) VALUES('$name', '$price', '$brand', '$color', '$cat_id')";
    $result = mysqli_query($conn, $sql);
    if(mysqli_affected_rows($conn) == 1) {
        $_SESSION['success'] = "Data is inserted successfully";
    }

    // redirection

    header("location: ../../index.php");
}