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

$paymentQuery = "SELECT * FROM patient_payment_details WHERE patient_name = '$username'";
$paymentResult = mysqli_query($conn, $paymentQuery);


mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Patient Portal - Dashboard</title>
    <link rel="stylesheet" href="../CSS/portal_payment.css">
    <script src="../JS/appointment.js" defer></script>
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
                <li><a href="query_submission.php">Query Submission</a></li>
                <li><a href="feedback.php">Feedback Form</a></li>
                <li><a href="portal_payment.php" class="active">Payment</a></li>
                <li><a href="logout.php" class="logout">Logout</a></li>
            </ul>
        </div>


        <!-- form -->
        <div class="content">
            <h1><?php echo htmlspecialchars($username); ?>! Welcome to the Payment</h1>
            <h2>Make Payment</h2>

            <div class="payment-form-container">

                <form class="payment-form" action="../Backend/portal_pay.php" method="POST">

                    <h3 class="title">Patient Info</h3>

                    <div class="flex">
                        <div class="inputBox">
                            <span>Appointment ID</span>
                            <input id="appointment_id" name="appointment_id" type="number" placeholder="No" required>
                        </div>
                        <div class="inputBox">
                            <span>Amount</span>
                            <input id="amount" name="amount" type="number" placeholder="Amount" required>
                        </div>
                    </div>

                    <div class="flex">
                        <div class="inputBox">
                            <span>Department</span>
                            <select id="department" name="department" required>
                                <option value="" disabled selected>Department</option>
                                <option value="Cardiology">Cardiology</option>
                                <option value="Neurology">Neurology</option>
                                <option value="Orthopedics">Orthopedics</option>
                                <option value="Pulmonology">Pulmonology</option>
                                <option value="Dermatology">Dermatology</option>
                            </select>
                        </div>

                        <div class="inputBox">
                            <span>Contact</span>
                            <input id="contact" name="contact" type="text" placeholder="Contact" required>
                        </div>
                    </div>

                    <div class="inputBox">
                        <span>Patient Name</span>
                        <input id="patient_name" name="patient_name" type="text" placeholder="Name" required>
                    </div>

                    <div class="inputBox">
                        <span>Email</span>
                        <input id="email" name="email" type="text" placeholder="example@gmail.com" required>
                    </div>

                    <h3 class="title">payment</h3>

                    <div class="inputBox">
                        <span>cards accepted </span>
                        <img src="../IMG/card_img.png" alt="">
                    </div>
                    <div class="inputBox">
                        <span>name on card </span>
                        <input id="card_name" name="card_name" type="text" placeholder="Enter name on card" required>
                    </div>
                    <div class="inputBox">
                        <span>credit card number </span>
                        <input id="card_number" name="card_number" type="number" placeholder="0000-0000-0000-0000" maxlength="16"
                            required>
                    </div>
                    <div class="inputBox">
                        <span>exp month </span>
                        <select name="month" id="month" placeholder="month">
                            <option value="01">January</option>
                            <option value="02">February</option>
                            <option value="03">March</option>
                            <option value="04">April</option>
                            <option value="05">May</option>
                            <option value="06">June</option>
                            <option value="07">July</option>
                            <option value="08">August</option>
                            <option value="09">September</option>
                            <option value="10">October</option>
                            <option value="11">November</option>
                            <option value="12">December</option>
                        </select>
                    </div>

                    <div class="flex">
                        <div class="inputBox">
                            <span>exp year </span>
                            <input id="exp_year" name="exp_year" type="" placeholder="Year" required>
                        </div>
                        <div class="inputBox">
                            <span>CVV </span>
                            <input id="cvv" name="cvv" type="text" placeholder="Enter CVV" maxlength="4" required>
                        </div>
                    </div>

                    <input type="submit" value="proceed to checkout" class="submit-btn">
                </form>

                <div class="payment-img">
                    <img src="../IMG/Payment Information-cuate.png" alt="online-doc">
                </div>

            </div>
        </div>
    </div>
</body>

</html>