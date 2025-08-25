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

$appointmentsQuery = "SELECT * FROM appointments WHERE name = '$username'";
$appointmentsResult = mysqli_query($conn, $appointmentsQuery);

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
    <link rel="stylesheet" href="../CSS/make_appointment.css">
    <script src="../JS/appointment.js" defer></script>
</head>

<body>
    <div class="container">
        <!-- Sidebar -->
        <div class="sidebar">
            <h2>Patient Portal</h2>
            <ul>
                <li><a href="patient_portal.php">Dashboard</a></li>
                <li><a href="make_appointment.php" class="active">Make Appointment</a></li>
                <li><a href="manage_appointment.php">Manage Appointments</a></li>
                <li><a href="lab_reports.php">Lab Reports</a></li>
                <li><a href="medical_records.php">Medical Records</a></li>
                <li><a href="query_submission.php">Query Submission</a></li>
                <li><a href="feedback.php">Feedback Form</a></li>
                <li><a href="portal_payment.php">Payment</a></li>
                <li><a href="logout.php" class="logout">Logout</a></li>
            </ul>
        </div>


        <!-- form -->
        <div class="content">
            <h1><?php echo htmlspecialchars($username); ?>! Welcome to the make appointment</h1>
            <h2>Make Appointments</h2>

            <div class="appointment-form">
                <form id="channeling-form" action="../Backend/appointments.php" method="POST">

                    <input type="text" id="name" name="name" placeholder="Name" required>

                    <input type="email" id="email" name="email" placeholder="Email" required>

                    <input type="text" id="phone" name="phone" placeholder="Contact" required>

                    <select id="branch" name="hospital" required><!-------Hospital selector-->
                        <option value="" disabled selected>Select a Hospital</option>
                        <option value="Kandy">Kandy</option>
                        <option value="Colombo">Colombo</option>
                        <option value="Kurunegala">Kurunegala</option>
                    </select>

                    <select id="department" name="department" required><!-------Department selector-->
                        <option value="" disabled selected>Select a Department</option>
                        <option value="Cardiology">Cardiology</option>
                        <option value="Neurology">Neurology</option>
                        <option value="Orthopedics">Orthopedics</option>
                        <option value="Pulmonology">Pulmonology</option>
                        <option value="Dermatology">Dermatology</option>
                    </select>

                    <select id="doctor" name="doctor" required><!-------Doctor selector-->
                        <option value="" disabled selected> Cardiology</option>
                        <option value="Dr.Ashoka Silva">Dr.Ashoka Silva</option>
                        <option value="Dr.Kamal Prasadh">Dr.Kamal Prasadh</option>
                        <option value="Dr.Robert Brown">Dr.Robert Brown</option>
                        <option value="Dr.Olivia Scot">Dr.Olivia Scott</option>

                        <!--neuro-->
                        <option value="" disabled selected> Neurology</option>
                        <option value="Dr.Richard Harris">Dr.Richard Harris</option>
                        <option value="Dr.Anna Robert">Dr.Anna Roberts</option>
                        <option value="Dr.Ruwantha Bandara">Dr.Ruwantha Bandara</option>

                        <!--Orthopedics-->
                        <option value="" disabled selected> Orthopedics</option>
                        <option value="Dr.Rachel Moore">Dr.Rachel Moore</option>
                        <option value="Dr.Thomas Miller">Dr. Thomas Miller</option>

                        <!--pulmno-->
                        <option value="" disabled selected> Pulmonology</option>
                        <option value="Dr.William Taylor">Dr.William Taylor</option>
                        <option value="Dr.James Anderson">Dr.James Anderson</option>
                        <option value="Dr.Anna Roberts">Dr.Anna Roberts</option>

                        <!--Dermo-->
                        <option value="" disabled selected> Dermatology</option>
                        <option value="Dr.Daniel White">Dr.Daniel White</option>
                        <option value="Dr.Isabel Adams">Dr.Isabel Adams</option>
                        <option value="" disabled selected> Select a Doctor</option>
                    </select>

                    <input type="date" id="appointment_date" name="appointment_date" placeholder="Date" required>
                    <input type="time" id="appointment_time" name="appointment_time" placeholder="time" required>

                    <button id="submit" type="submit">Book Appointment</button>

                </form>
            </div>



            <!---------------------guide content-->
            <div class="content_area">
                <h3>What Can You Do in This Portal?</h3>

                <ul>
                    <li><strong>✔ Select Date & Time</strong> Pick your preferred schedule.</li>
                    <li><strong>✔ Enter Details</strong> Provide patient information.</li>
                    <li><strong>✔ Choose Service</strong> Select the required treatment.</li>
                    <li><strong>✔ Confirm Booking</strong> Finalize your appointment.</li>
                </ul>

            </div>

            <div class="side-image">
                <img src="../IMG/login-img.png" alt="doctor" loading="lazy">
            </div>
        </div>
    </div>
</body>

</html>