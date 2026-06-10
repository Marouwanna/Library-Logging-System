<?php
include '../connnect.php';

$sql = "SELECT * FROM staff_log ORDER BY time_in DESC";
$result = $conn->query($sql);

$logs = [];

while($row = $result->fetch_assoc()){
    $logs[] = $row;
}

header('Content-Type: application/json');
echo json_encode($logs);