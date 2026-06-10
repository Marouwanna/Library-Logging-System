<?php
session_start();
include("../connnect.php");

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $admin_id = $_POST['admin_id'];

    $fields = [];
    $params = [];
    $types = "";

    // Username
    if(!empty($_POST['username'])){
        $fields[] = "username = ?";
        $params[] = $_POST['username'];
        $types .= "s";
    }

    // Password (only if not empty)
    if(!empty($_POST['password'])){
        $password = ($_POST['password']);
        $fields[] = "password = ?";
        $params[] = $password;
        $types .= "s";
    }

    // If nothing to update
    if(empty($fields)){
        $_SESSION['error'] = "No changes made.";
        header("Location: adminstaff.php");
        exit();
    }

    $sql = "UPDATE staff SET " . implode(", ", $fields) . " WHERE id = ?";
    $params[] = $admin_id;
    $types .= "i";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param($types, ...$params);

    if ($stmt->execute()) {
        $_SESSION['success'] = "User updated successfully!";
    } else {
        $_SESSION['error'] = "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();

    header("Location: adminstaff.php");
    exit();
} else {
    header("Location: adminstaff.php");
    exit();
}

?>