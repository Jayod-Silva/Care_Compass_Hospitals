<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: login&regi.php");
    exit();
}
 

include 'connection.php';

//--------------------------------------Get data from the POST request
$appointment_id = $_POST['id'];
$name = $_POST['name'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$branch = $_POST['branch'];
$department = $_POST['department'];
$doctor = $_POST['doctor'];
$appointment_date = $_POST['appointment_date'];
$appointment_time = $_POST['appointment_time'];

// ---------------------------------------fields emplty cheking
if (empty($name) || empty($email) || empty($phone) || empty($branch) || empty($department) || empty($doctor) || empty($appointment_date) || empty($appointment_time)) {
    echo "<script>alert('All fields are required!'); window.location.href = 'manage_appointment.php';</script>";
    exit();
}

//-------------------------------Prepare to update the appointment
$query = "UPDATE appointments SET 
            name = '$name', 
            email = '$email', 
            phone = '$phone', 
            branch = '$branch', 
            department = '$department', 
            doctor = '$doctor', 
            appointment_date = '$appointment_date', 
            appointment_time = '$appointment_time'
          WHERE id = '$appointment_id'";


if (mysqli_query($conn, $query)) {
    echo "<script>alert('Appointment updated successfully!'); window.location.href = 'manage_appointment.php';</script>";
} else {
    echo "<script>alert('Error updating appointment: " . mysqli_error($conn) . "'); window.location.href = 'manage_appointment.php';</script>";
}


mysqli_close($conn);
?>
