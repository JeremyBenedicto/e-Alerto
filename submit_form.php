<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $conn = new mysqli("localhost", "root", "", "user_db");

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

  
    $stmt = $conn->prepare("INSERT INTO injury_form (name, age, sex, civil_status, NO1, PO1, TO1, DO1, date, address, bp, nameofcaller, numofcaller, wound_type, fracture_type, emergency_types, others_text) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sisssssssssssssss", $name, $age, $sex, $civil_status, $NO1, $PO1, $TO1, $DO1, $date, $address, $bp, $nameofcaller, $numofcaller, $wound_types, $fracture_type, $emergency_types, $others_text);

    $name = $_POST["name"];
    $age = $_POST["age"];
    $sex = $_POST["sex"];
    $civil_status = $_POST["civil_status"];
    $NO1 = $_POST["NO1"];
    $PO1 = $_POST["PO1"];
    $TO1 = $_POST["TO1"];
    $DO1 = $_POST["DO1"];
    $date = $_POST["date"];
    $address = $_POST["address"];
    $bp = $_POST["bp"];
    $nameofcaller = $_POST["nameofcaller"];
    $numofcaller = $_POST["numofcaller"];
    

    $wound_types = $_POST["wound_type"];
    $fracture_type = $_POST["fracture_type"];
    

    $emergency_types = $_POST["emergency_type"];
    $others_text = $_POST["others_text"];


    if ($stmt->execute()) {
        echo '<script>alert("Form submitted successfully.");';
        echo 'document.getElementById("message").innerText = "Submission is successful.";</script>';
        echo '<script>window.location.href = "injury_report_form.php";</script>';
    } else {
        echo '<script>alert("Error: ' . $stmt->error . '");';
        echo 'document.getElementById("message").innerText = "Error: ' . $stmt->error . '";</script>';
        echo '<script>window.location.href = "injury_report_form.php";</script>';
    }
    $stmt->close();
    $conn->close();
}
?>
