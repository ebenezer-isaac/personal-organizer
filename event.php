<?php
$page = "Organizer Event";
include "logger.php";
date_default_timezone_set("Asia/Calcutta");
session_start();
if (isset($_SESSION["userid"])) {
    ?><div class = 'card'>
        <div class = 'card-header'>
            <p><h5>Edit Details of Selected Event</h5></p>
        </div>
        <div class = 'card-body'>
            <div class = 'table-responsive'>
                <?php
                $event_id = filter_input(INPUT_GET, "id");
                $servername = "sql290.main-hosting.eu";
                $username = "u117204720_organizer";
                $password = "w:i#FgVx";
                $dbname = "u117204720_organizer";
                $conn = new mysqli($servername, $username, $password, $dbname);
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }
                $sql = "SELECT `event_id`, cast(start_time as time) as start_time,cast(start_time as date) as start_date ,cast(end_time as time) as end_time,cast(end_time as date) as end_date , `title`, `description`, type, `expense` FROM events where event_id = " . mysqli_real_escape_string($conn, $event_id) . ";";
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo"<style>"
                        . ".forms{"
                        . "background-color:#f0f0f0;"
                        . "border:none;"
                        . "border-radius:4px;"
                        . "padding:5px;"
                        . "}"
                        . "</style>"
                        . "<form action='updateevent.php' method='post'>"
                        . "<table align='center' cellpadding='4'>"
                        . "<tr><td align='center'>Start Date</td><td align='center'>&nbsp;&nbsp;:&nbsp;&nbsp;</td><td align='center'><input required class='forms' type = 'date' name ='sdate' value='" . $row["start_date"] . "'></td><tr>"
                        . "<tr><td align='center'>Start Time</td><td align='center'>&nbsp;&nbsp;:&nbsp;&nbsp;</td><td align='center'><input required class='forms' type = 'time' name ='stime' value='" . $row["start_time"] . "'></td><tr>"
                        . "<tr><td align='center'>End Date</td><td align='center'>&nbsp;&nbsp;:&nbsp;&nbsp;</td><td align='center'><input required class='forms' type = 'date' name ='edate' value='" . $row["end_date"] . "'></td><tr>"
                        . "<tr><td align='center'>End Time</td><td align='center'>&nbsp;&nbsp;:&nbsp;&nbsp;</td><td align='center'><input required class='forms' type = 'time' name ='etime' value='" . $row["end_time"] . "'></td><tr>"
                        . "<tr><td align='center'>Title</td><td align='center'>&nbsp;&nbsp;:&nbsp;&nbsp;</td><td align='center'><input required class='forms' type = 'text' name ='title' value='" . $row["title"] . "'></td><tr>"
                        . "<tr><td align='center'>Description</td><td align='center'>&nbsp;&nbsp;:&nbsp;&nbsp;</td><td align='center'><input class='forms' type = 'text' name ='desc' value='" . $row["description"] . "'></td><tr>"
                        . "<tr><td align='center'>Expense</td><td align='center'>&nbsp;&nbsp;:&nbsp;&nbsp;</td><td align='center'>Rs. &nbsp;<input size = '10px' required class='forms' type = 'text' name ='expense' value='" . $row["expense"] . "'></td><tr>"
                        . "<tr><td align='center'>Type</td><td align='center'>&nbsp;&nbsp;:&nbsp;&nbsp;</td><td align='center'>"
                        . "<select required name = 'type' class='forms'>"
                        . "<option>Select an Option</option>";
                        $event_type = $row["type"];
                        if ($conn->connect_error) {
                            die("Connection failed: " . $conn->connect_error);
                        }
                        $sql = "SELECT * FROM event_type;";
                        $result = $conn->query($sql);
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                echo "<option value='" . $row["event_type_id"] . "'";
                                if ($event_type == $row["event_type_id"]) {
                                    echo"selected";
                                }
                                echo ">" . $row["event_type_desc"] . "</option>";
                            }
                        }
                        echo "</select></td></tr>"
                        . "</table><br>"
                        . "<input type='text' name='id' hidden value='" . $event_id . "'>"
                        . "<input type='submit' class='btn btn-primary' value='Save'>"
                        . "</form>";
                    }
                }
                $conn->close();
                ?>
                <br>
                <form action="delevent.php" method="post">
                    <input type="text" hidden value="<?php echo $event_id; ?>" name="event_id">
                    <input type='submit' class='btn btn-primary' value='Delete Event'>
                </form>
                <br>
            </div>
        </div>
    </div>
    <?php
} else {
    echo "<script>window.location.replace('index.php');</script>";
}
