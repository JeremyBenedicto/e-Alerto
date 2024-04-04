<?php
include 'php/config.php';
session_start();
$user_id = $_SESSION['user_id'];

if (!isset($user_id)) {
   header('location:login.php');
}

if (isset($_GET['logout'])) {
   // Update user status to "Offline Now"
   $update_query = mysqli_query($conn, "UPDATE `user_form` SET status = 'Offline Now' WHERE id = '$user_id'");
   
   // Unset user_id and destroy session
   unset($user_id);
   session_destroy();
   header('location:login.php');
}

$select = mysqli_query($conn, "SELECT email FROM `user_form` WHERE id = '$user_id'") or die('Query failed');
if (mysqli_num_rows($select) > 0) {
   $fetch = mysqli_fetch_assoc($select);
   if ($fetch['email'] == "admin@gmail.com") {
      header('location:admin_interface.php');
   }
}
?>


<?php
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

// Set the timezone to your desired location
date_default_timezone_set('Asia/Manila');

// Get the current time in the specified timezone
$currentTime = new DateTime('now');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>App</title>
    <link rel="stylesheet" href="userCss.css">
    <style>
       
</style>
</head>
<body>
    
<div class="glass-effect">
    <!-- Logo and Report text container -->
    <div class="logo-report-container">
        <!-- Logo -->
        <img src="Assets/logo.png" alt="Logo" class="logo">
        <!-- Report text on top -->
        <div class="report-text">Report Now</div>
    </div>
    <!-- Text form and report button container -->
    <div class="text-button-container">
        <!-- Text form on the left -->
        <form class="text-form" action="#">
            <input type="text" name="text" placeholder="Enter text here">
        </form>
        <!-- Report button on the right -->
        <button class="report-button">Report</button>
    </div>
</div>

<div class="box">
  <div class="slideshow-container">
    <img class="mySlides" src="Assets/1.png">
    <img class="mySlides" src="Assets/2.png">
    <img class="mySlides" src="Assets/logo.png">
  </div>
</div>
                <script>
                    let slideIndex = 0;
                    showSlides();

                    function showSlides() {
                    let i;
                    const slides = document.getElementsByClassName("mySlides");
                    for (i = 0; i < slides.length; i++) {
                        slides[i].style.display = "none";  
                    }
                    slideIndex++;
                    if (slideIndex > slides.length) {slideIndex = 1}    
                    slides[slideIndex-1].style.display = "block";  
                    setTimeout(showSlides, 2000); // Change image every 2 seconds (adjust as needed)
                    }
                </script>
           
           <div class="container">
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





<div class="icon-container">
    <a href="chat.php">
        <img src="Assets/chat.png" alt="chat.php" style="width: 50px; height: 50px;">
    </a>
    <a href="profile.php">
        <img src="Assets/profile.png" alt="profile.php" style="width: 50px; height: 50px;">
    </a>
    <a href="setting.php">
        <img src="Assets/settings.png" alt="setting.php" style="width: 50px; height: 50px;">
    </a>
</div>


</body>
</html>
