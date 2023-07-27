<?php 

// connections
$conn = mysqli_connect("localhost", "root", "", "pms");

if(!$conn) {
    echo "connect error" . mysqli_connect_error($conn);
}

