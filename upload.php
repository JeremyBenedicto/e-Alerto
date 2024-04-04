<?php
if (isset($_FILES['photo']) && $_FILES['photo']['error'] === UPLOAD_ERR_OK) {
    $upload_directory = 'uploads/';

    if (!file_exists($upload_directory)) {
        mkdir($upload_directory, 0777, true);
    }

    $uploaded_file = $upload_directory . basename($_FILES['photo']['name']);
    if (move_uploaded_file($_FILES['photo']['tmp_name'], $uploaded_file)) {
        $db_host = 'localhost';
        $db_username = 'root';
        $db_password = '';
        $db_name = 'user_db';

        $conn = new mysqli($db_host, $db_username, $db_password, $db_name);
        if ($conn->connect_error) {
            die('Connection failed: ' . $conn->connect_error);
        }

        $photo_path = $uploaded_file;
        $photo_type = $_FILES['photo']['type'];

        $sql = "INSERT INTO photos (photo_path, photo_type) VALUES ('$photo_path', '$photo_type')";
        if ($conn->query($sql) === TRUE) {
            echo 'Photo uploaded successfully';
        } else {
            echo 'Error uploading photo: ' . $conn->error;
        }

        $conn->close();
    } else {
        echo 'Error moving uploaded file';
    }
} else {
    echo 'Error uploading photo';
}
?>