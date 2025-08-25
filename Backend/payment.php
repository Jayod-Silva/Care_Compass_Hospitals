<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    include("connection.php");

    $appointment_id = $_POST['appointment_id'];
    $amount = $_POST['amount'];
    $department = $_POST['department'];
    $contact = $_POST['contact'];
    $patient_name = $_POST['patient_name'];
    $email = $_POST['email'];
    $card_name = $_POST['card_name'];
    $card_number = $_POST['card_number'];
    $exp_month = $_POST['exp_month'];
    $exp_year = $_POST['exp_year'];
    $cvv = $_POST['cvv'];

    //------------------stop duplicate payments
    $check_sql = "SELECT * FROM patient_payment_details WHERE appointment_no = '$appointment_id' AND email = '$email'";
    $result = mysqli_query($conn, $check_sql);

    if (mysqli_num_rows($result) > 0) {
        // ---------------------Redirect to avoid duplicate submission issue
        header("Location: ../HTML/payment.html?message=duplicate");
        exit();
    } else {
        // ----------------------------------------Insert details 
        $sql = "INSERT INTO patient_payment_details 
        (appointment_no, amount, department, contact, patient_name, email, payment_status, created_at)
        VALUES ('$appointment_id', '$amount', '$department', '$contact', '$patient_name', '$email', 'Paid', NOW())";

        if (mysqli_query($conn, $sql)) {
           
            header("Location: ../HTML/payment.html?message=success");
            exit();
        } else {
            
            header("Location: ../HTML/payment.html?message=error");
            exit();
        }
    }
} else {
    echo "Please make sure to fill out the form.";
}
