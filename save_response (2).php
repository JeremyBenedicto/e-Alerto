<?php
include 'php/config.php';

if(isset($_POST['response_submit'])) {
    $user_id = $_POST['user_id'];
    $thank_you_message = "Thank you for your valuable report. We appreciate your message and will take the necessary actions.";
    
    $insert_query = "INSERT INTO admin_response (user_id, message) VALUES ('$user_id', '$thank_you_message')";
    if(mysqli_query($conn, $insert_query)) {
        header("Location: admin_interface.php?response=success");
        exit;
        echo "<script>var success = true;</script>";
    } else {

        echo "<script>var success = false;</script>";
        echo "<script>var errorMessage = '" . mysqli_error($conn) . "';</script>";
    }
}

?>
<script>

if (typeof success !== 'undefined') {
    if (success) {

        alert("Response sent successfully.");
        window.location.href = "admin_interface.php";
    } else {

        alert("Error: " + errorMessage);
    }
}
</script>
