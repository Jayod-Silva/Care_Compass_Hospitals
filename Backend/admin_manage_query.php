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

$query = "SELECT * FROM patient_querys";
$staffqueryResult = mysqli_query($conn, $query);


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
                <li><a href="admin_manage_query.php" class="active">Patient's Querys </a></li>
                <li><a href="admin_manage_payment.php">Payment Data</a></li>
                <li><a href="admin_manage_user.php">Manage Users</a></li>
                <li><a href="logout.php" class="logout">Logout</a></li>
            </ul>
        </div>


        <!-- Content -->
        <div class="content">
            <h1>Welcome to the Manage Query</h1>
            <h2>Manage Query</h2>

            <!-- Appointments Table -->
            <table class="appointment-table">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Contact</th>
                        <th>Query type</th>
                        <th>Patient Query</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($staffquery = mysqli_fetch_assoc($staffqueryResult)) { ?>
                        <tr>
                            <td><?php echo htmlspecialchars($staffquery['name']); ?></td>
                            <td><?php echo htmlspecialchars($staffquery['email']); ?></td>
                            <td><?php echo htmlspecialchars($staffquery['contact']); ?></td>
                            <td><?php echo htmlspecialchars($staffquery['query_type']); ?></td>
                            <td><?php echo htmlspecialchars($staffquery['message']); ?></td>
                            
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
