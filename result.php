<?php
ini_set('display_errors', 0);
ini_set('display_startup_errors', 0);
error_reporting(0);
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>CO2 Emissions Result</title>
  <!-- Include the Chart.js library -->
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <style>
    body {
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
    margin: 0;
    font-family: Arial, sans-serif;
    overflow-y: hidden;
  }
  h1 {
    margin: 0;
    padding: 20px;
  }
  #container {
    padding: 30px;
    height: 80vh;
    width: 70%;
    text-align: center;
    position: relative;
    border-radius: 2px;
    background: lightgray;
    border-color: #000c18;
    border-style: solid;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
  }
  #breakdownChart {
    width: 800px;
    height: 600px;
    max-width: 100%;
  }
  </style>
</head>
<body>
  <div id="container">
    <h1>Total CO2 Emissions: <?php echo $_GET['result']; ?> units</h1>

    <input type="hidden" id="jsonBreakdownData" value="<?php echo htmlspecialchars($_GET['jsonBreakdownData'], ENT_QUOTES, 'UTF-8'); ?>">

    <canvas id="breakdownChart"></canvas>
  </div>

  <script>
    const breakdownData = JSON.parse(document.getElementById('jsonBreakdownData').value);
    breakdownData.pop(); // Remove the last item ("Other") from the data array

    const ctx = document.getElementById('breakdownChart').getContext('2d');
    const myChart = new Chart(ctx, {
  type: 'pie',
  data: {
    labels: ['Procurement', 'Outbound Shipping', 'Energy Usage', 'Staff Travel', 'Patient Travel', 'Waste Management'],
    datasets: [{
      data: breakdownData,
      backgroundColor: [
        'rgba(255, 99, 132, 0.6)',
        'rgba(54, 162, 235, 0.6)',
        'rgba(255, 206, 86, 0.6)',
        'rgba(75, 192, 192, 0.6)',
        'rgba(153, 102, 255, 0.6)',
        'rgba(255, 159, 64, 0.6)'
      ],
      borderColor: [
        'rgba(255, 99, 132, 1)',
        'rgba(54, 162, 235, 1)',
        'rgba(255, 206, 86, 1)',
        'rgba(75, 192, 192, 1)',
        'rgba(153, 102, 255, 1)',
        'rgba(255, 159, 64, 1)'
      ],
      borderWidth: 1
    }]
  },
  options: {
    responsive: true,
    maintainAspectRatio: false,
    plugins: {
      legend: {
        position: 'bottom',
      }
    }
  }
});

// Add a click event listener
ctx.canvas.onclick = (event) => {
  const activePoints = myChart.getElementsAtEventForMode(event, 'nearest', { intersect: true }, true);

  if (activePoints.length) {
    const index = activePoints[0].index;
    const label = myChart.data.labels[index];

    switch (label) {
      case 'Procurement':
        window.location.href = 'index.html';
        break;
      case 'Outbound Shipping':
        window.location.href = 'outbound_shipping.html';
        break;
      case 'Energy Usage':
        window.location.href = 'energy_usage.html';
        break;
      case 'Staff Travel':
        window.location.href = 'staff_travel.html';
        break;
      case 'Patient Travel':
        window.location.href = 'patient_travel.html';
        break;
      case 'Waste Management':
        window.location.href = 'waste_management.html';
        break;
    }
  }
};
  </script>
</body>
</html>
