<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: login&regi.php");
    exit();
}

include 'connection.php';

$username = $_SESSION['username'];
$query = "SELECT * FROM users WHERE username = '$username'";
$result = mysqli_query($conn, $query);
$users = mysqli_fetch_assoc($result);

// Update query to match your table's column names
$reportQuery = "SELECT * FROM lab_reports WHERE patient_name = '$username'";
$reportResult = mysqli_query($conn, $reportQuery);



mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Patient Portal - Dashboard</title>
    <link rel="stylesheet" href="../CSS/lab_report.css">
</head>

<body>
    <div class="container">
        <!-- Sidebar -->
        <div class="sidebar">
            <h2>Patient Portal</h2>
            <ul>
                <li><a href="patient_portal.php">Dashboard</a></li>
                <li><a href="make_appointment.php">Make Appointment</a></li>
                <li><a href="manage_appointment.php">Manage Appointments</a></li>
                <li><a href="lab_reports.php" class="active">Lab Reports</a></li>
                <li><a href="medical_records.php">Medical Records</a></li>
                <li><a href="query_submission.php">Query Submission</a></li>
                <li><a href="feedback.php">Feedback Form</a></li>
                <li><a href="portal_payment.php">Payment</a></li>
                <li><a href="logout.php" class="logout">Logout</a></li>
            </ul>
        </div>

        <!--------------------Content -->
        <div class="content">
            <h1><?php echo htmlspecialchars($username); ?>! Welcome to the Lab Reports</h1>
            <h2>Your Lab Reports</h2>

            <!---------------------Lab Reports Table -->
            <table class="appointment-table">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Test Type</th>
                        <th>Test Date</th>
                        <th>Status</th>
                        <th>Result</th>
                    </tr>
                </thead>

                <tbody>
                    <?php while ($labreport = mysqli_fetch_assoc($reportResult)) { ?>
                        <tr>
                            <td><?php echo htmlspecialchars($labreport['patient_name']); ?></td>
                            <td><?php echo htmlspecialchars($labreport['test_name']); ?></td>
                            <td><?php echo htmlspecialchars($labreport['test_date']); ?></td>
                            <td><?php echo htmlspecialchars($labreport['test_status']); ?></td>
                            <td><?php echo htmlspecialchars($labreport['test_result']); ?></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>

            <!---------guide cintent-->
            <div class="content_area">
                <h3>What Can You Do in This Portal?</h3>

                <ul>
                    <li><strong>✔ View Your Lab Reports</strong> Access all your test reports in one place.</li>
                    <li><strong>✔ Check Report Status</strong> Track whether your test results are pending, in progress, or completed.</li>
                </ul>

            </div>

            <div class="side-image">
                <img src="../IMG/labortaory.png" alt="doctor" loading="lazy">
            </div>
        </div>
    </div>
</body>

</html>
