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

$query = "SELECT * FROM appointments";
$appointmentsResult = mysqli_query($conn, $query);

$labQuery = "SELECT * FROM lab_appointments";
$labResult = mysqli_query($conn, $labQuery);

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
    <title>Admin Portal - Dashboard</title>
    <link rel="stylesheet" href="../CSS/staff_manage_appointment.css">
</head>

<body>
    <div class="container">
        <!-- Sidebar -->
        <div class="sidebar">
            <h2>Admin Portal</h2>
            <ul>
                <ul>
                <li><a href="admin_portal.php" >Dashboard</a></li>
                <li><a href="admin_manage_appointments.php" class="active">Manage Appointments</a></li>
                <li><a href="admin_manage_query.php">Patient's Querys </a></li>
                <li><a href="admin_manage_payment.php">Payment Data</a></li>
                <li><a href="admin_manage_user.php">Manage Users</a></li>
                <li><a href="logout.php" class="logout">Logout</a></li>
                </ul>
        </div>


        <!-- Content -->
        <div class="content">
            <h1>Welcome to the Manage Appointmet</h1>
            <h2>Manage Appointments</h2>

            <!-- Appointments Table -->
            <table class="appointment-table">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Branch</th>
                        <th>Department</th>
                        <th>Doctor</th>
                        <th>Appointment Date</th>
                        <th>Appointment Time</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($appointment = mysqli_fetch_assoc($appointmentsResult)) { ?>
                        <tr>
                            <td><?php echo htmlspecialchars($appointment['name']); ?></td>
                            <td><?php echo htmlspecialchars($appointment['email']); ?></td>
                            <td><?php echo htmlspecialchars($appointment['phone']); ?></td>
                            <td><?php echo htmlspecialchars($appointment['branch']); ?></td>
                            <td><?php echo htmlspecialchars($appointment['department']); ?></td>
                            <td><?php echo htmlspecialchars($appointment['doctor']); ?></td>
                            <td><?php echo htmlspecialchars($appointment['appointment_date']); ?></td>
                            <td><?php echo htmlspecialchars($appointment['appointment_time']); ?></td>
                            <td><?php echo htmlspecialchars($appointment['status']); ?></td>
                            <td>
                                <!-- Edit Button -->
                                <button class="edit-btn" data-id="<?php echo $appointment['id']; ?>"
                                    data-name="<?php echo htmlspecialchars($appointment['name']); ?>"
                                    data-email="<?php echo htmlspecialchars($appointment['email']); ?>"
                                    data-phone="<?php echo htmlspecialchars($appointment['phone']); ?>"
                                    data-branch="<?php echo htmlspecialchars($appointment['branch']); ?>"
                                    data-department="<?php echo htmlspecialchars($appointment['department']); ?>"
                                    data-doctor="<?php echo htmlspecialchars($appointment['doctor']); ?>"
                                    data-date="<?php echo $appointment['appointment_date']; ?>"
                                    data-time="<?php echo $appointment['appointment_time']; ?>"
                                    status="<?php echo $appointment['status']; ?>"
                                    onclick="openEditModal(this)">Edit</button>

                                <!-- Cancel Appointment Form -->
                                <form method="POST" action="delete_appointments.php" style="display:inline;">
                                    <input type="hidden" name="id" value="<?php echo $appointment['id']; ?>">
                                    <button type="submit" name="delete" class="delete-btn">Delete</button>
                                </form>

                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>

            <!-- Edit Modal -->
            <div id="editModal" class="modal">
                <div class="modal-content">
                    <span class="close" onclick="closeEditModal()">&times;</span>
                    <h2>Edit Appointment</h2>
                    <form id="editForm" method="POST" action="update_appointment.php">
                        <input type="hidden" name="id" id="editId">
                        <label for="name">Name</label>
                        <input type="text" id="editName" name="name" required>

                        <label for="email">Email</label>
                        <input type="email" id="editEmail" name="email" required>

                        <label for="phone">Phone</label>
                        <input type="text" id="editPhone" name="phone" required>

                        <label for="branch">Branch</label>
                        <input type="text" id="editBranch" name="branch" required>

                        <label for="department">Department</label>
                        <input type="text" id="editDepartment" name="department" required>

                        <label for="doctor">Doctor</label>
                        <input type="text" id="editDoctor" name="doctor" required>

                        <label for="date">Appointment Date</label>
                        <input type="date" id="editDate" name="appointment_date" required>

                        <label for="time">Appointment Time</label>
                        <input type="time" id="editTime" name="appointment_time" required>

                        <button type="submit">Save Changes</button>
                    </form>
                </div>
            </div>

            <h2>Lab Appointments</h2>

            <table class="lab-table">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>test type</th>
                        <th>lab branch</th>
                        <th>test date</th>
                        <th>test time</th>

                    </tr>
                </thead>
                <tbody>
                    <?php while ($labappointment = mysqli_fetch_assoc($labResult)) { ?>
                        <tr>
                            <td><?php echo htmlspecialchars($labappointment['name']); ?></td>
                            <td><?php echo htmlspecialchars($labappointment['email']); ?></td>
                            <td><?php echo htmlspecialchars($labappointment['phone']); ?></td>
                            <td><?php echo htmlspecialchars($labappointment['test_type']); ?></td>
                            <td><?php echo htmlspecialchars($labappointment['lab_branch']); ?></td>
                            <td><?php echo htmlspecialchars($labappointment['test_date']); ?></td>
                            <td><?php echo htmlspecialchars($labappointment['test_time']); ?></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>


            <!---------lab reports -->


            <div class="content_area">
                <h3>What Can You Do in This Portal?</h3>

                <ul>
                    <li><strong>✔ Reschedule Appointment</strong> Modify Patients appointment date or time.</li>
                    <li><strong>✔ Delete Appointment</strong> Delete an existing booking if needed.</li>
                    <li><strong>✔ View Appointment Details</strong> Check scheduled appointments status.</li>
                </ul>

            </div>

            <div class="side-image">
                <img src="../IMG/Appointment doc.png" alt="doctor" loading="lazy">
            </div>
        </div>
    </div>
</body>

</html>

<script>
    function openEditModal(button) {
        document.getElementById('editId').value = button.getAttribute('data-id');
        document.getElementById('editName').value = button.getAttribute('data-name');
        document.getElementById('editEmail').value = button.getAttribute('data-email');
        document.getElementById('editPhone').value = button.getAttribute('data-phone');
        document.getElementById('editBranch').value = button.getAttribute('data-branch');
        document.getElementById('editDepartment').value = button.getAttribute('data-department');
        document.getElementById('editDoctor').value = button.getAttribute('data-doctor');
        document.getElementById('editDate').value = button.getAttribute('data-date');
        document.getElementById('editTime').value = button.getAttribute('data-time');
        document.getElementById('editModal').style.display = "block";
    }

    function closeEditModal() {
        document.getElementById('editModal').style.display = "none";
    }
</script>