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
    <title>Admin Portal - Dashboard</title>
    <link rel="stylesheet" href="../CSS/admin_portal.css">
</head>

<body>
    <div class="container">
        <!-----------------------------Sidebar -->
        <div class="sidebar">
            <h2>Admin Portal</h2>
            <ul>
                <li><a href="admin_portal.php" class="active">Dashboard</a></li>
                <li><a href="admin_manage_appointments.php">Manage Appointments</a></li>
                <li><a href="admin_manage_query.php">Patient's Querys </a></li>
                <li><a href="admin_manage_payment.php">Payment Data</a></li>
                <li><a href="admin_manage_user.php">Manage Users</a></li>
                <li><a href="logout.php" class="logout">Logout</a></li>
            </ul>
        </div>

        <!----------------------------------------Content -->
        <div class="content">
            <h1> Hello, Welcome to the Admin Portal</h1>
            <div class="grid-container">
                <a href="admin_manage_appointments.php">
                    <button>
                        <h3>Manage Appointments</h3>
                    </button>
                </a>

                <a href="admin_manage_query.php">
                    <button>
                        <h3>Manage Query</h3>
                    </button>
                </a>

                <a href="admin_manage_payment.php">
                    <button>
                        <h3>Manage Payments</h3>
                    </button>
                </a>

                <a href="admin_manage_user.php">
                    <button>
                        <h3>Manage Users</h3>
                    </button>
                </a>


            </div>
             
            <!----------------------------------------guide content -->
            <div class="content_area">
                <h3>What Can You Do in This Portal?</h3>

                <ul>
                    <li><strong>✔ Manage Appointments</strong> View, reschedule, or cancel patient appointments.</li>
                    <li><strong>✔ View Patient Queries</strong> Check and respond to patient inquiries.</li>
                    <li><strong>✔ View Payment Information</strong> Access details of completed payments.</li>
                    <li><strong>✔ Manage User Accounts</strong> Add, update, or remove user accounts as needed.</li>
                </ul>

            </div>


            <div class="side-image">
                <img src="../IMG/admin.png" alt="doctor" loading="lazy">
            </div>
        </div>
    </div>

</body>

</html>