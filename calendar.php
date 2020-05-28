<?php
$page = "Organizer Calendar";
include "logger.php";
date_default_timezone_set("Asia/Calcutta");
session_start();
if (isset($_SESSION["userid"])) {
    ?>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/jquery-pseudo-ripple.css">
    <link rel="stylesheet" href="css/jquery-nao-calendar.css">
    <style>
        .container { margin: 150px auto; max-width: 480px; }
        .myCalendar.nao-month td {
            padding: 15px;
        }
        .myCalendar .month-head>div,
        .myCalendar .month-head>button {
            padding: 15px;
        }
    </style>
    <div class = 'card'><div class = 'card-header'>
            <p><h5>Calendar</h5></p>
        </div>
        <div class = 'card-body'>
            <div class = 'table-responsive'>
                <div class="myCalendar"></div>
            </div>
        </div>
    </div>
    <script src="js/jquery-pseudo-ripple.js"></script>
    <script src="js/jquery-nao-calendar.js"></script>
    <script>
        $('.myCalendar').calendar({
            date: new Date(),
            autoSelect: false, // false b              y default
            select: function (date) {
                console.log('SELECT', date)
            },
            toggle: function (y, m) {
                console.log('TOGGLE', y, m)
            }
        });
    </script>
    </bo    dy>
    </html>
    <?php
} else {
    echo "<script>window.location.replace('index.php');</script>";
}

