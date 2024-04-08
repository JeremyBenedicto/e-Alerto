<?php
include 'php/config.php';
session_start();
$user_id = $_SESSION['user_id'];

if (!isset($user_id)) {
    // Handle unauthorized access
    exit();
}

if (isset($_POST['message']) && !empty($_POST['message'])) {
    $message = mysqli_real_escape_string($conn, $_POST['message']);

    $insert_query = mysqli_query($conn, "INSERT INTO messages (user_id, message) VALUES ('$user_id', '$message')");

    if ($insert_query) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Failed to insert message']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Message is required']);
}
?>
