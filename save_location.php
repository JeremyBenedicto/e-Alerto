<?php
include 'php/config.php';
session_start();
$user_id = $_SESSION['user_id'];

if (!isset($user_id)) {
    exit();
}


$latitude = $_POST["latitude"];
$longitude = $_POST["longitude"];


$sql = "INSERT INTO user_locations (user_id, latitude, longitude) VALUES ($user_id, $latitude, $longitude)";

if ($conn->query($sql) === TRUE) {
    echo "Location saved successfully.";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
$conn->close();
?>
