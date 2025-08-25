<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: login&regi.php");
    exit();
}

include 'connection.php';


if (isset($_POST['cancel'])) {
 
    $appointment_id = $_POST['id'];

    
    $query = "UPDATE appointments SET status = 'Cancelled' WHERE id = '$appointment_id'";

    if (mysqli_query($conn, $query)) {
        
        echo "<script>alert('Appointment cancelled successfully!'); window.location.href = 'staff_manage_appointment.php';</script>";
    } else {
        
        echo "<script>alert('Error cancelling appointment: " . mysqli_error($conn) . "'); window.location.href = 'staff_manage_appointment.php';</script>";
    }
}


mysqli_close($conn);
?>
