<?php 

function checkRequestMethod($method) {
    if($_SERVER['REQUEST_METHOD'] == $method) {
        return true;
    } else {
        return false;
    }
}

function checkPostInput($input) {
    if (isset($_POST[$input])){
        return true;
    } else {
        return false;
    }
}

function sanitizeInput($input) {
    return trim(htmlspecialchars(htmlentities(stripslashes($input))));
}

function redirect($path) {
    header(("location:$path"));
}