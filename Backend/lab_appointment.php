<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    include("connection.php");

    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $test_type = $_POST['test_type'];
    $lab_branch = $_POST['lab_branch'];
    $test_date = $_POST['test_date'];
    $test_time = $_POST['test_time'];

    
    $check_sql = "SELECT * FROM lab_appointments WHERE email = '$email' AND test_type = '$test_type' AND lab_branch = '$lab_branch' AND test_date = '$test_date'";
    $result = mysqli_query($conn, $check_sql);

    if (mysqli_num_rows($result) > 0) {
        
        header("Location: ../HTML/Laboratory.html?message=duplicate");
        exit();
    } else {
        // ----------------Insert new appointment
        $sql = "INSERT INTO lab_appointments 
        (name, email, phone, test_type, lab_branch, test_date, test_time)
        VALUES ('$name', '$email', '$phone', '$test_type', '$lab_branch','$test_date', '$test_time')";

        if (mysqli_query($conn, $sql)) {
            // -----------------Redirect to form resubmission on refresh
            header("Location: ../HTML/Laboratory.html?message=success");
            exit();
        } else {
            // ------------------Redirect to form resubmission on refresh
            header("Location: ../HTML/Laboratory.html?message=error");
            exit();
        }
    }
} else {
    echo "Please make sure to fill out the form.";
}
