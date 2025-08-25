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

$feedbackQuery = "SELECT * FROM feedback_form WHERE name = '$username'";
$feedbackResult = mysqli_query($conn, $feedbackQuery);

mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Patient Portal - Dashboard</title>
    <link rel="stylesheet" href="../CSS/feedback.css">
    <script src="../JS/Contact.js" defer></script>
</head>

<body>
    <div class="container">
        <!--------------------------------Sidebar -->
        <div class="sidebar">
            <h2>Patient Portal</h2>
            <ul>
                <li><a href="patient_portal.php">Dashboard</a></li>
                <li><a href="make_appointment.php">Make Appointment</a></li>
                <li><a href="manage_appointment.php">Manage Appointments</a></li>
                <li><a href="lab_reports.php">Lab Reports</a></li>
                <li><a href="medical_records.php">Medical Records</a></li>
                <li><a href="query_submission.php">Query Submission</a></li>
                <li><a href="feedback.php" class="active">Feedback Form</a></li>
                <li><a href="portal_payment.php">Payment</a></li>
                <li><a href="logout.php" class="logout">Logout</a></li>
            </ul>
        </div>


        <!----------------------------------form -->
        <div class="content">
            <h1><?php echo htmlspecialchars($username); ?>! Welcome to the Feedback Form</h1>
            <h2>Patient Feedback</h2>

            <div class="patient-feedback-form">
                <form id="feedback-form" action="../Backend/rating.php" method="POST">

                    <input type="text" id="name" name="name" placeholder="Name" required>

                    <select id="rating" name="rating" required>
                        <option value="⭐">⭐</option>
                        <option value="⭐⭐">⭐⭐</option>
                        <option value="⭐⭐⭐">⭐⭐⭐</option>
                        <option value="⭐⭐⭐⭐">⭐⭐⭐⭐</option>
                        <option value="⭐⭐⭐⭐⭐">⭐⭐⭐⭐⭐</option>
                    </select>

                    <textarea type="text" id="message" name="message" placeholder="your feedback here" required></textarea>

                    <button id="submit" type="submit">Submit</button>

                </form>
            </div>



            <!---------------------guide content-->
            <div class="content_area">
                <h3>What Can You Do in The Feedback Form?</h3>

                <ul>
                    <li><strong>✔ Share Your Experience</strong> Let us know your thoughts about our service.</li>
                    <li><strong>✔ Rate the Hospital</strong> Select a star rating based on your satisfaction.</li>
                    <li><strong>✔ Leave a Message</strong> Provide any additional comments or suggestions.</li>
                    <li><strong>✔ Submit Your Feedback</strong> Your review helps us improve our services.</li>
                </ul>

            </div>

            <div class="side-image">
                <img src="../IMG/Feedback-cuate.png" alt="doctor" loading="lazy">
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
                alert("Your feedback has been booked successfully! Thank you for the help!!!");
            } else if (message === "duplicate") {
                alert(
                    "You already Submitted the Feedback."
                );
            } else if (message === "error") {
                alert("There was an error submitting. Please try again.");
            }
            // Remove query parameters from the URL after showing the message
            history.replaceState({}, document.title, window.location.pathname);
        }
    });
</script>