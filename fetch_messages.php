<?php
include 'php/config.php';

// Fetch chat messages from the database
$messages_query = mysqli_query($conn, "SELECT messages.*, user_form.firstname, user_form.lastname, user_form.image
FROM messages 
INNER JOIN user_form ON messages.user_id = user_form.id 
ORDER BY messages.timestamp DESC") or die('Query failed');

$sorted_messages = array();
         if (mysqli_num_rows($messages_query) > 0) {
            while ($row = mysqli_fetch_assoc($messages_query)) {
               $sorted_messages[] = $row;
            }
            usort($sorted_messages, function($a, $b) {
               return strtotime($b['timestamp']) - strtotime($a['timestamp']);
            });
            foreach ($sorted_messages as $message) {
               echo "<div class='message-item'>";
               echo "<img src='uploaded_img/" . $message['image'] . "' alt='Profile Image'>";
               echo "<div class='des'>";
               echo "<p><strong>" . $message['firstname'] . " " . $message['lastname'] . "</strong></p>";
               echo "<p><strong>Message:</strong> " . $message['message'] . "</p>";
               echo "<p><strong>Timestamp:</strong> " . $message['timestamp'] . "</p>";
               echo "<a href='login.php'>Response</a>";
               echo "<div id='map'></div>";
               echo "</div>";
               echo "</div>";
            }
         } else {
            
         }
// Display fetched messages
while ($row = mysqli_fetch_assoc($messages_query)) {
    echo "<p><strong>" . $row['firstname'] . ":</strong> " . $row['message'] . "</p>";
}
?>
