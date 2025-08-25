<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: login&regi.php");
    exit();
}

include 'connection.php';


if (isset($_POST['delete'])) {
    
    $appointment_id = $_POST['id'];


    $query = "DELETE FROM appointments  WHERE id = '$appointment_id'";
    

    if (mysqli_query($conn, $query)) {
        
        echo "<script>alert('Appointment deleted successfully!'); window.location.href = 'admin_manage_appointments.php';</script>";
    } else {
      
        echo "<script>alert('Error deleting appointment: " . mysqli_error($conn) . "'); window.location.href = 'admin_manage_appointments.php';</script>";
    }
}


mysqli_close($conn);
?>
