<?php

session_start();

$conn = mysqli_connect("localhost", "root", "", "todoapp");
if(!$conn){
    $_SESSION['errors'] = "connect error" . mysqli_connect_error($conn);
}


if($_SERVER['REQUEST_METHOD']  == "POST" && isset($_POST['title'])) {

    $id = $_GET["id"];
    $title = trim(htmlspecialchars(htmlentities($_POST["title"])));

    $sql = "UPDATE `tasks` SET `title`='$title' WHERE `id`= $id";
    $result = mysqli_query($conn, $sql);
    if($result) {
        $_SESSION['success'] = "Data is updated successfully";
    }

    // redirection

    header("location: ../index.php");
}