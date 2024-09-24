<?php

// Include the config file for database connection
include 'php/config.php';

// Handle verification if the verify button is clicked
if (isset($_GET['verify_id'])) {
    $verify_id = $_GET['verify_id'];

    // Select the user's information from the pendingUser table
    $select_user_query = "SELECT * FROM `pendingUser` WHERE unique_id = '$verify_id'";
    $select_user_result = mysqli_query($conn, $select_user_query);

    if (mysqli_num_rows($select_user_result) > 0) {
        $user_data = mysqli_fetch_assoc($select_user_result);

        // Insert the user data into the user_form table
        $insert_user_query = "INSERT INTO `user_form` (unique_id, firstname, middlename, lastname, age, email, cpnum, password, address, gender, image, id_photo, status)
            VALUES ('" . $user_data['unique_id'] . "', '" . $user_data['firstname'] . "', '" . $user_data['middlename'] . "', '" . $user_data['lastname'] . "', '" . $user_data['age'] . "', '" . $user_data['email'] . "', '" . $user_data['cpnum'] . "', '" . $user_data['password'] . "', '" . $user_data['address'] . "', '" . $user_data['gender'] . "', '" . $user_data['image'] . "', '" . $user_data['id_photo'] . "', 'Active now')";

        $insert_result = mysqli_query($conn, $insert_user_query);

        // If the insertion is successful, delete the user from pendingUser
        if ($insert_result) {
            $delete_user_query = "DELETE FROM `pendingUser` WHERE unique_id = '$verify_id'";
            mysqli_query($conn, $delete_user_query);
            echo "<script>alert('User verified successfully!'); window.location.href = 'verify_user.php';</script>";
        } else {
            echo "<script>alert('Failed to verify the user!');</script>";
        }
    }
}

// Fetch all users from the pendingUser table
$query = "SELECT unique_id, firstname, middlename, lastname, image FROM `pendingUser`";
$result = mysqli_query($conn, $query);

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Verify Users</title>

   <!-- Link to external CSS file -->
   <link rel="stylesheet" href="css/verify_user.css">
</head>
<body>

<div class="header">
   <a href="admin_interface.php" class="back-button">
   <img src="assets/icon/left-arrow.png" alt="">
   </a>
   <h3>Pending User Verification</h3>
</div>

<div class="user-container">
   <table>
      <thead>
         <tr>
            <th>Profile Picture</th>
            <th>Full Name</th>
            <th>Action</th>
         </tr>
      </thead>
      <tbody>
         <?php
         if(mysqli_num_rows($result) > 0){
            while($row = mysqli_fetch_assoc($result)){
               $fullname = $row['firstname'] . ' ' . $row['middlename'] . ' ' . $row['lastname'];
               $image = $row['image'] ? 'uploaded_img/'.$row['image'] : '';
               $unique_id = $row['unique_id'];

               echo "<tr>";
               if ($image) {
                  echo "<td><img src='$image' alt='Profile Image'></td>";
               } else {
                  echo "<td><div class='default-image'>N/A</div></td>";
               }
               echo "<td>{$fullname}</td>";
               echo "<td>";
               echo "<a href='view_user.php?unique_id=$unique_id' class='btn'>View More Information</a> ";
               echo "<a href='verify_user.php?verify_id=$unique_id' style='background-color: green;' class='btn verify-btn'>Verify</a>";
               echo "</td>";
               echo "</tr>";
            }
         } else {
            echo "<tr><td colspan='3'>No pending users found</td></tr>";
         }
         ?>
      </tbody>
   </table>
</div>

</body>
</html>
