<?php
session_start();
include("../connnect.php");

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $admin_name = trim($_POST['username']);
    $password = trim($_POST['password']);

    if (empty($admin_name)) {
    $_SESSION['error'] = "Username is required.";
    header("Location: librarycard.php");
    exit();
    }

    // duplicate check
    $check = $conn->prepare("SELECT id FROM staff WHERE username = ?");
    $check->bind_param("s", $admin_name);
    $check->execute();

    $check->store_result();

    if ($check->num_rows > 0) {
        $_SESSION['error'] = "Admin already exists.";
        $check->close();
        header("Location: adminstaff.php");
        exit();
    }

    $stmt = $conn->prepare("INSERT INTO staff (username, password) VALUES (?, ?)");
    $stmt->bind_param("ss", $admin_name, $password);   

    if ($stmt->execute()) {
        $_SESSION['success'] = "Admin added successfully!";
        $stmt->close();
        $conn->close();

        header("Location: adminstaff.php");
        exit();
    } else {
        $_SESSION['error'] = "Error: " . $stmt->error;
        $stmt->close();
        $conn->close();

        header("Location: adminstaff.php");
        exit(); 
    }
    
} else {
    header("Location: adminstaff.php");
    exit();
}
?>