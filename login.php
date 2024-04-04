<?php

include 'php/config.php';
session_start();

if (isset($_POST['submit'])) {
   
   // Check if the terms checkbox is checked
   if (!isset($_POST['termsCheckbox'])) {
      $message[] = 'Please agree to the terms and conditions.';
   } else {
      $email = mysqli_real_escape_string($conn, $_POST['email']);
      $pass = mysqli_real_escape_string($conn, md5($_POST['password']));
      $select = mysqli_query($conn, "SELECT * FROM `user_form` WHERE email = '$email' AND password = '$pass'") or die('query failed');
      if (mysqli_num_rows($select) > 0) {
         $row = mysqli_fetch_assoc($select);
         $_SESSION['user_id'] = $row['id'];
         
         // Update user status to "Active Now"
         $user_id = $row['id'];
         mysqli_query($conn, "UPDATE `user_form` SET status = 'Active Now' WHERE id = '$user_id'");

         header('location:home.php');
      } else {
         $message[] = 'Incorrect email or password!';
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
   <title>login</title>

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>

<body>

   <div class="form-container">

      <form action="" method="post" enctype="multipart/form-data">
         <h3 style="color: white;">login now</h3>
         <?php
         if (isset($message)) {
            foreach ($message as $message) {
               echo '<div class="message">' . $message . '</div>';
            }
         }
         ?>
         <img style="height: 180px; margin:0 2rem 2rem 2rem;" src="assets/eALERTO.png" alt="">
         <input type="email" name="email" placeholder="enter email" class="box" required>
         <input type="password" name="password" placeholder="enter password" class="box" required>
         <div class="input-group">
            <input type="checkbox" id="termsCheckbox" name="termsCheckbox" required>
            <label for="termsCheckbox">I agree to the <a href="#" id="termsLink">terms and conditions</a></label>
         </div>
         <input type="submit" name="submit" value="login now" class="btn">
         <p>don't have an account? <a href="register.php">register now</a></p>
      </form>

   </div>
   <div id="termsModal" class="modal">
      <div class="modal-content">
      <!-- Your terms and conditions content here -->
      </div>
   </div>

   <script src="javascript/script.js"></script>

</body>

</html>
