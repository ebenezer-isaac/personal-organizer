<?php
$page = "Organizer profile";
include "logger.php";
date_default_timezone_set("Asia/Calcutta");
session_start();
if (isset($_SESSION["userid"])) {
    ?>
    <img style='width:150px;height:150px;' src='img/ebi.png'><br><br>
    <font size=5><b>Ebenezer Isaac</b></font>
    <br><br>
    4<sup>th</sup> May 1999
    <br><br>
    21, Nakshatra Enclave,<br> Spun Villa, Behind Railway Station,<br>Alkapuri, Vadodara<br> Gujarat - 390007
    <?php

} else {
    echo "<script>window.location.replace('index.php');</script>";
}
