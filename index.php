<?php
$db_host = 'localhost';
$db_username = 'root';
$db_password = '';
$db_name = 'user_db';

$conn = new mysqli($db_host, $db_username, $db_password, $db_name);
if ($conn->connect_error) {
    die('Connection failed: ' . $conn->connect_error);
}

// If a photo is requested to be deleted
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete_id'])) {
    $delete_id = $_POST['delete_id'];
    if (is_numeric($delete_id)) {
        $sql_delete = "DELETE FROM photos WHERE photo_id = ?";
        $stmt = $conn->prepare($sql_delete);
        $stmt->bind_param("i", $delete_id);
        if ($stmt->execute()) {
            echo "";
        } else {
            echo "Error deleting photo: " . $conn->error;
        }
        $stmt->close();
    } else {
        echo "Invalid photo ID";
    }
}


$sql = "SELECT photo_id, photo_path, photo_type FROM photos";
$result = $conn->query($sql);

$photos = array();
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $photos[] = $row;
    }
}

// Close connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Photo Upload</title>
<link rel="stylesheet" href="css/index.css">

</head>
<body>
    <div class="con">
    <a href="admin_interface.php" class="x-button">
                <img style="height: 30px;" src="assets/icon/left-arrow.png" alt=""></i></a>
<div class="upload1">
    <h1>Upload Photo</h1>
    <label for="photo" class="upload-btn">Choose Photo</label>
    <form id="uploadForm" enctype="multipart/form-data">
        <input type="file" name="photo" id="photo">
        <button type="submit" id="uploadButton">Upload</button>
    </form>
    <div id="message"></div>
</div>
</div>

<div class="tab">
        <div class="d">
            <h2>Uploaded Photos</h2>
        </div>
        <table>
            <tr>
                <th>Photo Path</th>
                <th>Photo Type</th>
                <th>Photo</th>
                <th>Action</th>
            </tr>
            <?php foreach ($photos as $photo) : ?>
                <tr>
                    <td><?php echo $photo['photo_path']; ?></td>
                    <td><?php echo $photo['photo_type']; ?></td>
                    <td><img src="<?php echo $photo['photo_path']; ?>" alt="Uploaded Photo"></td>
                    <td>
                        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                            <input type="hidden" name="delete_id" value="<?php echo $photo['photo_id']; ?>">
                            <button type="submit" class="delete-btn">Delete</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
    </div>
<script src="javascript/photo_index.js"></script>
</body>
</html>
