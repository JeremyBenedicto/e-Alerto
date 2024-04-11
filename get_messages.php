<?php
include 'php/config.php';

$html = '';
$emergency_messages_query = mysqli_query($conn, "SELECT messages.*, user_form.firstname, user_form.lastname, user_form.image
                                                FROM messages 
                                                INNER JOIN user_form ON messages.user_id = user_form.id 
                                                ORDER BY messages.timestamp DESC") or die('Query failed');

if (mysqli_num_rows($emergency_messages_query) > 0) {
    while ($row = mysqli_fetch_assoc($emergency_messages_query)) {
        $html .= "<div class='message-item'>";
        $html .= "<img src='uploaded_img/" . $row['image'] . "' alt='Profile Image'>";
        $html .= "<div class='des'>";
        $html .= "<p><strong>" . $row['firstname'] . " " . $row['lastname'] . "</strong></p>";
        $html .= "<p><strong>Message:</strong> " . $row['message'] . "</p>";
        $html .= "<p><strong>Timestamp:</strong> " . $row['timestamp'] . "</p>";
        $html .= "<a href='login.php'>Response</a>";
        $html .= "</div>";
        $html .= "</div>";
    }
} else {
    $html = "<p>No emergency messages found.</p>";
}

echo $html;
?>
