<?php
include 'php/config.php';

// Fetch messages with user details
$messages_query = mysqli_query($conn, "SELECT messages.*, user_form.firstname, user_form.lastname, user_form.image
FROM messages 
INNER JOIN user_form ON messages.user_id = user_form.id 
ORDER BY messages.timestamp DESC") or die('Message query failed');

// Fetch user locations
$locations_query = mysqli_query($conn, "SELECT user_id, latitude, longitude FROM user_locations") or die('Location query failed');
$locations = array();
while ($location_row = mysqli_fetch_assoc($locations_query)) {
    $locations[$location_row['user_id']] = array(
        'latitude' => $location_row['latitude'],
        'longitude' => $location_row['longitude']
    );
}

// Check if messages exist
if (mysqli_num_rows($messages_query) > 0) {
    while ($row = mysqli_fetch_assoc($messages_query)) {
        $sorted_messages[] = $row;
    }
    usort($sorted_messages, function ($a, $b) {
        return strtotime($b['timestamp']) - strtotime($a['timestamp']);
    });
    foreach ($sorted_messages as $message) {
        echo "<div class='message-item'>";
        echo "<div class='d'>";
        echo "<img src='uploaded_img/" . $message['image'] . "' alt='Profile Image'>";
        echo "<div class='des'>";
        echo "<p><strong>" . $message['firstname'] . " " . $message['lastname'] . "</strong></p>";
        echo "<p style='background-color:#DEDDDD;padding:1rem;border-radius:10px;'><strong></strong> " . $message['message'] . "</p>";
        echo "<p><strong></strong> " . $message['timestamp'] . "</p>";      
        echo "</div>";
        echo "<div class='is'>";
     
        echo "<form method='post' action='save_response.php'>";
        
        echo "<input type='hidden' name='user_id' value='" . $message['user_id'] . "'>";
        echo "<button type='submit' name='response_submit'><i class='fa-solid fa-paper-plane'></i></button>";
        echo "</form>";
        echo "</div>";
        echo "</div>";
        echo "<div class='de'>";
        if (isset($locations[$message['user_id']])) {
            $location = $locations[$message['user_id']];
            
            echo "<iframe width='100%' height='250' frameborder='0' scrolling='no' marginheight='0' marginwidth='0' src='https://www.openstreetmap.org/export/embed.html?bbox=" . ($location['longitude'] - 0.01) . "," . ($location['latitude'] - 0.01) . "," . ($location['longitude'] + 0.01) . "," . ($location['latitude'] + 0.01) . "&amp;layer=mapnik&amp;marker=" . $location['latitude'] . "," . $location['longitude'] . "'></iframe><br/>";
        } else {
            echo "<p><strong>Location:</strong> Location not available</p>";
        }
        
        echo "</div>";
        echo "</div>";
    }
} else {
    echo "No messages found.";
}
?>
