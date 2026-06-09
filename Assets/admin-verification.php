<?php
date_default_timezone_set('Asia/Manila');

session_start();
header('Content-Type: application/json');

include '../connnect.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['success' => false, 'message' => 'Method not allowed']);
    exit;
}

$username = trim($_POST['username'] ?? '');
$password = $_POST['password'] ?? '';

if (empty($username) || empty($password)) {
    echo json_encode(['success' => false, 'message' => 'Username and password are required']);
    exit;
}

if (strlen($username) < 3) {
    echo json_encode(['success' => false, 'message' => 'Invalid username or password']);
    exit;
}

if (strlen($password) < 6) {
    echo json_encode(['success' => false, 'message' => 'Invalid username or password']);
    exit;
}

try {
    $query = "SELECT id, username, password FROM staff WHERE username = ?";
    $stmt = $conn->prepare($query);
    
    if (!$stmt) {
        throw new Exception("Database error: " . $conn->error);
    }
    
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows === 0) {
        echo json_encode(['success' => false, 'message' => 'Invalid username or password']);
        exit;
    }
    
    $admin = $result->fetch_assoc();
    $stmt->close();
    
    if ($password === $admin['password']) {

    $_SESSION['admin_id'] = $admin['id'];
    $_SESSION['admin_username'] = $admin['username'];

    $timeIn = date('Y-m-d H:i:s');

    $logStmt = $conn->prepare("
        INSERT INTO staff_log (username, time_in)
        VALUES (?, ?)
    ");

    $logStmt->bind_param(
        "ss",
        $admin['username'],
        $timeIn
    );

    $logStmt->execute();

    $_SESSION['log_username'] = $admin['username'];
    $_SESSION['time_in'] = $timeIn;

    echo json_encode([
        'success' => true,
        'message' => 'Login successful',
        'redirect' => '../ADMIN/admin-dashboard.php'
    ]);

    exit;

    } else {

        echo json_encode([
            'success' => false,
            'message' => 'Invalid username or password'
        ]);
    }
    
} catch (Exception $e) {
    echo json_encode(['success' => false, 'message' => 'An error occurred: ' . $e->getMessage()]);
}
?>