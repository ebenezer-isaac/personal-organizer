<?php

date_default_timezone_set("Asia/Calcutta");
session_start();
if (isset($_SESSION["userid"])) {
    if (isset($_SESSION["userid"])) {
        include "side.php";
        echo"<script src='js/jquery.min.js'></script>
<script src='js/bootstrap.bundle.min.js'></script>
<script src='js/jquery.easing.min.js'></script>
<script src='js/Chart.min.js'></script>
<script src='js/jquery.dataTables.js'></script>
<script src='js/dataTables.bootstrap4.js'></script>
<script src='js/sb-admin.min.js'></script>
<script src='js/ajax.js'></script>";
        if (isset($_REQUEST["url"])) {
            echo "<script>setContent('" . $_REQUEST["url"] . "')</script>";
        } else {
            echo "<script>setContent('home.php')</script>";
        }
        include "end.php";
    } else {
        echo "<script>window.location.replace('index.php');</script>";
    }
} else {
    echo "<script>window.location.replace('index.php');</script>";
}
