<?php
include 'php/config.php';
session_start();
$user_id = $_SESSION['user_id'];

if (!isset($user_id)) {
    // Handle unauthorized access
    exit();
}


// Retrieve sender's location from the database
$sql = "SELECT user_id, latitude, longitude FROM user_locations ORDER BY id DESC LIMIT 1";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Output data of the latest row
    $row = $result->fetch_assoc();
    $location = array(
        "latitude" => $row["latitude"],
        "longitude" => $row["longitude"]
    );
    echo json_encode($location);
} else {
    echo "No location found.";
}

$conn->close();
?>
