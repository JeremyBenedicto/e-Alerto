<?php
include 'config.php';
session_start();
$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location:login.php');
};

if(isset($_GET['logout'])){
   unset($user_id);
   session_destroy();
   header('location:login.php');
}


$admin_email = "admin@gmail.com";
$admin_query = mysqli_query($conn, "SELECT * FROM `user_form` WHERE email = '$admin_email'") or die('Query failed');
if(mysqli_num_rows($admin_query) > 0){
    $admin_data = mysqli_fetch_assoc($admin_query);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Admin Interface</title>

   <link rel="stylesheet" href="css/style.css">
</head>
<body>
   
<div class="container">
   <div class="admin-profile">
      <h2>Welcome Admin!</h2>
      <?php if(isset($admin_data)): ?>
      <div class="profile-details">
         <?php if(!empty($admin_data['image'])): ?>
            <img src="uploaded_img/<?php echo $admin_data['image']; ?>" alt="Admin Profile Image">
         <?php else: ?>
            <img src="images/default-avatar.png" alt="Default Profile Image">
         <?php endif; ?>
         <h3><?php echo $admin_data['firstname'] . " " . $admin_data['middlename'] . " " . $admin_data['lastname']; ?></h3>
         <h5>Email: <?php echo $admin_data['email']; ?></h5>
      </div>
      <?php endif; ?>
      <div class="admin-actions">
      <a href="update_profile.php" class="btn">update profile</a>
         <a href="login.php" class="btn" style="background-color: red;">Logout</a>
      </div>
   </div>
</div>

</body>
</html>
