<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    include("connection.php");

    $name = $_POST['name'];
    $email = $_POST['email'];
    $contact = $_POST['contact'];
    $query_type = $_POST['query_type'];
    $message = $_POST['message'];
   

    //------------------stop duplicate appointment
    $check_sql = "SELECT * FROM patient_querys WHERE name = 'name' AND email = '$email'";
    $result = mysqli_query($conn, $check_sql);

    if (mysqli_num_rows($result) > 0) {
        // -----------------Redirect to stoping duplicate submission 
        header("Location: ../Backend/query_submission.php?message=duplicate");
        exit();
    } else {
        // ------------Insert new query
        $sql = "INSERT INTO patient_querys
        (name, email, contact, query_type, message)
        VALUES ('$name', '$email', '$contact','$query_type','$message')";

        if (mysqli_query($conn, $sql)) {
          
            header("Location: ../Backend/query_submission.php?message=success");
            exit();
        } else {
            
            header("Location: ../Backend/query_submission.php?message=error");
            exit();
        }
    }
} else {
    echo "Please make sure to fill out the form.";
}
