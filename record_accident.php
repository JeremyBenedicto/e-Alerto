<?php

include 'config.php';

if(isset($_POST['submit'])){

   $name = mysqli_real_escape_string($conn, $_POST['name']);
   $age = mysqli_real_escape_string($conn, $_POST['age']);
   $address = mysqli_real_escape_string($conn, $_POST['address']);
   $location = mysqli_real_escape_string($conn, $_POST['location']);
   $sex = mysqli_real_escape_string($conn, $_POST['sex']);
   $vehicle_type = mysqli_real_escape_string($conn, $_POST['vehicle_type']);
   $mobile_number = mysqli_real_escape_string($conn, $_POST['mobile_number']);
   $image = $_FILES['image']['name'];
   $image_size = $_FILES['image']['size'];
   $image_tmp_name = $_FILES['image']['tmp_name'];
   $image_folder = 'image_accident/'.$image;

   $select = mysqli_query($conn, "SELECT * FROM `accident_record` WHERE mobile_number = '$mobile_number'") or die('Query failed');

   if(mysqli_num_rows($select) > 10){
      $message[] = 'Record already exists'; 
   } else {
      if($image_size > 2000000){
         $message[] = 'Image size is too large!';
      } else {
         $insert = mysqli_query($conn, "INSERT INTO `accident_record` (name, age, address, location, sex, vehicle_type, mobile_number, image)
          VALUES ('$name', '$age', '$address', '$location', '$sex', '$vehicle_type', '$mobile_number', '$image')") or die('Query failed');

         if($insert){
            move_uploaded_file($image_tmp_name, $image_folder);
            $message[] = 'Record added successfully!';
         } else {
            $message[] = 'Failed to add record!';
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
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" 
   integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" 
   crossorigin="anonymous" 
   referrerpolicy="no-referrer" /> 
   <title>Add Accident</title>
   <link rel="stylesheet" href="record_accident.css">

</head>
<body>
   
<div class="form-container">

   <form action="" method="post" enctype="multipart/form-data">
   <a href="admin_interface.php" class="x-button">
  <i class="fas fa-times"></i>
</a>
      <h3>Accident Record Form</h3>
      <?php
      if(isset($message)){
         foreach($message as $msg){
            echo '<div class="message">'.$msg.'</div>';
         }
      }
      ?>
      <input type="text" name="name" placeholder="Enter Name" class="box" required>
      <input type="number" name="age" placeholder="Enter Age" class="box" required>
      <input type="text" name="address" placeholder="Enter Address" class="box" required>
      <input type="text" name="location" placeholder="Enter Location" class="box" required>
      <select name="sex" class="box" required>
         <option value="">Select Sex</option>
         <option value="Male">Male</option>
         <option value="Female">Female</option>
      </select>
      <select name="vehicle_type" class="box" required>
         <option value="">Select Type of Vehicle</option>
         <option value="Bicycle">Bicycle</option>
         <option value="Motorcycle">Motorcycle</option>
         <option value="Tricycle">Tricycle</option>
         <option value="4 Wheel Vehicle">4 Wheel Vehicle</option>
      </select>
      <input type="text" name="mobile_number" placeholder="Enter Mobile Number" class="box" required>
      <input type="file" name="image" class="box" accept="image/jpg, image/jpeg, image/png">
      <input type="submit" name="submit" value="Add Record" class="btn">
   </form>
      
</div>
<script src="java.js"></script>
</body>
</html>
