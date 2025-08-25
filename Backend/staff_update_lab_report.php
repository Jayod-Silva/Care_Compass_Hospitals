<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    include("connection.php");

    $patient_name = $_POST['patient_name'];
    $test_name = $_POST['test_name'];
    $test_date = $_POST['test_date'];
    $test_status = $_POST['test_status'];
    $test_result = $_POST['test_result'];

    
    $check_sql = "SELECT * FROM lab_reports WHERE patient_name = '$patient_name' AND test_name = '$test_name' AND test_date = '$test_date'";
    $result = mysqli_query($conn, $check_sql);

    if (mysqli_num_rows($result) > 0) {
       
        header("Location: ../Backend/staff_lab_report.php?message=duplicate");
        exit();
    } else {
        //------------------ Insert new test record
        $sql = "INSERT INTO lab_reports (patient_name, test_name, test_date, test_status, test_result) 
                VALUES ('$patient_name', '$test_name', '$test_date', '$test_status', '$test_result')";

        if (mysqli_query($conn, $sql)) {
            header("Location: ../Backend/staff_lab_report.php?message=success");
            exit();
        } else {
            header("Location: ../Backend/staff_lab_report.php?message=error");
            exit();
        }
    }
} else {
    echo "Please make sure to fill out the form.";
}
?>
