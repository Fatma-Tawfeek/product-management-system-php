<?php

session_start();

if(isset($_GET["id"])) {
    $conn = mysqli_connect("localhost", "root", "", "todoapp");
    if(!$conn){
        $_SESSION['errors'] = "connect error" . mysqli_connect_error($conn);
    }

    $id = $_GET["id"];

    $sql = "SELECT * FROM `tasks` WHERE `id` = '$id'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_row($result);

    if(!$row) {
        $_SESSION['errors'] = "Data is not exist";
    } else {
        $sql = "DELETE FROM `tasks` WHERE `id` = '$id'";
        mysqli_query($conn, $sql);
        $_SESSION['success'] = "Data deleted successfully";
    }

    // redirection

    header("location: ../index.php");
}