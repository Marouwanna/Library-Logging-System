<?php
session_start();

include '../connnect.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <link rel="stylesheet" href="../CSS/admin.css">

</head>
<body>

<div class="login-container">

    <h2>Admin Login</h2>

    <form action="../Assets/admin-verification.php" method="POST" id="admin-form">

        <div class="input-group">
            <label>Username</label>
            <input type="text" name="username" id="username" required>
        </div>

        <div class="input-group">
            <label>Password</label>
            <input type="password" name="password" id="password" required>
        </div>

        <button type="submit" class="submit-btn">
            Login
        </button>

        <p id="admin-message"></p>
        
    </form>

</div>

<script src="../JS/admin.js"></script>

</body>
</html>