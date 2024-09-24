<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="css/injury.css">
</head>

<body>
    <div class="form-container">
        <div class="header">
            <div class="head1">
                <img src="assets/logo/LGU - Gabaldon logo copy.png" alt="">
                <div class="info">
                    <h4 style="margin-top: 2rem;">Republic of the Philippines</h4>
                    <h4>Province of Nueva Ecija</h4>
                    <h3>MUNICIPAL OF GABALDON</h3>
                    <H4>-o0o-</H4>
                </div>
                <img src="assets/logo/Logo with sun copy.png" alt="">
            </div>
            <div class="head2">
                <h2>MUNICIPAL DISASTER RISK REDUCTION & MANAGEMENT OFFICE</h2>
            </div>
            <div class="border"></div>
            <div class="border1"></div>
            <h1>INJURY REPORT FORM</h1>
        </div>
        <form class="form" action="submit_form.php" id="myForm" method="post" enctype="multipart/form-data">
            <div class="con1">
            <div class="left">
                <label for="name">Name:</label>
                <input type="text" name="name">
                <div class="sm-form">
                    <div class="age"><label for="age">Age:</label>
                    <input type="number" name="age">
                    </div>
                    <div class="sex">
                    <label for="sex">Sex:</label>
                    <select id="sex" name="sex" required>
                        <option value="">Select</option>
                        <option value="male">Male</option>
                        <option value="female">Female</option>
                    </select>
                    </div>
                    <div class="status">
                    <label for="civil_status">Civil Status:</label>
                    <select id="civil_status" name="civil_status" required>
                        <option value="">Select</option>
                        <option value="single">Single</option>
                        <option value="married">Married</option>
                        <option value="divorced">Divorced</option>
                        <option value="widowed">Widowed</option>
                    </select>
                    </div>
                </div>
                <label for="NO1">NO1:</label>
                <input type="text" name="NO1">
                <label for="PO1">PO1:</label>
                <input type="text" name="PO1">
                <label for="TO1">TO1:</label>
                <input type="text" name="TO1">
                <label for="DO1">DO1:</label>
                <input type="text" name="DO1">
            </div>
            <div class="right">
                <label for="date">Date:</label>
                <input type="date" name="date">
                <label for="address">Address:</label>
                <input type="text" name="address">
                <label for="bp">Blood Pressure:</label>
                <input type="text" name="bp">
                <label for="nameofcaller">Name of reporter:</label>
                <input type="text" name="nameofcaller">
                <label for="numofcaller">No. of reporter:</label>
                <input type="text" name="numofcaller">
            </div>
            </div>

    <div class="con2">
    <div class="wound">
    <h3>Select the type(s) of wounds:</h3>
  <input type="checkbox" id="abrasion" name="wound_type" value="abrasion">
  <label for="abrasion">Abrasion</label><br>

  <input type="checkbox" id="laceration" name="wound_type" value="laceration">
  <label for="laceration">Laceration</label><br>

  <input type="checkbox" id="avulsion" name="wound_type" value="avulsion">
  <label for="avulsion">Avulsion</label><br>

  <input type="checkbox" id="amputation" name="wound_type" value="amputation">
  <label for="amputation">Amputation</label><br>

  <input type="checkbox" id="puncture" name="wound_type" value="puncture">
  <label for="puncture">Puncture</label><br>

  <input type="checkbox" id="stab" name="wound_type" value="stab">
  <label for="stab">Stab</label><br>

  <input type="checkbox" id="incised" name="wound_type" value="incised">
  <label for="incised">Incised</label><br>

  <input type="checkbox" id="gun_shot" name="wound_type" value="gun_shot">
  <label for="gun_shot">Gun Shot</label><br>

  <input type="checkbox" id="burn" name="wound_type" value="burn">
  <label for="burn">Burn</label><br>
  </div>
  <div class="fructure">
  <h3>Select the type(s) of fractures:</h3>
  <input type="checkbox" id="open_compound" name="fracture_type" value="open_compound">
  <label for="open_compound">Open/Compound</label><br>

  <input type="checkbox" id="closed" name="fracture_type" value="closed">
  <label for="closed">Closed</label><br>
  </div>
  <div class="others">
  <h3>Others:</h3>
  <input type="checkbox" id="cva" name="emergency_type" value="cva">
  <label for="cva">CVA (Stroke)</label><br>

  <input type="checkbox" id="convulsion" name="emergency_type" value="convulsion">
  <label for="convulsion">Convulsion</label><br>

  <input type="checkbox" id="animal_bite" name="emergency_type" value="animal_bite">
  <label for="animal_bite">Animal Bite</label><br>

  <input type="checkbox" id="snake_bite" name="emergency_type" value="snake_bite">
  <label for="snake_bite">Snake Bite</label><br>

  <input type="checkbox" id="poisoning" name="emergency_type" value="poisoning">
  <label for="poisoning">Poisoning</label><br>

  <input type="checkbox" id="drowning" name="emergency_type" value="drowning">
  <label for="drowning">Drowning</label><br>

  <input type="checkbox" id="heat_related" name="emergency_type" value="heat_related">
  <label for="heat_related">Heat-related Emergencies</label><br>

  <input type="checkbox" id="others_checkbox" name="emergency_type" value="others_checkbox">
  <label for="others_checkbox">Others (specify):</label>
  <input type="text" id="others_text" name="others_text"><br>
  </div>
  <br>
  
        
  </div>

</form>
<span class="message"></span>
        <div class="drawing">
            <canvas id="canvas" width="500" height="500"></canvas>
        </div>
        <input type="submit" value="Submit">
    </div>

    <a href="admin_interface.php" class="scroll-button"><img src="assets/newlogo.png" alt=""></a>


    <script src="javascript/injury.js"></script>
</body>

</html>