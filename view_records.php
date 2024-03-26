<?php
include 'config.php';

$query = "SELECT * FROM `accident_record`";
$result = mysqli_query($conn, $query);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Accident Records</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" 
                        integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" 
                        crossorigin="anonymous" 
                        referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="css/viewrecord.css">
</head>

<body>
        <div class="tab">
            <a href="admin_interface.php" class="x-button">
                <img style="height: 30px;" src="assets/icon/left-arrow.png" alt=""></i></a>
            <h2>Accident Records</h2>
            <table>
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Name</th>
                        <th>Age</th>
                        <th>Address</th>
                        <th>Location</th>
                        <th>Sex</th>
                        <th>Vehicle Type</th>
                        <th>Date</th>
                        <th>Mobile Number</th>
                        <th>Image</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
                        echo "<td>{$row['accident_id']}</td>";
                        echo "<td>{$row['name']}</td>";
                        echo "<td>{$row['age']}</td>";
                        echo "<td>{$row['address']}</td>";
                        echo "<td>{$row['location']}</td>";
                        echo "<td>{$row['sex']}</td>";
                        echo "<td>{$row['vehicle_type']}</td>";
                        echo "<td>{$row['date']}</td>";
                        echo "<td>{$row['mobile_number']}</td>";
                        echo "<td><img src='image_accident/{$row['image']}' alt='Accident Image'></td>";
                        echo "</tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
</body>

</html>