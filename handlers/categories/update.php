<?php

session_start();

include '../../database/database.php';

if(isset($_POST["id"])) {

    $id = $_POST["id"];
    $name = trim(htmlspecialchars(htmlentities($_POST["name"])));

    $sql = "UPDATE `categories` SET 
    `cat_name`='$name'
     WHERE `cat_id`= '$id'";
    $result = mysqli_query($conn, $sql);
    if($result) {
        $_SESSION['success'] = "Data is updated successfully";
    }

    // redirection

    header("location: ../../categories.php");
}