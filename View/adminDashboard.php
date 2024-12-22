<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/adminDashboard.css">
    <title>Document</title>
    <!-- Include Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <div class="adminDashboard">

        <div class="cardCon">

            <div class="card">
                <div class="card-content">
                    <h1 id="totalAccount">0</h1>
                    <h3>Total Account(s)</h3>
                </div>
            </div>

            <div class="card">
                <div class="card-content">
                    <h1 id="totalTeacher">0</h1>
                    <h3>Total Teacher(s)</h3>
                </div>
            </div>

            <div class="card">
                <div class="card-content">
                    <h1 id="totalStudent">0</h1>
                    <h3>Total Student(s)</h3>
                </div>
            </div>

        </div>
        
        <!-- Canvas for the chart -->
        <div class="CanvasCon">
            <canvas id="statsChart"></canvas>
        </div>
    </div>

    .

    <script src="../assets/js/jquery.js"></script>

    <script>
        $(document).ready(function() {
            var totalAccount = 0;
            var totalTeacher = 0;
            var totalStudent = 0;

            function getTotalAccount() {
                $.ajax({
                    url: '../Controller/getTotalAccount.php', 
                    type: 'GET', 
                    dataType: 'json', 
                    success: function(response) {
                        if (response.success) {
                            totalAccount = response.data.totalAccount;
                            $('#totalAccount').text(totalAccount);
                            updateChart(); // Update the chart with the new data
                        } else {
                            console.log('Error fetching total accounts.');
                        }
                    },
                    error: function(xhr, status, error) {
                        console.log('AJAX error: ' + error);
                    }
                });
            }

            function getTotalTeacher() {
                $.ajax({
                    url: '../Controller/getTotalTeacher.php', 
                    type: 'GET', 
                    dataType: 'json', 
                    success: function(response) {
                        if (response.success) {
                            totalTeacher = response.data.totalTeacher;
                            $('#totalTeacher').text(totalTeacher);
                            updateChart(); // Update the chart with the new data
                        } else {
                            console.log('Error fetching total teachers.');
                        }
                    },
                    error: function(xhr, status, error) {
                        console.log('AJAX error: ' + error);
                    }
                });
            }

            function getTotalStudent() {
                $.ajax({
                    url: '../Controller/getTotalStudent.php', 
                    type: 'GET', 
                    dataType: 'json', 
                    success: function(response) {
                        if (response.success) {
                            totalStudent = response.data.totalStudent;
                            $('#totalStudent').text(totalStudent);
                            updateChart(); // Update the chart with the new data
                        } else {
                            console.log('Error fetching total students.');
                        }
                    },
                    error: function(xhr, status, error) {
                        console.log('AJAX error: ' + error);
                    }
                });
            }

            // Function to update the chart with the latest data
            function updateChart() {
                var ctx = document.getElementById('statsChart').getContext('2d');
                if (window.chart) {
                    window.chart.destroy(); // Destroy the existing chart before creating a new one
                }
                window.chart = new Chart(ctx, {
                    type: 'bar', // Type of chart
                    data: {
                        labels: ['Total Accounts', 'Total Teachers', 'Total Students'],
                        datasets: [{
                            label: 'Total Count',
                            data: [totalAccount, totalTeacher, totalStudent],
                            backgroundColor: ['rgba(54, 162, 235, 0.2)', 'rgba(75, 192, 192, 0.2)', 'rgba(153, 102, 255, 0.2)'],
                            borderColor: ['rgba(54, 162, 235, 1)', 'rgba(75, 192, 192, 1)', 'rgba(153, 102, 255, 1)'],
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
            }

            // Call the function to fetch data when the page is ready
            getTotalAccount();
            getTotalTeacher();
            getTotalStudent();
        });
    </script>
</body>
</html>
