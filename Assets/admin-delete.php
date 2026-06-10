<?php
session_start();

include("../connnect.php");

if (isset($_GET['id'])) {
    $admin_id = $_GET['id'];

    $stmt = $conn->prepare("DELETE FROM staff WHERE id = ?");
    $stmt->bind_param("i", $admin_id);

    if ($stmt->execute()) {
        $_SESSION['success'] = "Admin deleted successfully!";
    } else {
        $_SESSION['error'] = "Failed to delete admin.";
    }

    $stmt->close();
    $conn->close();

    header("Location: adminstaff.php");
    exit();

} else {
    $_SESSION['error'] = "Invalid delete request.";
    header("Location: adminstaff.php");
    exit();
}
?>