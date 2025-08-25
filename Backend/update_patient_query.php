<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: login&regi.php");
    exit();
}
 

include 'connection.php';

//---------------------------Get data from the POST request
$patient_id = $_POST['id'];
$name = $_POST['name'];
$email = $_POST['email'];
$contact = $_POST['contact'];
$query_type = $_POST['query_type'];
$message = $_POST['message'];




if (empty($name) || empty($email) || empty($contact) || empty($query_type) || empty($message)) {
    echo "<script>alert('All fields are required!'); window.location.href = 'staff_manage_query.php';</script>";
    exit();
}

// ----------------------query to update the appointment
$query = "UPDATE patient_querys SET 
            name = '$name', 
            email = '$email', 
            contact = '$contact',
            query_type = '$query_type', 
            message = '$message'
          WHERE id = '$patient_id'";


if (mysqli_query($conn, $query)) {
    echo "<script>alert('Appointment updated successfully!'); window.location.href = 'staff_manage_query.php';</script>";
} else {
    echo "<script>alert('Error updating appointment: " . mysqli_error($conn) . "'); window.location.href = 'staff_manage_query.php';</script>";
}


mysqli_close($conn);
?>
