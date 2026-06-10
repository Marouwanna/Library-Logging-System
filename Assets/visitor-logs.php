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
            
               <tbody id="visitorLogsBody">

            </tbody>
        </table>
    </div>
    <script>
        function loadVisitorLogs() {

            fetch('../Assets/visitor-logs-data.php')
            .then(response => response.json())
            .then(data => {

                let html = '';

                data.forEach(log => {

                    html += `
                    <tr>
                        <td>${log.library_card}</td>
                        <td>${log.time_in ?? ''}</td>
                        <td>${log.time_out ?? ''}</td>
                    </tr>
                    `;
                });

                document.getElementById('visitorLogsBody').innerHTML = html;
            });
        }

        loadVisitorLogs();

        setInterval(loadVisitorLogs, 3000);
</script>
</body>
</html>