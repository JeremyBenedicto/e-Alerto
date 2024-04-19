<?php
include 'php/config.php';

if(isset($_POST['response_submit'])) {
    $user_id = $_POST['user_id'];
    $thank_you_message = "Thank you for your valuable feedback. We appreciate your report and will take the necessary actions.";
    
    // Insert the thank you message into admin_response table
    $insert_query = "INSERT INTO admin_response (user_id, message) VALUES ('$user_id', '$thank_you_message')";
    if(mysqli_query($conn, $insert_query)) {
        echo "Thank you message saved successfully.";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>
