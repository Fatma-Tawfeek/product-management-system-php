<?php 

session_start();

include '../../database/database.php';

if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["name"])) {

    $name = trim(htmlspecialchars(htmlentities($_POST["name"])));
    $phone = $_POST["phone"];
    $email = trim(htmlspecialchars(htmlentities($_POST["email"])));
    $password = trim(htmlspecialchars(htmlentities($_POST["password"])));


    $sql = "INSERT INTO `users`(`name`, `phone`, `email`, `password`) VALUES('$name', '$phone', '$email', '$password')";
    $result = mysqli_query($conn, $sql);
    if(mysqli_affected_rows($conn) == 1) {
        $_SESSION['success'] = "Data is inserted successfully";
    }

    // redirection

    header("location: ../../users.php");
}