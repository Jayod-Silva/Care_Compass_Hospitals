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

$query = "SELECT * FROM feedback_form";
$feedbackResult = mysqli_query($conn, $query);


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
                    <li><a href="staff_feedback.php" class="active">Feedbacks & reviews</a></li>
                    <li><a href="staff_manage_payment.php">Manage Payment</a></li>
                    <li><a href="logout.php" class="logout">Logout</a></li>
                </ul>
        </div>


        <!-- Content -->
        <div class="content">
            <h1>Welcome to the Patient's Feedbacks</h1>
            <h2>Manage Query</h2>

            <!-- Appointments Table -->
            <table class="appointment-table">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Rating</th>
                        <th>Review</th>

                    </tr>
                </thead>
                <tbody>
                    <?php while ($reviewquery = mysqli_fetch_assoc($feedbackResult)) { ?>
                        <tr>
                            <td><?php echo htmlspecialchars($reviewquery['name']); ?></td>
                            <td><?php echo htmlspecialchars($reviewquery['rating']); ?></td>
                            <td><?php echo htmlspecialchars($reviewquery['message']); ?></td>

                        </tr>
                    <?php } ?>
                </tbody>
            </table>

            <!---------lab reports -->


            <div class="content_area">
                <h3>What Can You Do in This Portal?</h3>

                <ul>
                    <li><strong>✔ View Patient Feedback</strong> Access the reviews and ratings provided by patients.</li>
                    <li><strong>✔ Analyze Feedback Trends</strong> Identify recurring themes or issues from patient reviews.</li>
                </ul>


            </div>

            <div class="side-image">
                <img src="../IMG/Feedback-cuate.png" alt="feedback" loading="lazy">
            </div>
        </div>
    </div>
</body>

</html>