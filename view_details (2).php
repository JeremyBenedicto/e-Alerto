<?php

$conn = new mysqli("localhost", "root", "", "user_db");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

$sql = "SELECT * FROM injury_form WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Injury Details</title>
    <link rel="stylesheet" href="css/view_details.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.2/html2pdf.bundle.min.js"></script>
</head>
<body>
    
    <div class="back-button">
      
   </div>
   <div class="buttons">
   <a href="view_records.php" class="btn">
         <img src="assets/icon/left-arrow.png" alt="Back">
      </a>
        <button id="download-btn">Save as PDF</button>
    </div>
    <div class="container">
        <div class="conf">
        <?php if ($row): ?>
            <div class="header">
                <div class="head1">
                    <img src="assets/logo/LGU - Gabaldon logo copy.png" alt="">
                    <div class="info">
                        <h4 style="margin-top: 2rem;">Republic of the Philippines</h4>
                        <h4>Province of Nueva Ecija</h4>
                        <h3>MUNICIPAL OF GABALDON</h3>
                        <h4>-o0o-</h4>
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

            <div class="details">
                <div class="con1">
                    <div class="left">
                        <div class="detail-item">
                            <span class="label">Name:</span>
                            <span class="value"><?php echo htmlspecialchars($row['name']); ?></span>
                        </div>
                        <div class="sm-form">
                            <div class="detail-item">
                                <span class="label">Age:</span>
                                <span class="value"><?php echo htmlspecialchars($row['age']); ?></span>
                            </div>
                            <div class="detail-item">
                                <span class="label">Sex:</span>
                                <span class="value"><?php echo htmlspecialchars($row['sex']); ?></span>
                            </div>
                            <div class="detail-item">
                                <span class="label">Civil Status:</span>
                                <span class="value"><?php echo htmlspecialchars($row['civil_status']); ?></span>
                            </div>
                        </div>
                        <div class="detail-item">
                            <span class="label">NO1:</span>
                            <span class="value"><?php echo htmlspecialchars($row['NO1']); ?></span>
                        </div>
                        <div class="detail-item">
                            <span class="label">PO1:</span>
                            <span class="value"><?php echo htmlspecialchars($row['PO1']); ?></span>
                        </div>
                        <div class="detail-item">
                            <span class="label">TO1:</span>
                            <span class="value"><?php echo htmlspecialchars($row['TO1']); ?></span>
                        </div>
                        <div class="detail-item">
                            <span class="label">DO1:</span>
                            <span class="value"><?php echo htmlspecialchars($row['DO1']); ?></span>
                        </div>
                    </div>
                    <div class="right">
                        <div class="detail-item">
                            <span class="label">Date:</span>
                            <span class="value"><?php echo htmlspecialchars($row['date']); ?></span>
                        </div>
                        <div class="detail-item">
                            <span class="label">Address:</span>
                            <span class="value"><?php echo htmlspecialchars($row['address']); ?></span>
                        </div>
                        <div class="detail-item">
                            <span class="label">Blood Pressure:</span>
                            <span class="value"><?php echo htmlspecialchars($row['bp']); ?></span>
                        </div>
                        <div class="detail-item">
                            <span class="label">Name of Caller:</span>
                            <span class="value"><?php echo htmlspecialchars($row['nameofcaller']); ?></span>
                        </div>
                        <div class="detail-item">
                            <span class="label">Number of Caller:</span>
                            <span class="value"><?php echo htmlspecialchars($row['numofcaller']); ?></span>
                        </div>
                    </div>
                </div>
                <div class="con2">
                    <div class="damage">
                        <div class="detail-item">
                            <span class="label">Wound Type:</span>
                            <span class="value"><?php echo htmlspecialchars($row['wound_type']); ?></span>
                        </div>
                        <div class="detail-item">
                            <span class="label">Fracture Type:</span>
                            <span class="value"><?php echo htmlspecialchars($row['fracture_type']); ?></span>
                        </div>
                        <div class="detail-item">
                            <span class="label">Emergency Types:</span>
                            <span class="value"><?php echo htmlspecialchars($row['emergency_types']); ?></span>
                        </div>
                        <div class="detail-item">
                            <span class="label">Others Text:</span>
                            <span class="value"><?php echo htmlspecialchars($row['others_text']); ?></span>
                        </div>
                    </div>
                    <div class="mark">
                        <div class="detail-item">
                            <span class="label">Accident Mark:</span>
                            <p><?php if ($row['accident_mark']): ?>
                                <img src="<?php echo htmlspecialchars($row['accident_mark']); ?>" alt="Accident Mark">
                                <?php else: ?>
                                No image
                                <?php endif; ?>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        <?php else: ?>
            <p>No details found for this record.</p>
        <?php endif; ?>
        </div>
    </div>
    <script>
        document.getElementById('download-btn').addEventListener('click', function () {
            var element = document.querySelector('.container');
            var downloadBtn = document.getElementById('download-btn');

            downloadBtn.style.display = 'none';

            var opt = {
                margin: 0.5,
                filename: 'Injury_Details.pdf',
                image: { type: 'jpeg', quality: 0.98 },
                html2canvas: { scale: 2 },
                jsPDF: { unit: 'in', format: 'letter', orientation: 'portrait' }
            };

            html2pdf().from(element).set(opt).save().then(function () {
                downloadBtn.style.display = 'block';
            });
        });

        document.getElementById('back-btn').addEventListener('click', function () {
            window.history.back();
        });
    </script>
</body>
</html>


<?php
$stmt->close();
$conn->close();
?>
