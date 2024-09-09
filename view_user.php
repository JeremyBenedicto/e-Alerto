<?php

// Include the config file for database connection
include 'php/config.php';

// Check if the verify button is clicked and verify_id is passed
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

// Check if the unique_id is passed via the URL
if(isset($_GET['unique_id'])){
   $unique_id = mysqli_real_escape_string($conn, $_GET['unique_id']);

   // Fetch the user's information from the pendingUser table
   $query = "SELECT * FROM `pendingUser` WHERE unique_id = '$unique_id'";
   $result = mysqli_query($conn, $query);

   // Check if the user exists
   if(mysqli_num_rows($result) > 0){
      $row = mysqli_fetch_assoc($result);
   } else {
      echo "User not found!";
      exit;
   }
} else {
   echo "No user selected!";
   exit;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>View User Information</title>

   <!-- Link to external CSS file -->
   <link rel="stylesheet" href="css/view_user.css">
</head>
<body>

<div class="user-info-container">
   <!-- Back Button placed at the top-left corner -->
   <div class="back-button">
      <a href="verify_user.php" class="btn">
         <img src="assets/icon/left-arrow.png" alt="Back">
      </a>
   </div>

   <h3>User Information</h3>
   <div class="profile">
      <?php
      $image = $row['image'] ? 'uploaded_img/'.$row['image'] : 'default.jpg';
      echo "<img src='$image' alt='Profile Image' class='profile-img'>";
      ?>
   </div>

   <div class="details">
      <p><strong>Full Name:</strong> <?php echo $row['firstname'] . ' ' . $row['middlename'] . ' ' . $row['lastname']; ?></p>
      <p><strong>Age:</strong> <?php echo $row['age']; ?></p>
      <p><strong>Email:</strong> <?php echo $row['email']; ?></p>
      <p><strong>Contact Number:</strong> <?php echo $row['cpnum']; ?></p>
      <p><strong>Address:</strong> <?php echo $row['address']; ?></p>
      <p><strong>Gender:</strong> <?php echo $row['gender']; ?></p>
      <div class="id-photo">
         <?php
         $id_photo = $row['id_photo'] ? 'uploaded_img/'.$row['id_photo'] : 'images/default-avatar.png';
         echo "<strong>ID/Valid Photo:</strong> <img src='$id_photo' alt='ID/Valid Photo' class='id-img'>";
         ?>
      </div>
   </div>

   <!-- Verify Button -->
   <div class="action-buttons">
   <a href="view_user.php?verify_id=<?php echo $row['unique_id']; ?>" class="btn verify-btn custom-verify-btn">Verify</a>
</div>


</div>


</body>
</html>
