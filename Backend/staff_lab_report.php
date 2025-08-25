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

$query = "SELECT * FROM lab_reports";
$stafflabResult = mysqli_query($conn, $query);

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
    <title>Staff Portal - Dashboard</title>
    <link rel="stylesheet" href="../CSS/staff_lab_report.css">

</head>

<body>
    <div class="container">
        <!-- Sidebar -->
        <div class="sidebar">
            <h2>Staff Portal</h2>
            <ul>
                <li><a href="staff_portal.php">Dashboard</a></li>
                <li><a href="staff_manage_appointment.php">Manage Appointments</a></li>
                <li><a href="staff_lab_report.php" class="active">Lab Reports</a></li>
                <li><a href="staff_medical_records.php">Medical Records</a></li>
                <li><a href="staff_manage_query.php">Manage Query</a></li>
                <li><a href="staff_feedback.php">Feedbacks & reviews</a></li>
                <li><a href="staff_manage_payment.php">Manage Payment</a></li>
                <li><a href="logout.php" class="logout">Logout</a></li>
            </ul>
        </div>


        <!-- form -->
        <div class="content">
            <h1>Welcome to the Lab Reports</h1>
            <h2>Add Patient's Lab Reports </h2>

            <div class="appointment-form">
                <form id="channeling-form" action="../Backend/staff_update_lab_report.php" method="POST">

                    <input type="text" id="patient_name" name="patient_name" placeholder="patient name" required>

                    <select id="test_name" name="test_name" required>
                        <option value="Complete Blood Count">Complete Blood Count</option>
                        <option value="Hemoglobin Test">Hemoglobin Test</option>
                        <option value="Blood Sugar">Blood Sugar</option>
                        <option value="Lipid Profile">Lipid Profile</option>
                        <option value="Urine Routine Test">Urine Routine Test</option>
                        <option value="Liver Function Test">Liver Function Test</option>
                        <option value="Thyroid Function Test">Thyroid Function Test</option>
                        <option value="Pregnancy Confirmation Test">Pregnancy Confirmation Test</option>
                        <option value="Semen Analysis">Semen Analysis</option>
                    </select>

                    <input type="date" id="test_date" name="test_date" placeholder="Test Date" required />

                    <select id="test_status" name="test_status" required>
                        <option value="Pending">Pending</option>
                        <option value="Completed">Completed</option>
                        <option value="Rejected">Rejected</option>
                    </select>

                    <input type="text" id="test_result" name="test_result" placeholder="Test Result">

                    <button id="submit" type="submit">Submit Report</button>

                </form>
            </div>



            <!---------------------guide content-->
            <div class="content_area">
                <h3>What Can You Do in This Portal?</h3>

                <ul>
                    <li><strong>✔ Enter Patient Details</strong> Input patient name, etc.</li>
                    <li><strong>✔ Select Test Type</strong> Choose the lab test being conducted.</li>
                    <li><strong>✔ Input Test Results</strong> Record test findings accurately.</li>
                    <li><strong>✔ Verify & Review</strong> Ensure data accuracy before submission.</li>
                    <li><strong>✔ Submit Report</strong> Save and finalize the lab report.</li>
                    <li><strong>✔ Notify Doctor/Patient</strong> Send results for review or patient notification.</li>
                </ul>


            </div>

            <div class="side-image">
                <img src="../IMG/staff 2.png" alt="doctor" loading="lazy">
            </div>
        </div>
    </div>
</body>

</html>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const params = new URLSearchParams(window.location.search);
        if (params.has("message")) {
            let message = params.get("message");
            if (message === "success") {
                alert("Lab report submitted successfully!");
            } else if (message === "duplicate") {
                alert(
                    "You already Submitted report test on the selected date."
                );
            } else if (message === "error") {
                alert("There was an error booking your report. Please try again.");
            }
            
            history.replaceState({}, document.title, window.location.pathname);
        }
    });
</script>