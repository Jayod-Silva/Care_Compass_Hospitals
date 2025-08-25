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

$query = "SELECT * FROM patient_payment_details";
$patientpayResult = mysqli_query($conn, $query);


mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Staff Portal - Dashboard</title>
    <link rel="stylesheet" href="../CSS/staff_manage_appointment.css">
</head>

<body>
    <div class="container">
        <!-- Sidebar -->
        <div class="sidebar">
            <h2>Staff Portal</h2>
            <ul>
            <ul>
                <li><a href="staff_portal.php">Dashboard</a></li>
                <li><a href="staff_manage_appointment.php">Manage Appointments</a></li>
                <li><a href="staff_lab_report.php">Lab Reports</a></li>
                <li><a href="staff_medical_records.php">Medical Records</a></li>
                <li><a href="staff_manage_query.php">Manage Query</a></li>
                <li><a href="staff_feedback.php">Feedbacks & reviews</a></li>
                <li><a href="staff_manage_payment.php"class="active">Manage Payment</a></li>
                <li><a href="logout.php" class="logout">Logout</a></li>
            </ul>
        </div>


        <!-- Content -->
        <div class="content">
            <h1>Welcome to the Staff Payment Manage</h1>
            <h2>Payment Manage</h2>

            <!-- Appointments Table -->
            <table class="appointment-table">
                <thead>
                    <tr>
                        <th>Appointment No</th>
                        <th>Patient Name</th>
                        <th>Paid Amount</th>
                        <th>Department</th>
                        <th>Email</th>
                        <th>Contact</th>
                        <th>Payment Status</th>
                        
                    </tr>
                </thead>
                <tbody>
                    <?php while ($staffquery = mysqli_fetch_assoc($patientpayResult)) { ?>
                        <tr>
                            <td><?php echo htmlspecialchars($staffquery['appointment_no']); ?></td>
                            <td><?php echo htmlspecialchars($staffquery['patient_name']); ?></td>
                            <td><?php echo htmlspecialchars($staffquery['amount']); ?></td>
                            <td><?php echo htmlspecialchars($staffquery['department']); ?></td>
                            <td><?php echo htmlspecialchars($staffquery['email']); ?></td>
                            <td><?php echo htmlspecialchars($staffquery['contact']); ?></td>
                            <td><?php echo htmlspecialchars($staffquery['payment_status']); ?></td>
                            
                        </tr>
                    <?php } ?>
                </tbody>
            </table>

            <!---------lab reports -->
            

            <div class="content_area">
                <h3>What Can You Do in This Portal?</h3>

                <ul>
                    <li><strong>✔ Reschedule Appointment</strong> Modify your appointment date or time.</li>
                    <li><strong>✔ Cancel Appointment</strong> Remove an existing booking if needed.</li>
                    <li><strong>✔ View Appointment Details</strong> Check your scheduled appointment status.</li>
                </ul>

            </div>

            <div class="side-image">
                <img src="../IMG/Appointment doc.png" alt="doctor" loading="lazy">
            </div>
        </div>
    </div>
</body>

</html>
