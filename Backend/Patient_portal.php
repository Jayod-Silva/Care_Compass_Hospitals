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
    <title>Patient Portal - Dashboard</title>
    <link rel="stylesheet" href="../CSS/patient_portal.css">
</head>

<body>
    <div class="container">
        <!---------------------------------------Sidebar -->
        <div class="sidebar">
            <h2>Patient Portal</h2>
            <ul>
                <li><a href="patient_portal.php" class="active">Dashboard</a></li>
                <li><a href="make_appointment.php">Make Appointment</a></li>
                <li><a href="manage_appointment.php">Manage Appointments</a></li>
                <li><a href="lab_reports.php">Lab Reports</a></li>
                <li><a href="medical_records.php">Medical Records</a></li>
                <li><a href="query_submission.php">Query Submission</a></li>
                <li><a href="feedback.php">Feedback Form</a></li>
                <li><a href="portal_payment.php">Payment</a></li>
                <li><a href="logout.php" class="logout">Logout</a></li>
            </ul>
        </div>

        <!-----------------------------------------------Content -->
        <div class="content">
            <h1> Hello, <?php echo htmlspecialchars($username); ?>!!!<br> Welcome to the Patient Portal</h1>
            <div class="grid-container">
            <a href="make_appointment.php">
                <button>
                    <h3>Make Appointments</h3>
                </button>
            </a>

            <a href="lab_reports.php">
                <button>
                    <h3>Lab Reports</h3>
                </button>
            </a>

            <a href="medical_records.php">
                <button>
                    <h3>Medical Records</h3>
                </button>
            </a>

            <a href="query_submission.php">
                <button>
                    <h3>Patient Query</h3>
                </button>
            </a>

            <a href="feedback.php">
                <button>
                    <h3>FeedBack</h3>
                </button>
            </a>

            <a href="portal_payment.php">
                <button>
                    <h3>Make Payments</h3>
                </button>
            </a>

            </div>

            <div class="content_area">
                <h3>What Can You Do in This Portal?</h3>

                <ul>
                    <li><strong>✔ Manage Appointments</strong> Book, reschedule, or cancel.</li>
                    <li><strong>✔ View Lab Reports</strong> Access and download test results.</li>
                    <li><strong>✔ Check Medical Records</strong> View prescriptions and treatments.</li>
                    <li><strong>✔ Submit Queries</strong> Contact hospital staff or doctors.</li>
                    <li><strong>✔ Provide Feedback</strong> Share your experience.</li>
                    <li><strong>✔ Make Payments</strong>Pay bills securely online.</li>
                </ul>
            </div>

            <div class="side-image">
                <img src="../IMG/doctor 1.png" alt="doctor" loading="lazy">
            </div>
        </div>
    </div>

</body>

</html>
