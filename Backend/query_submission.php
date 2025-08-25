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

$submissionQuery = "SELECT * FROM patient_querys WHERE name = '$username'";
$submissionResult = mysqli_query($conn, $submissionQuery);

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
    <link rel="stylesheet" href="../CSS/query_submission.css">
    <script src="../JS/Contact.js" defer></script>
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
                <li><a href="medical_records.php">Medical Records</a></li>
                <li><a href="query_submission.php" class="active">Query Submission</a></li>
                <li><a href="feedback.php">Feedback Form</a></li>
                <li><a href="portal_payment.php">Payment</a></li>
                <li><a href="logout.php" class="logout">Logout</a></li>
            </ul>
        </div>


        <!-- form -->
        <div class="content">
            <h1><?php echo htmlspecialchars($username); ?>! Welcome to the Query Submission</h1>
            <h2>Patient Query Submission</h2>

            <div class="patient-Contact-form">
                <form id="channeling-form" action="../Backend/query.php" method="POST">

                    <input type="text" id="name" name="name" placeholder="Name" required>

                    <input type="email" id="email" name="email" placeholder="Email" required>

                    <input type="text" id="contact" name="contact" placeholder="Contact" required>

                    <select name="query_type" required>
                        <option value="">Select Query Type</option>
                        <option value="appointment">Appointment Request</option>
                        <option value="billing">Billing Inquiry</option>
                        <option value="medical-reports">Medical Reports</option>
                        <option value="other">Other</option>
                    </select>

                    <textarea type="text" id="message" name="message" placeholder="Your Message" required></textarea>

                    <button id="submit" type="submit">Submit</button>

                </form>
            </div>



            <!---------------------guide content-->
            <div class="content_area">
                <h3>What Can You Do in This Portal?</h3>

                <ul>
                    <li><strong>✔ Describe Your Query</strong> Briefly explain your medical concern.</li>
                    <li><strong>✔ Provide Contact Details</strong> Enter your phone number and email.</li>
                    <li><strong>✔ Submit Request</strong> Our team will review and respond promptly.</li>
                </ul>


            </div>

            <div class="side-image">
                <img src="../IMG/Health professional team-amico.png" alt="doctor" loading="lazy">
            </div>
        </div>
    </div>
</body>

</html>