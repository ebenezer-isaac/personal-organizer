<?php
$page = "Organizer Delete Event";
include "logger.php";
date_default_timezone_set("Asia/Calcutta");
session_start();
if (isset($_SESSION["userid"])) {
    $eveid = filter_input(INPUT_POST, "event_id");
    $servername = "sql290.main-hosting.eu";
    $username = "u117204720_organizer";
    $password = "w:i#FgVx";
    $dbname = "u117204720_organizer";
    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    $sql = "delete from events where event_id = " . $eveid;
    $conn->query($sql);
    $conn->close();
    echo "<script>window . location . replace('main.php?url=events.php');</script>";
} else {
    echo "<script>window.location.replace('index.php');</script>";
}
