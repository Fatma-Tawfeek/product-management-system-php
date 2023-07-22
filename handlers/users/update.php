<?php

session_start();

include '../../database/database.php';

if(isset($_POST["id"])) {

    $id = $_POST["id"];
    $name = trim(htmlspecialchars(htmlentities($_POST["name"])));
    $phone = $_POST["phone"];
    $email = trim(htmlspecialchars(htmlentities($_POST["email"])));
    $password = trim(htmlspecialchars(htmlentities($_POST["password"])));

    $sql = "UPDATE `users` SET 
    `name`='$name',
    `email`='$email',
    `phone`='$phone',
    `password`='$password'
     WHERE `id`= '$id'";
    $result = mysqli_query($conn, $sql);
    if($result) {
        $_SESSION['success'] = "Data is updated successfully";
    }

    // redirection

    header("location: ../../users.php");
}