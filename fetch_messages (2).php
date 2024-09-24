<?php
include 'php/config.php';

// Query to get all messages with user info, ordered by timestamp
$messages_query = mysqli_query($conn, "
    SELECT messages.*, user_form.firstname, user_form.lastname, user_form.image
    FROM messages 
    INNER JOIN user_form ON messages.user_id = user_form.id 
    ORDER BY messages.timestamp DESC
") or die('Message query failed');

// Query to get user locations
$locations_query = mysqli_query($conn, "SELECT user_id, latitude, longitude FROM user_locations") or die('Location query failed');
$locations = array();
while ($location_row = mysqli_fetch_assoc($locations_query)) {
    $locations[$location_row['user_id']] = array(
        'latitude' => $location_row['latitude'],
        'longitude' => $location_row['longitude']
    );
}

// Initialize an array to track displayed users
$displayed_users = array();
?>

<head>
    <link rel="stylesheet" href="css/fetch.css">
</head>

<div class="chat-container">

<?php
if (mysqli_num_rows($messages_query) > 0) {
    // Loop through messages
    while ($message = mysqli_fetch_assoc($messages_query)) {
        // Only display the user if they haven't been displayed yet
        if (!in_array($message['user_id'], $displayed_users)) {
            // Add user to the displayed_users array
            $displayed_users[] = $message['user_id'];
            
            echo "<div class='message-item'>";
            
            // Display the user profile header
            echo "<div class='message-header'>";
            echo "<a href='user_chat.php?user_id=" . $message['user_id'] . "' class='user-profile'>";
            echo "<img src='uploaded_img/" . $message['image'] . "' alt='Profile Image' class='profile-img'>";
            echo "<div class='username'>" . $message['firstname'] . " " . $message['lastname'] . "</div>";
            echo "</a>";
            echo "</div>";

            // Display the latest message
            echo "<div class='message-bubble'>";
            echo "<p>" . $message['message'] . "</p>";
            echo "<span class='timestamp'>" . date("H:i", strtotime($message['timestamp'])) . "</span>";
            echo "</div>";

            // Display the user's location if available
            if (isset($locations[$message['user_id']])) {
                $location = $locations[$message['user_id']];
                echo "<iframe class='map-frame' src='https://www.openstreetmap.org/export/embed.html?bbox=" . ($location['longitude'] - 0.01) . "," . ($location['latitude'] - 0.01) . "," . ($location['longitude'] + 0.01) . "," . ($location['latitude'] + 0.01) . "&amp;layer=mapnik&amp;marker=" . $location['latitude'] . "," . $location['longitude'] . "'></iframe>";
            }
            
            echo "</div>";
        }
    }
} else {
    echo "No messages found.";
}
?>

</div>
