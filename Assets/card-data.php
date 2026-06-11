<?php
include("../connnect.php");

$sql = "SELECT * FROM library_visitors";
$result = $conn->query($sql);

if ($result && $result->num_rows > 0) {

    $count = 1;

    while ($row = $result->fetch_assoc()) {

        echo "<tr>";
        echo "<td>" . $count++ . "</td>";
        echo "<td>" . htmlspecialchars($row['library_card']) . "</td>";

        echo "<td>
                <button class='delete-btn'
                    onclick='confirmDelete(".$row['id'].")'>
                    Delete
                </button>
              </td>";

        echo "</tr>";
    }

} else {

    echo "<tr>
            <td colspan='3'>No cards found.</td>
          </tr>";
}
?>