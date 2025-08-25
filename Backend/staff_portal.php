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

mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Staff Portal - Dashboard</title>
    <link rel="stylesheet" href="../CSS/staff_portal.css">
</head>

<body>
    <div class="container">
        <!-----------------------------------Sidebar -->
        <div class="sidebar">
            <h2>Staff Portal</h2>
            <ul>
                <li><a href="staff_portal.php" class="active">Dashboard</a></li>
                <li><a href="staff_manage_appointment.php">Manage Appointments</a></li>
                <li><a href="staff_lab_report.php">Lab Reports</a></li>
                <li><a href="staff_medical_records.php">Medical Records</a></li>
                <li><a href="staff_manage_query.php">Manage Query</a></li>
                <li><a href="staff_feedback.php">Feedbacks & reviews</a></li>
                <li><a href="staff_manage_payment.php">Manage Payment</a></li>
                <li><a href="logout.php" class="logout">Logout</a></li>
            </ul>
        </div>

        <!------------------------------------Content -->
        <div class="content">
            <h1> Hello, Welcome to the Staff Portal</h1>
            <div class="grid-container">
                <a href="staff_manage_appointment.php">
                    <button>
                        <h3>Manage Appointments</h3>
                    </button>
                </a>

                <a href="staff_lab_report.php">
                    <button>
                        <h3>Lab Reports</h3>
                    </button>
                </a>

                <a href="staff_medical_records.php">
                    <button>
                        <h3>Medical Records</h3>
                    </button>
                </a>

                <a href="staff_manage_query.php">
                    <button>
                        <h3>Manage Query</h3>
                    </button>
                </a>

                <a href="staff_manage_payment.php">
                    <button>
                        <h3>Manage Payments</h3>
                    </button>
                </a>

            </div>

            <!--------------------------------guide cintent-->

            <div class="content_area">
                <h3>What Can You Do in This Portal?</h3>

                <ul>
                    <li><strong>✔ Manage Appointments</strong> Schedule, update, or cancel patient bookings.</li>
                    <li><strong>✔ Manage Lab Reports</strong> Upload, update, and review test results.</li>
                    <li><strong>✔ Manage Medical Records</strong> Maintain patient prescriptions and treatment details.</li>
                    <li><strong>✔ Manage Payments</strong> Process and verify patient transactions securely.</li>
                </ul>
            </div>


            <div class="side-image">
                <img src="../IMG/staff 1.png" alt="doctor" loading="lazy">
            </div>
        </div>
    </div>

</body>

</html>