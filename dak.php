<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Notification Button</title>
<style>
    /* Style the button */
    .button {
        background-color: #4CAF50; /* Green */
        border: none;
        color: white;
        padding: 15px 32px;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        font-size: 16px;
        margin: 4px 2px;
        cursor: pointer;
    }

    /* Style the notification */
    .notification {
        display: none;
        background-color: #555;
        color: #fff;
        text-align: center;
        padding: 16px;
        position: fixed;
        top: 0;
        right: 0;
        width: 300px;
        z-index: 1;
    }
</style>
</head>
<body>

<!-- Button to trigger the notification -->
<form method="post">
    <button class="button" type="submit" name="notify">Click Me</button>
</form>

<!-- The notification -->
<div id="notification" class="notification">
    <span id="notificationText"><?php echo isset($notificationMessage) ? $notificationMessage : ''; ?></span>
</div>

<?php
// Check if the button is clicked
if (isset($_POST['notify'])) {
    // Display the notification
    $notificationMessage = "This is a notification!";
}
?>

</body>
</html>
