<?php
include("../connnect.php");

$sql = "SELECT * FROM staff";
$result = $conn->query($sql);

if ($result && $result->num_rows > 0) {

    while ($row = $result->fetch_assoc()) {

        echo "<tr>";
        echo "<td>" . htmlspecialchars($row['id']) . "</td>";
        echo "<td>" . htmlspecialchars($row['username']) . "</td>";
        echo "<td>" . htmlspecialchars($row['password']) . "</td>";

        echo "<td>
                <button class='edit-btn'
                    onclick='openEditModal(".$row['id'].", \"".$row['username']."\")'>
                    Edit
                </button>

                <button class='delete-btn'
                    onclick='confirmDelete(".$row['id'].")'>
                    Delete
                </button>
              </td>";

        echo "</tr>";
    }

} else {

    echo "<tr><td colspan='4'>No records found.</td></tr>";

}
?>