<?php
session_start();



include("../connnect.php");

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $card_number = trim($_POST['card']);

    if (empty($card_number)) {
    $_SESSION['error'] = "Card number is required.";
    header("Location: librarycard.php");
    exit();
    }

    // duplicate check
    $check = $conn->prepare(
        "SELECT id FROM library_visitors WHERE library_card = ?"
    );
    $check->bind_param("s", $card_number);
    $check->execute();

    $check->store_result();

    if ($check->num_rows > 0) {
        $_SESSION['error'] = "Library card already exists.";
        $check->close();
        header("Location: librarycard.php");
        exit();
    }

    $stmt = $conn->prepare("INSERT INTO library_visitors (library_card) VALUES (?)");
    $stmt->bind_param("s", $card_number);   

    if ($stmt->execute()) {
        $_SESSION['success'] = "Card added successfully!";
        $stmt->close();
        $conn->close();

        header("Location: librarycard.php");
        exit();
    } else {
        $_SESSION['error'] = "Error: " . $stmt->error;
        $stmt->close();
        $conn->close();

        header("Location: librarycard.php");
        exit(); 
    }
    
} else {
    header("Location: librarycard.php");
    exit();
}
?>