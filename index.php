<?php
include 'connnect.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Library Logging System</title>
    <link rel="stylesheet" href="CSS/landing.css">
</head>
<body>
    
    <div class="landing-container">
        <h1>Library Logging System</h1>
        <p>Select User Type</p>

        <div class="button-group">
            <a href="VISITOR/visitor.php" class="landing-btn">Visitor</a>
            <a href="ADMIN/admin.php" class="landing-btn admin-btn">Staff / Admin</a>
        </div>
    </div>

</body>
</html>