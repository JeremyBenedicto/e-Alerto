<?php
include 'php/config.php';
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


$select = mysqli_query($conn, "SELECT email FROM `user_form` WHERE id = '$user_id'") or die('Query failed');
if(mysqli_num_rows($select) > 0){
    $fetch = mysqli_fetch_assoc($select);
    if($fetch['email'] == "admin@gmail.com"){
    
        header('location:admin_interface.php');
    }
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
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Mobile Interface with Tabs</title>
  <link rel="stylesheet" href="css/home.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" 
                        integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" 
                        crossorigin="anonymous" 
                        referrerpolicy="no-referrer" />
</head>
</head>
<body>
  <div class="content">
    <div id="tab1" class="tab-content active">
      <h1>Tab 1 Content</h1>
      <p>This is the content for Tab 1.</p>
    </div>
    <div id="tab2" class="tab-content">
        <h2 style="text-align: center;color:antiquewhite;padding:1rem 1rem 0 1rem;">Profile</h2>
        <div class="content2">
            <div class="headpro">
        <?php if (!empty($admin_data['image'])) : ?>
                     <img src="uploaded_img/<?php echo $admin_data['image']; ?>" alt="Admin Profile Image">
                  <?php else : ?>
                     <img src="images/default-avatar.png" alt="Default Profile Image">
                  <?php endif; ?>
                  <div class="namepro">
               <h3><?php echo $admin_data['firstname'] . " " . $admin_data['middlename'] . " " . $admin_data['lastname']; ?></h3>
                    <h5><i class="fa-solid fa-phone"></i><?php echo $admin_data['cpnum']; ?></h5>
               </div>
               </div>
               <br><br>
            <div class="pInfo"><i class="fa-solid fa-envelope"></i><?php echo $admin_data['email']; ?></div>
            <div class="pInfo"><i class="fa-solid fa-location-dot"></i><?php echo $admin_data['address']; ?></div>
            <div class="pInfo"><i class="fa-solid fa-user"></i><?php echo $admin_data['age']; ?></div>
            <div class="pInfo" ><i class="fa-solid fa-person-half-dress"></i><?php echo $admin_data['gender']; ?></div>
            <div id="last"><br><br></div>
            <div class="pInfo" id="logout"><a href="home.php?logout=<?php echo $user_id; ?>"><i class="fa-solid fa-right-from-bracket"></i>Log Out</a></div>
               </div>
    </div>
    <div id="tab3" class="tab-content">
      <h1>Tab 3 Content</h1>
      <p>This is the content for Tab 3.</p>
    </div>
    <div id="tab4" class="tab-content">
      <h1>Tab 4 Content</h1>
      <p>This is the content for Tab 4.</p>
    </div>
    <div id="tab5" class="tab-content">
      <h1>Tab 5 Content</h1>
      <p>This is the content for Tab 5.
      
      </p>
    </div>
  </div>
  <div class="tabs">
    <button class="tab" onclick="showTab('tab1')"><img src="assets/icon/home.png" alt=""></button>
    <button class="tab" onclick="showTab('tab2')"><img src="assets/icon/user.png" alt=""></button>
    <button class="tab" onclick="showTab('tab3')"><img src="assets/icon/info.png" alt=""></button>
    <button class="tab" onclick="showTab('tab4')"><img src="assets/icon/message.png" alt=""></button>
    <button class="tab" onclick="showTab('tab5')"><img src="assets/icon/setting.png" alt=""></button>
  </div>

  <script src="javascript/home.js"></script>
</body>
</html>
