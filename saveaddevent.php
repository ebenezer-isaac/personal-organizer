<?php
$page = "Organizer Save Add Event";
include "logger.php";
date_default_timezone_set("Asia/Calcutta");
session_start();
if (isset($_SESSION["userid"])) {
    $sdate = filter_input(INPUT_POST, "sdate");
    $stime = filter_input(INPUT_POST, "stime");
    $edate = filter_input(INPUT_POST, "edate");
    $etime = filter_input(INPUT_POST, "etime");
    $title = filter_input(INPUT_POST, "title");
    $desc = filter_input(INPUT_POST, "desc");
    $expense = filter_input(INPUT_POST, "expense");
    $type = filter_input(INPUT_POST, "type");
    $servername = "srv677.hstgr.io";
    $username = "u117204720_organizer";
    $password = "w:i#FgVx";
    $dbname = "u117204720_organizer";
    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    $sql = "INSERT INTO events VALUES (null,"
            . "'" . mysqli_real_escape_string($conn, $sdate) . " " . mysqli_real_escape_string($conn, $stime) . "', "
            . "'" . mysqli_real_escape_string($conn, $edate) . " " . mysqli_real_escape_string($conn, $etime) . "', "
            . "'" . mysqli_real_escape_string($conn, $title) . "', "
            . "'" . mysqli_real_escape_string($conn, $desc) . "', "
            . "'" . mysqli_real_escape_string($conn, $type) . "', "
            . mysqli_real_escape_string($conn, $expense) . ");";
    $conn->query($sql);
    $conn->close();
    echo "<script>window.location.replace('main.php?url=events.php');</script>";
} else {
    echo "<script>window.location.replace('index.php');</script>";
}

