<?php
date_default_timezone_set('Asia/Manila');

session_start();
include '../connnect.php';

if (
    isset($_SESSION['log_username']) &&
    isset($_SESSION['time_in'])
) {

    $timeOut = date('Y-m-d H:i:s');

    $stmt = $conn->prepare("
        UPDATE staff_log
        SET time_out = ?
        WHERE username = ?
        AND time_in = ?
        LIMIT 1
    ");

    $stmt->bind_param(
        "sss",
        $timeOut,
        $_SESSION['log_username'],
        $_SESSION['time_in']
    );

    $stmt->execute();
}

session_destroy();

header('Location: ../index.php');
exit;
?>