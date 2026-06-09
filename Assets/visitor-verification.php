<?php
date_default_timezone_set('Asia/Manila');

header('Content-Type: application/json');
include '../connnect.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['success' => false, 'message' => 'Method not allowed']);
    exit;
}

$cardID = trim($_POST['cardID'] ?? '');

// format check
if (empty($cardID) || !preg_match('/^\d{6}$/', $cardID)) {
    echo json_encode(['success' => false, 'message' => 'Invalid card format. Use 123456.']);
    exit;
}

try {

    $check = $conn->prepare("
    SELECT id 
    FROM library_visitors 
    WHERE library_card = ?
    LIMIT 1
    ");

    $check->bind_param("s", $cardID);
    $check->execute();
    $result = $check->get_result();

    if ($result->num_rows === 0) {
        echo json_encode([
            'success' => false,
            'message' => 'Card not registered'
        ]);
        exit;
    }

    $check->close();

    $stmt = $conn->prepare("
    SELECT id, library_card, time_in, time_out
    FROM visitor_log
    WHERE library_card = ? AND DATE(time_in) = CURDATE() AND time_out IS NULL
    ORDER BY time_in DESC
    LIMIT 1
    ");

    $stmt->bind_param('s', $cardID);
    $stmt->execute();
    $result = $stmt->get_result();
    $last = $result->fetch_assoc();
    $stmt->close();

    if (!$last) {

        // TIME IN
        $insert = $conn->prepare("
            INSERT INTO visitor_log (library_card, time_in)
            VALUES (?, NOW())
        ");

        $insert->bind_param('s', $cardID);
        $insert->execute();
        $insert->close();

        echo json_encode([
            'success' => true,
            'message' => "Timed IN at " . date('g:i A'),
            'event' => 'IN',
            'time' => date('Y-m-d H:i:s')
        ]);

    } else {
        
        // TIME OUT
        $update = $conn->prepare("
        UPDATE visitor_log
        SET time_out = NOW()
        WHERE id = ?
        ");

        $update->bind_param('i', $last['id']);
        $update->execute();
        $update->close();

        echo json_encode([
            'success' => true,
            'message' => "Timed OUT at " . date('g:i A'),
            'event' => 'OUT',
            'time' => date('Y-m-d H:i:s')
        ]);
    }

} catch (Exception $e) {
    echo json_encode([
        'success' => false,
        'message' => 'Database error: ' . $e->getMessage()
    ]);
}
?>