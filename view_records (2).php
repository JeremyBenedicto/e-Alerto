<?php
// Database connection
$conn = new mysqli("localhost", "root", "", "user_db");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Query to select only the needed records from the injury_form table
$sql = "SELECT id, name, age, sex, civil_status, accident_mark FROM injury_form";
$result = $conn->query($sql);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Injury Records</title>
    <link rel="stylesheet" href="css/view_records.css"> <!-- Link to the CSS file -->
</head>
<body>
    <div class="container">
    <div class="back-button">
      <a href="admin_interface.php" class="btn">
         <img src="assets/icon/left-arrow.png" alt="Back">
      </a>
   </div>
        <h1>Injury Records</h1>
        <table>
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Age</th>
                    <th>Sex</th>
                    <th>Civil Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . htmlspecialchars($row['name']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['age']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['sex']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['civil_status']) . "</td>";
                        echo "<td><a href='view_details.php?id=" . htmlspecialchars($row['id']) . "' class='view-details-button'>View Details</a></td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='6'>No records found</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>

<?php
$conn->close();
?>
