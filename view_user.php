<?php

// Include the config file for database connection
include 'php/config.php';

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
         $id_photo = $row['id_photo'] ? 'uploaded_img/'.$row['id_photo'] : 'default-id.jpg';
         echo "<strong>ID/Valid Photo:</strong> <img src='$id_photo' alt='ID/Valid Photo' class='id-img'>";
         ?>
      </div>
   </div>
</div>

</body>
</html>
