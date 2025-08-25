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

$query = "SELECT * FROM medical_records";
$staffrecordResult = mysqli_query($conn, $query);

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
    <link rel="stylesheet" href="../CSS/staff_medical_records.css">
    
</head>

<body>
    <div class="container">
        <!-- Sidebar -->
        <div class="sidebar">
            <h2>Staff Portal</h2>
            <ul>
                <li><a href="staff_portal.php">Dashboard</a></li>
                <li><a href="staff_manage_appointment.php">Manage Appointments</a></li>
                <li><a href="staff_lab_report.php">Lab Reports</a></li>
                <li><a href="staff_medical_records.php" class="active">Medical Records</a></li>
                <li><a href="staff_manage_query.php">Manage Query</a></li>
                <li><a href="staff_feedback.php">Feedbacks & reviews</a></li>
                <li><a href="staff_manage_payment.php">Manage Payment</a></li>
                <li><a href="logout.php" class="logout">Logout</a></li>
            </ul>
        </div>


        <!-- form -->
        <div class="content">
            <h1>Welcome to the Medical Records</h1>
            <h2>Add Patient's medical Records </h2>

            <div class="medical-form">
                <form id="channeling-form" action="../Backend/staff_update_medical_records.php" method="POST">

                    <input type="text" id="patient_name" name="patient_name" placeholder="Patient Name" required>

                    <input type="number" id="patient_age" name="patient_age" placeholder="Patient Age" required>

                    <select id="gender" name="gender" required>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                        <option value="Other">Other</option>
                    </select>

                    <input type="text" id="height" name="height" placeholder="Height (e.g., 170 cm)" required>

                    <input type="text" id="weight" name="weight" placeholder="Weight (e.g., 70 kg)" required>

                    <input type="text" id="blood_pressure" name="blood_pressure" placeholder="Blood Pressure (e.g., 120/80)" required>

                    <input type="number" id="pulse_rate" name="pulse_rate" placeholder="Pulse Rate (bpm)" required>

                    <input type="text" id="oxygen" name="oxygen" placeholder="Oxygen Saturation (%)" required>

                    <input type="text" id="hemoglobin" name="hemoglobin" placeholder="Hemoglobin Level (g/dL)" required>

                    <textarea id="diagnosis" name="diagnosis" placeholder="Diagnosis Details" required></textarea>

                    <textarea id="prescribed_medi" name="prescribed_medi" placeholder="Prescribed Medications" required></textarea>

                    <input type="date" id="next_appointment" name="next_appointment" required>

                    <button id="submit" type="submit">Save Record</button>

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
                <img src="../IMG/staff 3.png" alt="doctor" loading="lazy">
            </div>
        </div>
    </div>
</body>

</html>

<script>
    
document.addEventListener("DOMContentLoaded", function () {
  const params = new URLSearchParams(window.location.search);
  if (params.has("message")) {
    let message = params.get("message");
    if (message === "success") {
      alert("Medical Record has been booked successfully!");
    } else if (message === "duplicate") {
      alert(
        "You already have an medical record with this on the selected date."
      );
    } else if (message === "error") {
      alert("There was an error booking your Submitting. Please try again.");
    }
    // Remove query parameters from the URL after showing the message
    history.replaceState({}, document.title, window.location.pathname);
  }
});

</script>