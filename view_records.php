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
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600&display=swap');

        *{
   font-family: 'Poppins', sans-serif;}

        table {
            width: 100%;
            border-collapse: collapse;
        }

        table, th, td {
            border: 1px solid black;
            padding: 8px;
        }

        th {
            background-color: #f2f2f2;
        }

        img {
            max-width: 100px;
            max-height: 100px;
        }
        .x-button {
    background-color: #4caf4f00;
    color: rgb(118, 118, 118);
    border: none;
    border-radius: 4px;
    font-size: 16px;
    cursor: pointer;
    display: flex;
    text-decoration: none;
    justify-content: start;
    align-items: end;
  }
  .x-button i{
    font-size:2rem;
  }
    </style>
</head>
<body>
<a href="admin_interface.php" class="x-button">
  <i class="fas fa-times"></i></a>
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
                echo "<td>{$row['mobile_number']}</td>";
                echo "<td><img src='image_accident/{$row['image']}' alt='Accident Image'></td>";
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>
</body>
</html>
