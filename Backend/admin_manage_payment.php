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
    <title>Admin Portal - Dashboard</title>
    <link rel="stylesheet" href="../CSS/staff_manage_appointment.css">
</head>

<body>
    <div class="container">
        <!-- Sidebar -->
        <div class="sidebar">
            <h2>Admin Portal</h2>
            <ul>
                <ul>
                    <li><a href="admin_portal.php">Dashboard</a></li>
                    <li><a href="admin_manage_appointments.php">Manage Appointments</a></li>
                    <li><a href="admin_manage_query.php">Patient's Query</a></li>
                    <li><a href="admin_manage_payment.php" class="active">Payment data</a></li>
                    <li><a href="admin_manage_user.php">Manage Users</a></li>
                    <li><a href="logout.php" class="logout">Logout</a></li>
                </ul>
        </div>


        <!-- Content -->
        <div class="content">
            <h1>Welcome to the Payment Manage</h1>
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
                    <li><strong>✔ View Payment Details</strong> See the details of your paid payments.</li>
                    <li><strong>✔ Payment Status</strong> Check the status of your completed payments.</li>
                </ul>


            </div>

            <div class="side-image">
                <img src="../IMG/Appointment doc.png" alt="doctor" loading="lazy">
            </div>
        </div>
    </div>
</body>

</html>