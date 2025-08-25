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

$query = "SELECT * FROM users";
$staffqueryResult = mysqli_query($conn, $query);


mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Portal - Dashboard</title>
    <link rel="stylesheet" href="../CSS/admin_new_user.css">
</head>

<body>
    <div class="container">
        <!-- Sidebar -->
        <div class="sidebar">
            <h2>Admin Portal</h2>
            <ul>
                <ul>
                    <li><a href="admin_portal.php">Dashboard</a></li>
                    <li><a href="admin_manage_appointments.php">Manage Appointments</a></li>
                    <li><a href="admin_manage_query.php">Patient's Querys </a></li>
                    <li><a href="admin_manage_payment.php">Payment Data</a></li>
                    <li><a href="admin_manage_user.php" class="active">Manage Users</a></li>
                    <li><a href="logout.php" class="logout">Logout</a></li>
                </ul>
        </div>


        <!-- Content -->
        <div class="content">
            <h1>Welcome to the Manage Query</h1>
            <h2>Manage Query</h2>

            <!-- Appointments Table -->
            <table class="appointment-table">
                <thead>
                    <tr>
                        <th>username</th>
                        <th>Email</th>
                        <th>password</th>
                        <th>role</th>
                        <th>Delete user</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($staffquery = mysqli_fetch_assoc($staffqueryResult)) { ?>
                        <tr>
                            <td><?php echo htmlspecialchars($staffquery['username']); ?></td>
                            <td><?php echo htmlspecialchars($staffquery['email']); ?></td>
                            <td><?php echo htmlspecialchars($staffquery['password']); ?></td>
                            <td><?php echo htmlspecialchars($staffquery['role']); ?></td>
                            <td>

                                <form action="delete_user.php" method="POST" onsubmit="return confirm('Are you sure you want to delete this user?');">
                                    <input type="hidden" name="user_id" value="<?php echo $staffquery['user_id']; ?>">
                                    <button type="submit" class="delete-btn">Delete</button>
                                </form>

                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>

            <!---------lab reports -->


            <div class="content_area">
                <h3>What Can You Do in This Portal?</h3>

                <ul>
                    <li><strong>✔ Add New User</strong> Create a new user account with necessary details.</li>
                    <li><strong>✔ Delete User Account</strong> Permanently remove an existing user account.</li>
                    <li><strong>✔ View User Details</strong> Access information about a specific user.</li>
                </ul>


            </div>

            <div class="side-image">
                <img src="../IMG/Appointment doc.png" alt="doctor" loading="lazy">
            </div>
        </div>
    </div>
</body>

</html>