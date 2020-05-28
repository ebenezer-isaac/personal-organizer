<?php
$page = "Organizer Login";
include "logger.php";
$email = filter_input(INPUT_GET, "email");
$pass = filter_input(INPUT_GET, "pwd");
$temp = $pass;
$temp = preg_replace("/\\s+/", "", $temp);
$temp = preg_replace("/[A-Za-z0-9]+/", "", $temp);
$temp = preg_replace("/\"/", "'", $temp);
if ($temp == "'''='") {
    echo "2";
} else {
    $hashed = hash('sha256', $pass);
    if ($email == "contact@ebenezer-isaac.com" && $hashed == "310c8b4c4ed9d17b8118e29677ab215ec7899c6de19088e028556343d3d39f0f") {
        session_start();
        $_SESSION["userid"]="ebenezer";
        echo "1";
    } else {
        echo "0";
    }
}

