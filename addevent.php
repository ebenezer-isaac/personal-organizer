<?php
$page = "Organizer Add Event";
include "logger.php";
date_default_timezone_set("Asia/Calcutta");
session_start();
if (isset($_SESSION["userid"])) {
    ?>
    <div class = 'card'>
        <div class = 'card-header'>
            <p><h5>Enter Details of New Event</h5></p>
        </div>
        <div class = 'card-body'>
            <div class = 'table-responsive'>
                <style>
                    .forms{
                        background-color:#f0f0f0;
                        border:none;
                        border-radius:4px;
                        padding:5px;
                    }
                </style>
                <form action='saveaddevent.php' method='post'>
                    <table align='center' cellpadding='4'>
                        <tr><td align='center'>Start Date</td><td align='center'>&nbsp;&nbsp;:&nbsp;&nbsp;</td><td align='center'><input id='datePicker' required class='forms' value=<?php echo "'" . date("Y-m-d") . "'"; ?> type ='date' name ='sdate'></td><tr>
                        <tr><td align='center'>Start Time</td><td align='center'>&nbsp;&nbsp;:&nbsp;&nbsp;</td><td align='center'><input required class='forms' value=<?php echo "'" . date("H:i") . ":00'"; ?> type = 'time' name ='stime'></td><tr>
                        <tr><td align='center'>End Date</td><td align='center'>&nbsp;&nbsp;:&nbsp;&nbsp;</td><td align='center'><input id='datePicker' required class='forms' value=<?php echo "'" . date("Y-m-d") . "'"; ?> type ='date' name ='edate'></td><tr>
                        <tr><td align='center'>End Time</td><td align='center'>&nbsp;&nbsp;:&nbsp;&nbsp;</td><td align='center'><input required class='forms' value=<?php echo "'" . date("H:i") . ":00'"; ?> type = 'time' name ='etime'></td><tr>
                        <tr><td align='center'>Title</td><td align='center'>&nbsp;&nbsp;:&nbsp;&nbsp;</td><td align='center'><input required class='forms' type = 'text' name ='title'></td><tr>
                        <tr><td align='center'>Description</td><td align='center'>&nbsp;&nbsp;:&nbsp;&nbsp;</td><td align='center'><input class='forms' type = 'text' name ='desc'></td><tr>
                        <tr><td align='center'>Expense</td><td align='center'>&nbsp;&nbsp;:&nbsp;&nbsp;</td><td align='center'>Rs. &nbsp;<input size = '10px' required class='forms' type = 'text' name ='expense'></td><tr>
                        <tr><td align='center'>Type</td><td align='center'>&nbsp;&nbsp;:&nbsp;&nbsp;</td>
                            <td align='center'>
                                <select required name = 'type' class='forms'>
                                    <?php
                                    $servername = "sql290.main-hosting.eu";
                                    $username = "u117204720_organizer";
                                    $password = "w:i#FgVx";
                                    $dbname = "u117204720_organizer";
                                    $conn = new mysqli($servername, $username, $password, $dbname);
                                    if ($conn->connect_error) {
                                        die("Connection failed: " . $conn->connect_error);
                                    }
                                    $sql = "SELECT * FROM event_type;";
                                    $result = $conn->query($sql);
                                    if ($result->num_rows > 0) {
                                        while ($row = $result->fetch_assoc()) {
                                            echo "<option value='" . $row["event_type_id"] . "'>" . $row["event_type_desc"] . "</option>";
                                        }
                                    }
                                    $conn->close();
                                    ?>
                                </select>
                            </td>
                        </tr>
                    </table><br>
                    <input type='submit' class='btn btn-primary'>
                </form>
                <br>
            </div>
        </div>
    </div>

    <?php
} else {
    echo "<script>window.location.replace('index.php');</script>";
}
