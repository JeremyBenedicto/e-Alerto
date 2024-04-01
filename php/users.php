<?php
    session_start();
    include_once "config.php";
    $outgoing_id = $_SESSION['user_id'];
    // Exclude the user with email "admin@gmail.com" from the chat list
    $exclude_email = "admin@gmail.com";
    $sql = "SELECT * FROM user_form WHERE email != '{$exclude_email}' AND NOT unique_id = {$outgoing_id} ORDER BY id DESC";
    $query = mysqli_query($conn, $sql);
    $output = "";
    if(mysqli_num_rows($query) == 0){
        $output .= "No users are available to chat";
    }elseif(mysqli_num_rows($query) > 0){
        include_once "data.php";
    }
    echo $output;
?>
