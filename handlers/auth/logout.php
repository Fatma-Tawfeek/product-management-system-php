<?php 

session_start();
include '../../core/functions.php';

session_destroy();
redirect("../../views/login.php");
die();