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

// ----------Update query to match tables column names
$reportQuery = "SELECT * FROM medical_records WHERE patient_name = '$username'";
$reportResult = mysqli_query($conn, $reportQuery);

if (isset($_GET['status'])) {
    $status = $_GET['status'];
    if ($status == 'success') {
        echo "<script>alert('Appointment updated successfully!');</script>";
    } else if ($status == 'error') {
        echo "<script>alert('Error occurred while updating appointment!');</script>";
    }
}

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
                <li><a href="lab_reports.php">Lab Reports</a></li>
                <li><a href="medical_records.php" class="active">Medical Records</a></li>
                <li><a href="query_submission.php">Query Submission</a></li>
                <li><a href="feedback.php">Feedback Form</a></li>
                <li><a href="portal_payment.php">Payment</a></li>
                <li><a href="logout.php" class="logout">Logout</a></li>
            </ul>
        </div>

        <!-- Content -->
        <div class="content">
            <h1><?php echo htmlspecialchars($username); ?>! Welcome to the Lab Reports</h1>
            <h2>Your Lab Reports</h2>

            <!-- Lab Reports Table -->
            <table class="appointment-table">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Age</th>
                        <th>Gender</th>
                        <th>Height(cm)</th>
                        <th>Weight(kg)</th>
                        <th>Blood pressure</th>
                        <th>Pulse rate</th>
                        <th>Oxygen Saturation</th>
                        <th>Hemoglobin</th>
                        <th>Diagnosis</th>
                        <th>Prescribed Medication</th>
                        <th>Next Appointment date</th>
                    </tr>
                </thead>

                <tbody>
                    <?php while ($labreport = mysqli_fetch_assoc($reportResult)) { ?>
                        <tr>
                            <td><?php echo htmlspecialchars($labreport['patient_name']); ?></td>
                            <td><?php echo htmlspecialchars($labreport['patient_age']); ?></td>
                            <td><?php echo htmlspecialchars($labreport['gender']); ?></td>
                            <td><?php echo htmlspecialchars($labreport['height']); ?></td>
                            <td><?php echo htmlspecialchars($labreport['weight']); ?></td>
                            <td><?php echo htmlspecialchars($labreport['blood_pressure']); ?></td>
                            <td><?php echo htmlspecialchars($labreport['pulse_rate']); ?></td>
                            <td><?php echo htmlspecialchars($labreport['oxygen']); ?></td>
                            <td><?php echo htmlspecialchars($labreport['hemoglobin']); ?></td>
                            <td><?php echo htmlspecialchars($labreport['diagnosis']); ?></td>
                            <td><?php echo htmlspecialchars($labreport['prescribed_medi']); ?></td>
                            <td><?php echo htmlspecialchars($labreport['next_appointment']); ?></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>

        </div>
    </div>
</body>

</html>
