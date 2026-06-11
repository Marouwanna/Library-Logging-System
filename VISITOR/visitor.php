<?php
include '../connnect.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Library Logging System</title>
    <link rel="stylesheet" href="../CSS/visitors.css">
</head>
<body>

    <div class="login-container">
        <div class="login-header">
            <h2>Welcome to the Library</h2>
            <p>Please scan or enter your Library Card ID to log your visit.</p>
        </div>
        
        <form action="../Assets/visitor-verification.php" method="POST" id="logging-form" autocomplete="off">
            <div class="input-group">
                <label for="library-card-input">Library Card ID</label>
                <input
                    class="field"
                    type="text" 
                    name="cardID"
                    id="library-card-input" 
                    placeholder="e.g., 123456" 
                    required 
                    autofocus
                >
                <span class="error-message" id="error-msg">Please use format: 123456</span>
            </div>
            
            <button type="submit" class="submit-btn">Submit</button>
        </form>
        
        <div class="status-box hidden" id="status-box">
            <p id="status-message">Welcome back!</p>
            <p>Card: <span id="user-name">User</span></p>
        </div>
    </div>

    <script src="../JS/visitor.js"></script>    
</body>
</html>