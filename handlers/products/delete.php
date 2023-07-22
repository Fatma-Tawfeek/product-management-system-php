<?php

session_start();

include '../../database/database.php';

if(isset($_GET["id"])) {

    $id = $_GET["id"];

    $sql = "SELECT * FROM `products` WHERE `id` = '$id'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_row($result);

    if(!$row) {
        $_SESSION['errors'] = "Data is not exist";
    } else {
        $sql = "DELETE FROM `products` WHERE `id` = '$id'";
        mysqli_query($conn, $sql);
        $_SESSION['success'] = "Data deleted successfully";
    }

    // redirection

    header("location: ../../index.php");
}