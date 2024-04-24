<?php
include 'php/config.php';
session_start();
$user_id = $_SESSION['user_id'];


if (!isset($user_id)) {
   header('location:login.php');
};

if (isset($_GET['logout'])) {

   $offline_status_query = mysqli_query($conn, "UPDATE `user_form` SET status = 'Offline Now' WHERE id = '$user_id'");
   unset($user_id);
   session_destroy();

   header('location:login.php');
}


$admin_email = "admin@gmail.com";
$admin_query = mysqli_query($conn, "SELECT * FROM `user_form` WHERE email = '$admin_email'") or die('Query failed');
if (mysqli_num_rows($admin_query) > 0) {
   $admin_data = mysqli_fetch_assoc($admin_query);
}

// Database connection (replace with your own details)
$db_host = 'localhost';
$db_username = 'root';
$db_password = '';
$db_name = 'user_db';

$conn = new mysqli($db_host, $db_username, $db_password, $db_name);
if ($conn->connect_error) {
    die('Connection failed: ' . $conn->connect_error);
}

$emergency_messages_query = mysqli_query($conn, "SELECT messages.*, user_form.firstname, user_form.lastname, user_form.image
                                                FROM messages 
                                                INNER JOIN user_form ON messages.user_id = user_form.id 
                                                ORDER BY messages.timestamp DESC") or die('Query failed');



// Fetch photos from the database
$sql = "SELECT photo_path FROM photos";
$result = $conn->query($sql);

$photos = array();
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $photos[] = $row['photo_path'];
    }
}

// Close connection
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Interface</title>
   <link rel="stylesheet" href="css/admin.css">
   <head>
    <!-- Include Leaflet CSS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />

    <!-- Include Leaflet JavaScript -->
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
</head>

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" 
                        integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" 
                        crossorigin="anonymous" 
                        referrerpolicy="no-referrer" />
</head>

<body>
   <div class="container">
      <div class="main-body">
         <div class="upper">
            <div class="windy"><iframe width="650" height="300" src="https://embed.windy.com/embed.html?type=map&location=coordinates&metricRain=default&metricTemp=default&metricWind=default&zoom=5&overlay=wind&product=ecmwf&level=surface&lat=15.496&lon=121.333" frameborder="0"></iframe></div>
            <div class="weather-time"><img style="height: 300px;" src="assets/bar_graph.png" alt="Image 2"></div>
         </div>
         <div class="lower">
            <div class="graph"><a class="weatherwidget-io" href="https://forecast7.com/en/15d52121d31/gabaldon/" data-label_1="GABALDON" data-label_2="WEATHER" data-theme="original" >GABALDON WEATHER</a>
<script>
!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src='https://weatherwidget.io/js/widget.min.js';fjs.parentNode.insertBefore(js,fjs);}}(document,'script','weatherwidget-io-js');
</script></div>
            <div class="news">
            <div class="slideshow-container">
    <?php foreach ($photos as $photo): ?>
        <div class="mySlides fade">
            <img src="<?php echo $photo; ?>" style="width:26rem; height:15rem">
        </div>
    <?php endforeach; ?>
    <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
    <a class="next" onclick="plusSlides(1)">&#10095;</a>
</div>
            </div>
            <div class="add" id="add"><a href="index.php"><img style="height: 50px; width:50px;" src="assets/icon/image.png" alt=""></a></div>
         </div>

      </div>
      <!-- navigator -->
      <div class="left-body">
         <div class="logo">
            <div class="logo1">
            <img style="height: 150px;border-radius:100px;" src="assets/newlogo.png" alt="eALERTO logo">
            </div>
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
                     <a href="injury_report_form.php" class="btn" id="red">Add Record</a>
                     <a href="view_records.php" class="btn" id="out">View Record</a>
                  </div>
               </div>

               <button class="vsd" id="vsd"><img src="assets/icon/chat.png" alt=""></button>
               

               <button id="popperBtn3" class="nav3"><img src="assets/icon/settings.png" alt=""></button>
               <div id="popperContent3" class="popper-content">
                  <div class="admin-actions">
                     <a href="update_profile.php" class="btn" id="red">Update Profile</a>
                     <a href="home.php?logout=<?php echo $user_id; ?>" class="btn" id="out">Logout</a>
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



   <div id="minCard" class="min-card">
      <button class="close-btn" id="close-Btn">&times;</button>
      <div class="chathead">
               
               <?php if (!empty($admin_data['image'])) : ?>
                  <img src="uploaded_img/<?php echo $admin_data['image']; ?>" alt="Admin Profile Image">
               <?php else : ?>
                  <img src="images/default-avatar.png" alt="Default Profile Image">
               <?php endif; ?>
               <div class="mes">
               <h2>E-Message</h2>
               <?php echo $admin_data['status'];?>
               </div>
      </div>
      <section class="users">
      <div style="display: none;" class="search">
        <span class="text">Select an user to start chat</span>
        <input type="text" placeholder="Enter name to search...">
        <button><i class="fas fa-search"></i></button>
      </div>
    </section>

    <div class="emergency-section">
   <div class="message-list">
   <div id="chat-messages"></div>
   <!-- message div here.... -->
   </div>
</div>

   </div>

   <script>
function fetchChatMessages() {
    var xhr = new XMLHttpRequest();
    xhr.open('GET', 'fetch_messages.php', true);
    xhr.onload = function() {
        if (xhr.status === 200) {
            document.getElementById('chat-messages').innerHTML = xhr.responseText;
        }
    };
    xhr.send();
}
setTimeout(fetchChatMessages, 2000);
</script>




   <script src="javascript/admin.js"></script>
</body>

</html>
