<?php
date_default_timezone_set('Asia/Manila');

session_start();

include '../connnect.php';


$sql = "SELECT * FROM staff_log ORDER BY time_in ASC";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Logs</title>
    <link rel="stylesheet" href="../CSS/aiLogs.css">
</head>
<body>
    <div class="logs-container">
        <a href="../ADMIN/admin-dashboard.php" class="back-btn">x</a>
        <h2>Admin Logs</h2>
        <table>
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Time-in</th>
                    <th>Time-out</th>
                </tr>
            </thead>
            
                <tbody id="adminLogsBody">

            </tbody>
        </table>
    </div>
    <script>
        function loadAdminLogs() {

            fetch('../Assets/admin-logs-data.php')
            .then(response => response.json())
            .then(data => {

                let html = '';

                data.forEach(log => {

                    html += `
                    <tr>
                        <td>${log.username}</td>
                        <td>${log.time_in ?? ''}</td>
                        <td>${log.time_out ?? ''}</td>
                    </tr>
                    `;
                });

                document.getElementById('adminLogsBody').innerHTML = html;
            });
        }

        loadAdminLogs();

        setInterval(loadAdminLogs, 3000);
</script>
</body>
</html>