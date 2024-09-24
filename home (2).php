<?php
include 'php/config.php';
session_start();
$user_id = $_SESSION['user_id'];

if (!isset($user_id)) {
   header('location:login.php');
   exit();
};

if (isset($_GET['logout'])) {
   unset($user_id);
   session_destroy();
   header('location:login.php');
   exit();
}

$select = mysqli_query($conn, "SELECT email FROM `user_form` WHERE id = '$user_id'") or die('Query failed');
if (mysqli_num_rows($select) > 0) {
   $fetch = mysqli_fetch_assoc($select);
   if ($fetch['email'] == "admin@gmail.com") {
      header('location:admin_interface.php');
      exit();
   }
}
$admin_email = "admin@gmail.com";
$admin_query = mysqli_query($conn, "SELECT * FROM `user_form` WHERE email = '$admin_email'") or die('Query failed');
if (mysqli_num_rows($admin_query) > 0) {
   $admin_data = mysqli_fetch_assoc($admin_query);
}

$sql = "SELECT photo_path FROM photos";
$result = $conn->query($sql);

$photos = array();
if ($result->num_rows > 0) {
   while ($row = $result->fetch_assoc()) {
      $photos[] = $row['photo_path'];
   }
}

$apiKey = "95c6c917d1860ea97c9b3c8837ee3fd9";
$cityId = "1713498";
$googleApiUrl = "https://api.openweathermap.org/data/2.5/weather?id=" . $cityId . "&lang=en&units=metric&APPID=" . $apiKey;

$ch = curl_init();

curl_setopt($ch, CURLOPT_HEADER, 0);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_URL, $googleApiUrl);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_VERBOSE, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
$response = curl_exec($ch);

curl_close($ch);
$data = json_decode($response);

date_default_timezone_set('Asia/Manila');


$currentTime = new DateTime('now');

?>


<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>User</title>
   <link rel="stylesheet" href="css/home.css">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>
</head>

<body>
   <div class="content">
      <div id="tab1" class="tab-content active">
         <div class="dashboard">
            <div class="upper">
               <div class="windy">
                  <iframe width="100%" height="100%" src="https://embed.windy.com/embed.html?type=map&location=coordinates&metricRain=default&metricTemp=default&metricWind=default&zoom=5&overlay=wind&product=ecmwf&level=surface&lat=15.496&lon=121.333" frameborder="0"></iframe>
               </div>
               <div class="weather">
                  <h2><?php echo $data->name; ?> Weather Forecast</h2>
                  <img src="http://openweathermap.org/img/w/<?php echo $data->weather[0]->icon; ?>.png" class="weather-icon" alt="Weather Icon">
                  <div class="weather-description"><?php echo ucwords($data->weather[0]->description); ?></div>
                  <div class="temperature"><?php echo round($data->main->temp); ?>&deg;C</div>
                  <div class="additional-info">
                     <div class="info-item">
                        <span class="info-label">Humidity:</span>
                        <span class="info-value"><?php echo $data->main->humidity; ?>%</span>
                     </div>
                     <div class="info-item">
                        <span class="info-label">Wind:</span>
                        <span class="info-value"><?php echo $data->wind->speed; ?> km/h</span>
                     </div>
                  </div>
                  <div class="update-time">
                     Last Updated: <?php echo $currentTime->format('jS F, Y - g:i a'); ?>
                  </div>
               </div>
            </div>
            <div class="news">
               <div class="slideshow-container">
                  <?php foreach ($photos as $photo) : ?>
                     <div class="mySlides fade">
                        <img src="<?php echo $photo; ?>" style="width:100%; height:12rem">
                     </div>
                  <?php endforeach; ?>
                  <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
                  <a class="next" onclick="plusSlides(1)">&#10095;</a>
               </div>
            </div>
         </div>
      </div>
      <div id="tab2" class="tab-content">
         <div class="content2">
            <h2 style="text-align: start;color:black;padding:1rem 1rem 0 1rem;" class="i">Profile</h2>
            <div class="headpro">
               <?php
               $select = mysqli_query($conn, "SELECT * FROM `user_form` WHERE id = '$user_id'") or die('query failed');
               if (mysqli_num_rows($select) > 0) {
                  $fetch = mysqli_fetch_assoc($select);
               }
               if ($fetch['image'] == '') {
                  echo '<img src="images/default-avatar.png">';
               } else {
                  echo '<img src="uploaded_img/' . $fetch['image'] . '">';
               }
               ?>
               <div class="namepro">
                  <h3><?php echo $fetch['firstname'] . " " . $fetch['middlename'] . " " . $fetch['lastname']; ?></h3>
                  <h5><i class="fa-solid fa-phone"></i><?php echo $fetch['cpnum']; ?></h5>
               </div>
            </div>
            <br><br>
            <div class="pInfo"><i class="fa-solid fa-envelope"></i><?php echo $fetch['email']; ?></div>
            <div class="pInfo"><i class="fa-solid fa-location-dot"></i><?php echo $fetch['address']; ?></div>
            <div class="pInfo"><i class="fa-solid fa-user"></i><?php echo $fetch['age']; ?></div>
            <div class="pInfo"><i class="fa-solid fa-person-half-dress"></i><?php echo $fetch['gender']; ?></div>
            <div id="last"><br><br></div>

         </div>
      </div>
      <div id="tab3" class="tab-content">
    <div class="emergency">
        <h2>Emergency Report</h2>
        <form action="#" method="post" id="emergency_form">
            <input type="text" name="emergency_message" id="emergency_message" placeholder="Enter type of accident here.." required>
            <button type="submit" class="alert" name="submit_message" id="send"><img src="assets/icon/info.png" alt=""></button>
        </form>
        <h3 style="text-align: center;">For your information!</h3>
        <h4 style="text-align: center;margin-top:-.5rem;"> If you click that button, your personal information and current location will be sent to the MDRRMO.</h4>
    </div>
</div>

      
      <div id="tab4" class="tab-content">
    <div class="content1">
        <div class="set4">
            <h2 style="text-align: start;color:black;padding:1rem 1rem 0 1rem;">Inbox</h2>
        </div>
        <div class="chat-container">
            <div class="response-messages">
                <?php
                // Fetching messages where 'admin_response' table holds the messages of the user
                $response_query = mysqli_query($conn, "SELECT message, timestamp FROM admin_response WHERE user_id = '$user_id'");
                if (mysqli_num_rows($response_query) > 0) {
                    while ($response_row = mysqli_fetch_assoc($response_query)) {
                        echo "<div class='message-item admin'>";
                        echo "<div class='message-bubble'>";
                        echo "<p>" . $response_row['message'] . "</p>";
                        echo "<span class='timestamp'>" . date("H:i", strtotime($response_row['timestamp'])) . "</span>";
                        echo "</div>";
                        echo "</div>";
                    }
                } else {
                    echo "<p>No response messages yet.</p>";
                }
                ?>
            </div>
        </div>
    </div>
</div>



      <div id="tab5" class="tab-content">

         <div class="content2">
            <div class="set">
               <h2 style="text-align: start;color:black;padding:1rem 1rem 0 1rem;">Settings</h2>
            </div>
            <div class="pInfo" id="dark"><button onclick="toggleDarkMode()"><i class="fa-solid fa-moon"></i>Dark Mode</button></div>
            <div class="pInfo" id="update"><a href="update_profile.php"><i class="fa-solid fa-user"></i>Update Profile</a></div>
            <div class="pInfo" id="logout"><a href="home.php?logout=<?php echo $user_id; ?>"><i class="fa-solid fa-right-from-bracket"></i>Log Out</a></div>
         </div>

      </div>
   </div>
   <div class="tabs">
      <button class="tab" onclick="showTab('tab1')"><img src="assets/icon/home.png" alt=""></button>
      <button class="tab" onclick="showTab('tab2')"><img src="assets/icon/user.png" alt=""></button>
      <button class="tab" onclick="showTab('tab3')"><img style="height: 80px; margin-top:-3rem;" src="assets/newlogo.png" alt=""></button>
      <button class="tab" onclick="showTab('tab4')"><img src="assets/icon/message.png" alt=""></button>
      <button class="tab" onclick="showTab('tab5')"><img src="assets/icon/setting.png" alt=""></button>
   </div>

   <script src="javascript/home.js"></script>
   <script>
    const sendButton = document.getElementById('send');
    const emergencyMessageInput = document.getElementById('emergency_message');

    sendButton.addEventListener('click', function(event) {
        if (emergencyMessageInput.value.trim() === "") {
            emergencyMessageInput.value = "I need immediate assistance, please respond as soon as possible.";
        }
        sendLocation();
    });

    function sendLocation() {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(saveToDatabase);
        } else {
            alert("Geolocation is not supported by this browser.");
        }
    }

    function saveToDatabase(position) {
        const latitude = position.coords.latitude;
        const longitude = position.coords.longitude;

        const xhr = new XMLHttpRequest();
        xhr.open("POST", "save_location.php", true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4 && xhr.status === 200) {
                alert(xhr.responseText);
            }
        };
        xhr.send("latitude=" + latitude + "&longitude=" + longitude + "&emergency_message=" + emergencyMessageInput.value);
    }
</script>

</body>

</html>