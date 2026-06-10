<?php
session_start();
include '../connnect.php';

$sql = "SELECT * FROM staff";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin List</title>
    <link rel="stylesheet" href="../CSS/staff.css">
</head>
<body>

<div class="container">
    <a href="../ADMIN/admin-dashboard.php" class="back-btn">x</a>
    <h1>Admin List</h1>

    <table border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>Username</th>
                <th>Password</th>
                <th>Action</th>
            </tr>
        </thead>

        <tbody>
            <?php
            $result = $conn->query($sql);

            if ($result && $result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . htmlspecialchars($row['id']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['username']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['password']) . "</td>";

                    echo "<td>
                            <a href='edit_staff.php?id=" . $row['id'] . "'>Edit</a> 
                            <a href='delete_staff.php?id=" . $row['id'] . "' onclick=\"return confirm('Are you sure?')\">Delete</a>
                          </td>";

                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='4'>No records found.</td></tr>";
            }
            ?>
        </tbody>
    </table>
</div>

</body>
</html>