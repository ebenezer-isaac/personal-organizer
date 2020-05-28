<?php
$page = "Organizer Events";
include "logger.php";
date_default_timezone_set("Asia/Calcutta");
session_start();
if (isset($_SESSION["userid"])) {
    ?><div class='card'><div class='card-header'>
            <p><h5>Event Details</h5></p>
        </div>
        <div class='card-body'>
            <div class='table-responsive'>
                <style>
                    tr{vertical-align : middle;text-align:center;}
                    th{vertical-align : middle;text-align:center;}
                    td{vertical-align : middle;text-align:center;}
                </style>
                <table class='table table-bordered table-hover' id='dataTable' 
                       width='100%' cellspacing='0'>
                    <thead>
                        <tr>
                            <th>Event ID</th>
                            <th>Start Time</th>
                            <th>End Time</th>
                            <th>Title</th>
                            <th>Description</th>
                            <th>Type</th>
                            <th>Expense</th>
                    </thead>
                    <?php
                    $servername = "sql290.main-hosting.eu";
                    $username = "u117204720_organizer";
                    $password = "w:i#FgVx";
                    $dbname = "u117204720_organizer";
                    $conn = new mysqli($servername, $username, $password, $dbname);
                    if ($conn->connect_error) {
                        die("Connection failed: " . $conn->connect_error);
                    }
                    $sql = "SELECT `event_id`, `start_time`, `end_time`, `title`, `description`, (select event_type_desc from event_type where events.type = event_type.event_type_id) as type, `expense` FROM events;";
                    $result = $conn->query($sql);
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr onclick=\"javascript:window.location.replace('main.php?url=event.php?id=" . $row["event_id"] . "')\">"
                            . "<td>" . $row["event_id"] . "</td>"
                            . "<td>" . $row["start_time"] . "</td>"
                            . "<td>" . $row["end_time"] . "</td>"
                            . "<td>" . $row["title"] . "</td>"
                            . "<td>" . $row["description"] . "</td>"
                            . "<td>" . $row["type"] . "</td>"
                            . "<td>" . $row["expense"] . "</td>";
                        }
                    }
                    $conn->close();
                    ?>
                </table>
            </div>
        </div>
    </div>
    </div><script>$('#dataTable').DataTable();</script>;
    <?php
} else {
    echo "<script>window.location.replace('index.php');</script>";
}


































