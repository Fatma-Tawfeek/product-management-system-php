<?php 

session_start();

include '../../database/database.php';

if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["name"])) {

    $name = trim(htmlspecialchars(htmlentities($_POST["name"])));


    $sql = "INSERT INTO `categories`(`cat_name`) VALUES('$name')";
    $result = mysqli_query($conn, $sql);
    if(mysqli_affected_rows($conn) == 1) {
        $_SESSION['success'] = "Data is inserted successfully";
    }

    // redirection

    header("location: ../../categories.php");
}