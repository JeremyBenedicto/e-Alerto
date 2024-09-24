<?php
include 'php/config.php';

if (isset($_GET['user_id'])) {
    $user_id = $_GET['user_id'];

    // Fetch user details
    $user_query = mysqli_query($conn, "SELECT * FROM user_form WHERE id = '$user_id'") or die('User query failed');
    $user = mysqli_fetch_assoc($user_query);

    // Fetch latest location
    $location_query = mysqli_query($conn, "SELECT latitude, longitude FROM user_locations WHERE user_id = '$user_id' ORDER BY timestamp DESC LIMIT 1") or die('Location query failed');
    $location = mysqli_fetch_assoc($location_query);

    // Handle the form submission for the admin response
    if (isset($_POST['send_response'])) {
        $admin_message = mysqli_real_escape_string($conn, $_POST['admin_message']);
        $timestamp = date("Y-m-d H:i:s");

        // Insert the admin response into the database
        $insert_query = mysqli_query($conn, "INSERT INTO admin_response (user_id, message, timestamp) VALUES ('$user_id', '$admin_message', '$timestamp')") or die('Response insertion failed');

        if ($insert_query) {
            echo "<script>alert('Response sent successfully'); window.location.href = 'user_chat.php?user_id=$user_id';</script>";
        }
    }

    // Display user profile
    echo "<div class='chat-header'>";
    echo "<div class='back-button'>
        <a href='javascript:history.back()' class='btn'>
           <img src='assets/icon/left-arrow.png' alt='Back'>
        </a>
    </div>";
    echo "<img src='uploaded_img/" . $user['image'] . "' class='profile-img'>";
    echo "<h2>" . $user['firstname'] . " " . $user['lastname'] . "</h2>";
    echo "</div>";

    echo "<div class='chat-container'>";

    // Chat messages section with AJAX
    echo "<div id='chat-messages' class='chat-messages'>";
    // Messages will be loaded here via AJAX
    echo "</div>";

    // Location section on the right side
    echo "<div class='chat-location'>";
    if ($location) {
        echo "<h3>Latest User Location</h3>";
        echo "<iframe class='map-frame' src='https://www.openstreetmap.org/export/embed.html?bbox=" . ($location['longitude'] - 0.01) . "," . ($location['latitude'] - 0.01) . "," . ($location['longitude'] + 0.01) . "," . ($location['latitude'] + 0.01) . "&amp;layer=mapnik&amp;marker=" . $location['latitude'] . "," . $location['longitude'] . "'></iframe>";
    } else {
        echo "<p>Location not available</p>";
    }
    echo "</div>";

    // Admin response form
    echo "<div class='admin-response'>";
    echo "<form action='' method='POST'>";
    echo "<textarea name='admin_message' placeholder='Type your response here...' required></textarea>";
    echo "<button type='submit' name='send_response'>Send Response</button>";
    echo "</form>";
    echo "</div>";

    echo "</div>"; // End of chat-container

} else {
    echo "User ID not provided.";
}
?>
<head>
    <link rel="stylesheet" href="css/user-chat.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        // Function to load messages dynamically using AJAX
        function loadMessages() {
            var user_id = '<?php echo $user_id; ?>'; // Get user_id from PHP
            $.ajax({
                url: 'fetch_user_messages.php',
                type: 'GET',
                data: {user_id: user_id},
                success: function(response) {
                    $('#chat-messages').html(response); // Update the chat messages div with new messages
                }
            });
        }

        // Load messages every 5 seconds
        setInterval(loadMessages, 1000);

        // Load messages on page load
        $(document).ready(function() {
            loadMessages();
        });
    </script>
</head>
