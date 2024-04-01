<?php

include 'php/config.php';

if(isset($_POST['submit'])){

   $firstname = mysqli_real_escape_string($conn, $_POST['firstname']);
   $middlename = mysqli_real_escape_string($conn, $_POST['middlename']);
   $lastname = mysqli_real_escape_string($conn, $_POST['lastname']);
   $age = mysqli_real_escape_string($conn, $_POST['age']);
   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $password = mysqli_real_escape_string($conn, md5($_POST['password']));
   $cpassword = mysqli_real_escape_string($conn, md5($_POST['cpassword']));
   $address = mysqli_real_escape_string($conn, $_POST['address']);
   $gender = mysqli_real_escape_string($conn, $_POST['gender']);
   $image = $_FILES['image']['name'];
   $image_size = $_FILES['image']['size'];
   $image_tmp_name = $_FILES['image']['tmp_name'];
   $image_folder = 'uploaded_img/'.$image;

   // Generate a unique random number
   $unique_id = mt_rand(100000, 999999);
   
   // Check if the generated random number already exists
   $check_unique_id = mysqli_query($conn, "SELECT unique_id FROM `user_form` WHERE unique_id = '$unique_id'");
   while(mysqli_num_rows($check_unique_id) > 0) {
       $unique_id = mt_rand(100000, 999999);
       $check_unique_id = mysqli_query($conn, "SELECT unique_id FROM `user_form` WHERE unique_id = '$unique_id'");
   }

   $select = mysqli_query($conn, "SELECT * FROM `user_form` WHERE email = '$email'") or die('Query failed');

   if(mysqli_num_rows($select) > 0){
      $message[] = 'User already exists'; 
   } else {
      if($password != $cpassword){
         $message[] = 'Confirm password not matched!';
      } elseif($image_size > 2000000){
         $message[] = 'Image size is too large!';
      } else {
         $status = "Active now";
         $insert = mysqli_query($conn, "INSERT INTO `user_form`(unique_id, firstname, middlename, lastname, age, email, password, address, gender, image, status)
          VALUES('$unique_id', '$firstname', '$middlename', '$lastname', '$age', '$email', '$password', '$address', '$gender', '$image','$status')") or die('Query failed');

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
      <input type="text" name="firstname" placeholder="Enter First Name" class="box" required>
      <input type="text" name="middlename" placeholder="Enter Middle Name" class="box" required>
      <input type="text" name="lastname" placeholder="Enter Last Name" class="box" required>
      <input type="number" name="age" placeholder="Enter Age" class="box" required>
      <input type="email" name="email" placeholder="Enter Email" class="box" required>
      <input type="password" name="password" placeholder="Enter Password" class="box" required>
      <input type="password" name="cpassword" placeholder="Confirm Password" class="box" required>
      <input type="text" name="address" placeholder="street/barangay" class="box" required>
      <select name="gender" class="box" required>
         <option value="">Select Gender</option>
         <option value="Male">Male</option>
         <option value="Female">Female</option>
      </select>
      <input type="file" name="image" class="box" accept="image/jpg, image/jpeg, image/png">
      <input type="submit" name="submit" value="Register Now" class="btn">
      <p>Already have an account? <a href="login.php">Login Now</a></p>
   </form>
      
</div>
<script src="javascript/java.js"></script>
</body>
</html>
