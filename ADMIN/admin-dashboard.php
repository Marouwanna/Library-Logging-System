<?php
session_start();
include '../connnect.php';

$admin_username = $_SESSION['admin_username'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Library Dashboard</title>
    <link rel="stylesheet" href="../CSS/admintboard.css">
</head>
<body>

<div class="admin-dashboard-container">

    <div class="dashboard-header">
        <h2>Library Dashboard</h2>
        <div class="admin-info">
            <span>Logged in as: <strong><?php echo htmlspecialchars($admin_username); ?></strong></span>
            <a href="../Assets/logout.php" class="logout-btn">Logout</a> <br>
            <div class="tabs">
                <a href="../Assets/adminstaff.php" class="tab">Admin List</a>
                <a href="../Assets/admin-logs.php" class="tab">Admin Logs</a>
                <a href="../Assets/visitor-logs.php" class="tab">Visitor Logs</a>
                <a href="../Assets/librarycard.php" class="tab">Library Card</a>
            </div>
        </div>
        
    </div>

    <div class="chart-container">
        <canvas id="loginChart"></canvas>
    </div>

    <div class="developer-pg">
        <a href="../developer-page.php" class="tab">Developer Page</a>
    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="../JS/admin-dashboard.js"></script>

</body>
</html>