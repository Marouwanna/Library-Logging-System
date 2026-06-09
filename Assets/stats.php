<?php
header('Content-Type: application/json');
include '../connnect.php';

$admin = 0;
$visitor = 0;

$adminResult = $conn->query("SELECT COUNT(*) as total FROM staff_log");
if ($adminResult) {
    $admin = $adminResult->fetch_assoc()['total'];
}

$visitorResult = $conn->query("SELECT COUNT(*) as total FROM visitor_log");
if ($visitorResult) {
    $visitor = $visitorResult->fetch_assoc()['total'];
}

echo json_encode([
    "admins" => (int)$admin,
    "visitors" => (int)$visitor
]);
?>