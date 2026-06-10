<?php
session_start();
include '../connnect.php';

$sql = "SELECT * FROM library_visitors";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Library Cards</title>
    <link rel="stylesheet" href="../CSS/librarycard.css">
</head>
<body>

<div class="container">
    <a href="../ADMIN/admin-dashboard.php" class="back-btn">x</a>
    <h1>Library Cards</h1>

    <table border="1">
        <thead>
            <tr>
                <th>#</th>
                <th>Library Card</th>
                <th>Action</th>
            </tr>
        </thead>

        <tbody>
            <?php
            $result = $conn->query($sql);

            if ($result && $result->num_rows > 0) {
                $count = 1;

                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $count++ . "</td>";
                    echo "<td>" . htmlspecialchars($row['library_card']) . "</td>";
                    echo "<td>
                            <a href='delete_staff.php?id=" . $row['id'] . "' onclick=\"return confirm('Are you sure?')\">Delete</a>
                          </td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='2'>No cards found.</td></tr>";
            }
            ?>
        </tbody>
    </table>
</div>

</body>
</html>