<?php
include 'php/config.php';

if (isset($_GET['user_id'])) {
    $user_id = $_GET['user_id'];

    // Fetch user messages
    $messages_query = mysqli_query($conn, "SELECT * FROM messages WHERE user_id = '$user_id' ORDER BY timestamp DESC") or die('Message query failed');

    if (mysqli_num_rows($messages_query) > 0) {
        while ($message = mysqli_fetch_assoc($messages_query)) {
            echo "<div class='message-item'>";
            echo "<div class='message-bubble'>";
            echo "<p>" . $message['message'] . "</p>";
            echo "<span class='timestamp'>" . date("H:i", strtotime($message['timestamp'])) . "</span>";
            echo "</div>";
            echo "</div>";
        }
    } else {
        echo "<p>No messages from this user.</p>";
    }
} else {
    echo "User ID not provided.";
}
?>
