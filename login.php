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
    if ($email == "contact@ebenezer-isaac.com" && $hashed == "06b03fa276676b1da2acecb5475baddbd4037805b8189c362326ed59e535da29") {
        session_start();
        $_SESSION["userid"]="ebenezer";
        echo "1";
    } else {
        echo "0";
    }
}

