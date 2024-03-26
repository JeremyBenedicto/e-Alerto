<?php
include 'config.php';
session_start();
$user_id = $_SESSION['user_id'];

if (!isset($user_id)) {
   header('location:login.php');
};

if (isset($_GET['logout'])) {
   unset($user_id);
   session_destroy();
   header('location:login.php');
}


$admin_email = "admin@gmail.com";
$admin_query = mysqli_query($conn, "SELECT * FROM `user_form` WHERE email = '$admin_email'") or die('Query failed');
if (mysqli_num_rows($admin_query) > 0) {
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

   <link rel="stylesheet" href="css/admin.css">
</head>

<body>
   <div class="container">
      <div class="main-body">
         <div class="upper">
            <div class="windy"><img src="assets/eALERTO.png" alt="Image 1"></div>
            <div class="weather-time"><img src="assets/eALERTO.png" alt="Image 2"></div>
         </div>
         <div class="lower">
            <div class="graph"><img src="assets/eALERTO.png" alt="Image 3"></div>
            <div class="news"><img src="assets/eALERTO.png" alt="Image 3"></div>
         </div>

      </div>
      <!-- navigator -->
      <div class="left-body">
         <div class="logo">
            <img style="height: 150px;" src="assets/eALERTO.png" alt="eALERTO logo">
         </div>
         <div class="right-nav">
            <div class="back">

               <button id="nav1" class="nav1"><?php if (!empty($admin_data['image'])) : ?>
                     <img src="uploaded_img/<?php echo $admin_data['image']; ?>" alt="Admin Profile Image">
                  <?php else : ?>
                     <img src="images/default-avatar.png" alt="Default Profile Image">
                  <?php endif; ?></button>

                  <button id="popperBtn4" class="nav2"><img src="assets/icon/edit.png" alt=""></button>
                  <div id="popperContent4" class="popper-content">
                  <div class="admin-actions">
                     <a href="record_accident.php" class="btn" id="red">Add Record</a>
                     <a href="view_records.php" class="btn" id="out">View Record</a>
                  </div>
               </div>

               <button id="popperBtn2" class="nav2"><img src="assets/icon/chat.png" alt=""></button>
               <div id="popperContent2" class="popper-content">Hello, I am a popper for Chat!</div>

               <button id="popperBtn3" class="nav3"><img src="assets/icon/settings.png" alt=""></button>
               <div id="popperContent3" class="popper-content">
                  <div class="admin-actions">
                     <a href="update_profile.php" class="btn" id="red">Update Profile</a>
                     <a href="login.php" class="btn" id="out">Logout</a>
                  </div>
               </div>

            </div>
         </div>
      </div>
   </div>
   <div id="miniCard" class="mini-card">
      <button class="close-btn" id="closeBtn">&times;</button>


      <!-- admin Profile -->
      <div class="admin-profile">
         <h2>Admin Profile</h2>
         <?php if (isset($admin_data)) : ?>
            <div class="profile-details">
               <?php if (!empty($admin_data['image'])) : ?>
                  <img src="uploaded_img/<?php echo $admin_data['image']; ?>" alt="Admin Profile Image">
               <?php else : ?>
                  <img src="images/default-avatar.png" alt="Default Profile Image">
               <?php endif; ?>
               <h2><?php echo $admin_data['firstname'] . " " . $admin_data['middlename'] . " " . $admin_data['lastname']; ?></h2>
               <h5>Admin</h5>
               <h3>Email: <?php echo $admin_data['email']; ?></h3>
               <h3>Age: <?php echo $admin_data['age']; ?></h3>
               <h3>Address: <?php echo $admin_data['address']; ?></h3>
            </div>
         <?php endif; ?>

      </div>
   </div>
   <script src="javascript/admin.js"></script>
</body>

</html>