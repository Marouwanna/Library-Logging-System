<?php
date_default_timezone_set('Asia/Manila');

session_start();

include '../connnect.php';


$sql = "SELECT * FROM visitor_log ORDER BY time_in ASC";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Visitor Logs</title>
    <link rel="stylesheet" href="../CSS/viLog.css">
</head>
<body>
    <div class="logs-container">
        <a href="../ADMIN/admin-dashboard.php" class="back-btn">x</a>
        <h2>Visitor Logs</h2>
        <table>
            <thead>
                <tr>
                    <th>Card Number</th>
                    <th>Time-in</th>
                    <th>Time-out</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . htmlspecialchars($row['library_card']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['time_in']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['time_out']) . "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='4'>No logs found.</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>