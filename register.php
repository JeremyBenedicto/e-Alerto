<?php

// Include the config file for database connection
include 'php/config.php';

if(isset($_POST['submit'])){

   // Capture form data and sanitize it to prevent SQL injection
   $firstname = mysqli_real_escape_string($conn, $_POST['firstname']);
   $middlename = mysqli_real_escape_string($conn, $_POST['middlename']);
   $lastname = mysqli_real_escape_string($conn, $_POST['lastname']);
   $age = mysqli_real_escape_string($conn, $_POST['age']);
   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $cpnum = mysqli_real_escape_string($conn, $_POST['cpnum']);
   $password = mysqli_real_escape_string($conn, md5($_POST['password']));
   $cpassword = mysqli_real_escape_string($conn, md5($_POST['cpassword']));
   $address = mysqli_real_escape_string($conn, $_POST['address']);
   $gender = mysqli_real_escape_string($conn, $_POST['gender']);
   $image = $_FILES['image']['name'];
   $image_size = $_FILES['image']['size'];
   $image_tmp_name = $_FILES['image']['tmp_name'];
   $image_folder = 'uploaded_img/'.$image;

   // Handle ID photo upload
   if(isset($_FILES['validphoto']) && $_FILES['validphoto']['error'] === UPLOAD_ERR_OK) {
       $id_photo = $_FILES['validphoto']['name'];
       $id_photo_tmp_name = $_FILES['validphoto']['tmp_name'];
       $id_photo_folder = 'uploaded_img/'.$id_photo;
       move_uploaded_file($id_photo_tmp_name, $id_photo_folder);
   } else {
       $id_photo = ''; // No photo uploaded
   }

   // Generate a unique ID
   $unique_id = mt_rand(100000, 999999);

   // Check for uniqueness of the ID
   $check_unique_id = mysqli_query($conn, "SELECT unique_id FROM `pendingUser` WHERE unique_id = '$unique_id'");
   while(mysqli_num_rows($check_unique_id) > 0) {
       $unique_id = mt_rand(100000, 999999);
       $check_unique_id = mysqli_query($conn, "SELECT unique_id FROM `pendingUser` WHERE unique_id = '$unique_id'");
   }

   // Check if the email already exists in the database
   $select = mysqli_query($conn, "SELECT * FROM `pendingUser` WHERE email = '$email'") or die('Query failed');

   if(mysqli_num_rows($select) > 0){
      $message[] = 'User already exists'; 
   } else {
      // Validate password match and image size
      if($password != $cpassword){
         $message[] = 'Confirm password not matched!';
      } elseif($image_size > 2000000){
         $message[] = 'Image size is too large!';
      } else {
         $status = "Active now";
         // Insert the user data into the pendingUser table
         $insert = mysqli_query($conn, "INSERT INTO `pendingUser`(unique_id, firstname, middlename, lastname, age, email, cpnum, password, address, gender, image, id_photo, status)
          VALUES('$unique_id', '$firstname', '$middlename', '$lastname', '$age', '$email', '$cpnum', '$password', '$address', '$gender', '$image', '$id_photo', '$status')") or die('Query failed');

         // If insertion is successful, move the uploaded profile image
         if($insert){
            move_uploaded_file($image_tmp_name, $image_folder);
            $message[] = 'Registered successfully!';
            header('location: login.php');
         } else {
            $message[] = 'Registration failed!';
         }
      }
   }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Register</title>

   <!-- Custom CSS file link  -->
   <link rel="stylesheet" href="css/style.css">
</head>
<body>
   
<div class="form-container">

   <form action="" method="post" enctype="multipart/form-data">
      <h3>Register Now</h3>
      <?php
      if(isset($message)){
         foreach($message as $msg){
            echo '<div class="message">'.$msg.'</div>';
         }
      }
      ?>
      <div class="pi">
         <label for="image" class="r">
            <span class="upload-icon">&#x21ea;</span>
            <span class="text">Upload Profile Picture</span>
            <input type="file" id="image" name="image" accept="image/jpg, image/jpeg, image/png" class="b">
         </label>
      </div>
      <input type="text" name="firstname" placeholder="Enter First Name" class="box" required>
      <input type="text" name="middlename" placeholder="Enter Middle Name" class="box" required>
      <input type="text" name="lastname" placeholder="Enter Last Name" class="box" required>
      <input type="number" name="age" placeholder="Enter Age" class="box" required>
      <input type="number" name="cpnum" placeholder="Enter Contact Number" class="box" required>
      <input type="email" name="email" placeholder="Enter Email" class="box" required>
      <input type="password" name="password" placeholder="Enter Password" class="box" required>
      <input type="password" name="cpassword" placeholder="Confirm Password" class="box" required>
      <input type="text" name="address" placeholder="Street/Barangay" class="box" required>
      <select name="gender" class="box" required>
         <option value="">Select Gender</option>
         <option value="Male">Male</option>
         <option value="Female">Female</option>
      </select>
      <div class="pii">
         <label for="validphoto" class="d">
            <span class="upload-icon">&#x21ea;</span>
            <span class="text">Upload ID or Valid Identification</span>
            <input type="file" id="validphoto" name="validphoto" accept="image/jpg, image/jpeg, image/png" class="b">
         </label>
      </div>
      <input type="submit" name="submit" value="Register Now" class="btn">
      <p>Already have an account? <a href="login.php">Login Now</a></p>
   </form>

</div>
<script src="javascript/java.js"></script>
</body>
</html>
