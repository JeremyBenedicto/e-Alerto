<?php
$conn = new mysqli("localhost", "root", "", "user_db");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Query to get the number of injuries per month
$query = "SELECT MONTH(date) as month, COUNT(*) as count FROM injury_form GROUP BY MONTH(date)";
$result = $conn->query($query);

$monthly_data = [];

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $monthly_data[(int)$row['month']] = $row['count'];
    }
}

$conn->close();

// Prepare data for JavaScript
$monthly_data_json = json_encode($monthly_data);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <title>Monthly Injury Report</title>
</head>
<body>

<canvas id="injuryChart" width="400" height="200"></canvas>

<script>
    // Data passed from PHP
    const monthlyData = <?php echo $monthly_data_json; ?>;

    // Prepare labels and data for the chart
    const labels = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
    const data = [];

    for (let i = 1; i <= 12; i++) {
        data.push(monthlyData[i] || 0);
    }

    const ctx = document.getElementById('injuryChart').getContext('2d');
    const injuryChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: labels,
            datasets: [{
                label: 'Number of Injuries',
                data: data,
                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                borderColor: 'rgba(75, 192, 192, 1)',
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
</script>

</body>
</html>
