<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    include("connection.php");

    $patient_name = $_POST['patient_name'];
    $patient_age = $_POST['patient_age'];
    $gender = $_POST['gender'];
    $height = $_POST['height'];
    $weight = $_POST['weight'];
    $blood_pressure = $_POST['blood_pressure'];
    $pulse_rate = $_POST['pulse_rate'];
    $oxygen = $_POST['oxygen'];
    $hemoglobin = $_POST['hemoglobin'];
    $diagnosis = $_POST['diagnosis'];
    $prescribed_medi = $_POST['prescribed_medi'];
    $next_appointment = $_POST['next_appointment'];


    $check_sql = "SELECT * FROM medical_records WHERE patient_name = '$patient_name' AND next_appointment = '$next_appointment'";
    $result = mysqli_query($conn, $check_sql);

    if (mysqli_num_rows($result) > 0) {
        
        header("Location: ../Backend/staff_medical_records.php?message=duplicate");
        exit();
    } else {
        //-------------------------Insert new test record
        $sql = "INSERT INTO medical_records (patient_name, patient_age, gender, height, weight, blood_pressure, pulse_rate, oxygen, hemoglobin, diagnosis, prescribed_medi, next_appointment) 
                VALUES ('$patient_name', '$patient_age', '$gender', '$height', '$weight', '$blood_pressure', '$pulse_rate', '$oxygen', '$hemoglobin', '$diagnosis', '$prescribed_medi', '$next_appointment')";

        if (mysqli_query($conn, $sql)) {
            header("Location: ../Backend/staff_medical_records.php?message=success");
            exit();
        } else {
            header("Location: ../Backend/staff_medical_records.php?message=error");
            exit();
        }
    }
} else {
    echo "Please make sure to fill out the form.";
}
?>
