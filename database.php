<?php
$conn = new mysqli("localhost", "root", "", "task1");

$startTime = $_POST['start_time'];
$finishTime = $_POST['finish_time'];
$distance = $_POST['distance'];
$activeType = $_POST['active_type'];

$sqlPush = mysqli_query($conn, "INSERT INTO activity(start_time,finish_time,distance,active_type) VALUES ('$startTime','$finishTime','$distance','$activeType')");

$sqlGet = "SELECT * FROM activity";
$result = mysqli_query($conn, $sqlGet);
while ($row = mysqli_fetch_array($result)) {
    echo "<table class='RecentActivities' style='border: 3px solid #90A0b2;'>";
    echo "<tr>";
    echo "<td>" . $row['created_at'] . "</td>";
    echo "<td>" . $row['active_type'] . "</td>";
    echo "<td>" . $row['distance'] . "km" . "</td>";
    echo "<td>" . $row['finish_time'] - $row['start_time'] . "h" . "</td>";
    echo "<td>" . number_format($row['distance'] / $row[$row['finish_time'] - $row['start_time']] . "km/hour",2) . "</td>";
    echo "</tr>";
    echo "</table>";
}
$sqlGetLongrun = "SELECT * FROM task1.activity where active_type='run' and distance=(select MAX(distance) FROM task1.activity) LIMIT 1;";
$highRide = mysqli_query($conn, $sqlGetLongrun);
while ($row = mysqli_fetch_array($highRide)) {
    echo "<aside class='Records'>";
    echo "<h4 class='RecordsText'>" . "Longest ride :" . "</h4>";
    echo "<h4>" . $row['created_at'] . $row['distance'] . $row['finish_time'] - $row['start_time'] . "h" . "</h4>";
}
$sqlGetLongride = "SELECT * FROM task1.activity where active_type='ride' and distance=(select MAX(distance) FROM task1.activity) LIMIT 1;";
$highRide = mysqli_query($conn, $sqlGetLongride);
while ($row = mysqli_fetch_array($highRide)) {
    echo "<h4 class='RecordsText'>Longest run:</h4>";
    echo "<h4>" . $row['created_at'] . $row['distance'] . $row['finish_time'] - $row['start_time'] . "h" . "</h4>";
    echo "</aside>";
}

$sqlGetTotalrun = "SELECT SUM(distance) AS alldistance FROM task1.activity where active_type='run';";
$highRide = mysqli_query($conn, $sqlGetTotalrun);
while ($row = mysqli_fetch_array($highRide)) {
    echo "<aside class='TotalBox'>";
    echo "<h4 class='TotalText'>Total run distance:".$row['alldistance'].'km'."</h4>";
}
$sqlGetTotalride = "SELECT SUM(distance) AS alldistance FROM task1.activity where active_type='ride';";
$highRide = mysqli_query($conn, $sqlGetTotalride);
while ($row = mysqli_fetch_array($highRide)) {
    echo "<h4 class='TotalText'>Total ride distance:".$row['alldistance'].'km'."</h4>";
    echo "</aside>";
}
