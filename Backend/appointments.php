<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    include("connection.php");

    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $branch = $_POST['hospital'];
    $department = $_POST['department'];
    $doctor = $_POST['doctor'];
    $appointment_date = $_POST['appointment_date'];
    $appointment_time = $_POST['appointment_time'];

    
    $check_sql = "SELECT * FROM appointments WHERE email = '$email' AND doctor = '$doctor' AND appointment_date = '$appointment_date'";
    $result = mysqli_query($conn, $check_sql);

    if (mysqli_num_rows($result) > 0) {
        
        header("Location: ../Backend/make_appointment.php?message=duplicate");
        exit();
    } else {
        // ------------Insert new appointment
        $sql = "INSERT INTO appointments 
        (name, email, phone, branch, department, doctor, appointment_date, appointment_time)
        VALUES ('$name', '$email', '$phone', '$branch', '$department', '$doctor', '$appointment_date', '$appointment_time')";

        if (mysqli_query($conn, $sql)) {
         
            header("Location: ../Backend/make_appointment.php?message=success");
            exit();
        } else {
            
            header("Location: ../Backend/make_appointment.php?message=error");
            exit();
        }
    }
} else {
    echo "Please make sure to fill out the form.";
}
