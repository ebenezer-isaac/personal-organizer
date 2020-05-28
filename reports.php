<?php
$page = "Organizer Reports";
include "logger.php";
date_default_timezone_set("Asia/Calcutta");
session_start();
if (isset($_SESSION["userid"])) {
    ?><p><h5>Reports for <?php echo date('F, Y'); ?></h5></p>
    <div class="card mb-4">
        <div class="card-header"><i class="fas fa-chart-area mr-1"></i>Record Management</div>
        <div class="card-body"><canvas id="myAreaChart" width="100%" height="35"></canvas></div>
        <div class="card-footer small text-muted"><?php echo date('F, Y'); ?></div>
    </div>
    <div class="row">
        <div class="col-lg-6">
            <div class="card mb-4">
                <div class="card-header"><i class="fas fa-chart-bar mr-1"></i>Expense Management</div>
                <div class="card-body"><canvas id="myBarChart" width="100%" height="70"></canvas></div>
                <div class="card-footer small text-muted"><?php echo date('F, Y'); ?></div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="card mb-4">
                <div class="card-header"><i class="fas fa-chart-pie mr-1"></i>Time Management</div>
                <div class="card-body"><canvas id="myPieChart" width="100%" height="70"></canvas></div>
                <div class="card-footer small text-muted"><?php echo date('F, Y'); ?></div>
            </div>
        </div>
    </div>
    <script>
    // Set new default font family and font color to mimic Bootstrap's default styling
        Chart.defaults.global.defaultFontFamily = '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
        Chart.defaults.global.defaultFontColor = '#292b2c';
        var Month = new Array();
        Month[0] = "Jan";
        Month[1] = "Feb";
        Month[2] = "Mar";
        Month[3] = "Apr";
        Month[4] = "May";
        Month[5] = "Jun";
        Month[6] = "Jul";
        Month[7] = "Aug";
        Month[8] = "Sep";
        Month[9] = "Oct";
        Month[10] = "Nov";
        Month[11] = "Dec";
        var d = new Date();
        var year = d.getFullYear();
        var month = d.getMonth();
        var date = new Date(year, month, 1);
        var days = [];
        while (date.getMonth() === month) {
            var temp = new Date(date);
            days.push(Month[temp.getMonth()] + "-" + temp.getDate());
            date.setDate(date.getDate() + 1);
        }
        var ctx = document.getElementById("myAreaChart");
        var myLineChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: days,
                datasets: [{
                        label: "Percentage",
                        lineTension: 0.3,
                        backgroundColor: "rgba(2,117,216,0.2)",
                        borderColor: "rgba(2,117,216,1)",
                        pointRadius: 5,
                        pointBackgroundColor: "rgba(2,117,216,1)",
                        pointBorderColor: "rgba(255,255,255,0.8)",
                        pointHoverRadius: 5,
                        pointHoverBackgroundColor: "rgba(2,117,216,1)",
                        pointHitRadius: 50,
                        pointBorderWidth: 2,
                        data: [
    <?php
    $dates = array();
    $month = date("m");
    $year = date("Y");

    for ($d = 1; $d <= 31; $d++) {
        $time = mktime(12, 0, 0, $month, $d, $year);
        if (date('m', $time) == $month) {
            $dates[] = date('Y-m-d-D', $time);
        }
    }
    $servername = "sql290.main-hosting.eu";
    $username = "u117204720_organizer";
    $password = "w:i#FgVx";
    $dbname = "u117204720_organizer";
    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    $counter = 0;
    foreach ($dates as $date) {
        $sql = "select ((sum(TIME_TO_SEC(timeDIFF(`end_time`,`start_time`)))/60)/1440)*100 as datediff from events where cast(start_time as date) = '" . mysqli_real_escape_string($conn, $date) . "'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                if ($row["datediff"] == "") {
                    echo "0";
                } else {
                    echo round($row["datediff"], 2);
                }
            }
        }
        $counter = $counter + 1;
        if (count($dates, COUNT_NORMAL) != $counter) {
            echo",";
        }
    }
    ?>
                        ],
                    }],
            },
            options: {
                scales: {
                    xAxes: [{
                            time: {
                                unit: 'date'
                            },
                            gridLines: {
                                display: false
                            },
                            ticks: {
                                maxTicksLimit: 31
                            }
                        }],
                    yAxes: [{
                            ticks: {
                                min: 0,
                                max: 100,
                                maxTicksLimit: 10
                            },
                            gridLines: {
                                color: "rgba(0, 0, 0, .125)",
                            }
                        }],
                },
                legend: {
                    display: false
                }
            }
        });


    // Set new default font family and font color to mimic Bootstrap's default styling
        Chart.defaults.global.defaultFontFamily = '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
        Chart.defaults.global.defaultFontColor = '#292b2c';
        var ctx = document.getElementById("myBarChart");
        var myLineChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ["Programming", "Chores", "Driving", "Eating", "Leisure", "Entertainment", "Gaming", "Church", "Hangout", "Sleeping"],
                datasets: [{
                        label: "Rs ",
                        backgroundColor: "rgba(2,117,216,1)",
                        borderColor: "rgba(2,117,216,1)",
                        data: [
    <?php
    $i = 1;
    while ($i <= 10) {
        $sql = "SELECT sum(expense) as sum FROM events WHERE MONTH(start_time) = MONTH(CURDATE()) AND YEAR(start_time) = YEAR(CURDATE()) and type = " . mysqli_real_escape_string($conn, $i);
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                if ($row["sum"] == "") {
                    echo "0";
                } else {
                    echo round($row["sum"], 2);
                }
            }
        }
        if ($i != 10) {
            echo",";
        }
        $i = $i + 1;
    }
    ?>
                        ],
                    }],
            },
            options: {
                scales: {
                    xAxes: [{
                            time: {
                                unit: 'month'
                            },
                            gridLines: {
                                display: false
                            },
                            ticks: {
                                maxTicksLimit: 10
                            }
                        }],
                    yAxes: [{
                            ticks: {
                                min: 0,
                                max: 5000,
                                maxTicksLimit: 10
                            },
                            gridLines: {
                                display: true
                            }
                        }],
                },
                legend: {
                    display: false
                }
            }
        });

    // Set new default font family and font color to mimic Bootstrap's default styling
        Chart.defaults.global.defaultFontFamily = '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
        Chart.defaults.global.defaultFontColor = '#292b2c';

    // Pie Chart Example
        var ctx = document.getElementById("myPieChart");
        var myPieChart = new Chart(ctx, {
            type: 'pie',
            data: {
                labels: ["Programming", "Chores", "Driving", "Eating", "Leisure", "Entertainment", "Gaming", "Church", "Hangout", "Sleeping"],
                datasets: [{
                        data: [
    <?php
    $i = 1;
    $total = 0;
    $sql = "SELECT sum(TIME_TO_SEC(timeDIFF(`end_time`,`start_time`))) as sum FROM events WHERE MONTH(start_time) = MONTH(CURDATE()) AND YEAR(start_time) = YEAR(CURDATE())";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $total = $row["sum"];
        }
    }
    if ($total > 0) {
        while ($i <= 10) {
            $sql = "SELECT (sum(TIME_TO_SEC(timeDIFF(`end_time`,`start_time`)))/" . $total . ")*100 as sum FROM events WHERE type = " . mysqli_real_escape_string($conn, $i) . " and MONTH(start_time) = MONTH(CURDATE()) AND YEAR(start_time) = YEAR(CURDATE());";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    if ($row["sum"] == "") {
                        echo "0";
                    } else {
                        echo round($row["sum"], 2);
                    }
                }
            }
            if ($i != 10) {
                echo",";
            }
            $i = $i + 1;
        }
    }
    $conn->close();
    ?>
                        ],
                        backgroundColor: ['#e6194B', '#f58231', '#ffe119', "#bfef45", "#3cb44b", '#808000', "#42d4f4", "#4363d8", "#911eb4", "#f032e6"],
                    }],
            },
        });

    </script>
    <?php
} else {
    echo "<script>window.location.replace('index.php');</script>";
}
