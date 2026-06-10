<?php
session_start();


include("../connnect.php");

if (isset($_GET['id'])) {

    $card_id = $_GET['id'];

    $stmt = $conn->prepare("DELETE FROM library_visitors WHERE id = ?");
    $stmt->bind_param("i", $card_id);

    if ($stmt->execute() && $stmt->affected_rows > 0) {
        $_SESSION['success'] = "Card deleted successfully!";
    } else {
        $_SESSION['error'] = "Card not found or failed to delete.";
    }

    $stmt->close();
    $conn->close();

    header("Location: librarycard.php");
    exit();

} else {
    $_SESSION['error'] = "Invalid delete request.";
    header("Location: librarycard.php");
    exit();
}
?>