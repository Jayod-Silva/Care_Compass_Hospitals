<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    include("connection.php");

    $name = $_POST['name'];
    $rating = $_POST['rating'];
    $message = $_POST['message'];
   

    //------------------stop duplicate feedback
    $check_sql = "SELECT * FROM feedback_form WHERE name = 'message' AND 'message' = '$message'";
    $result = mysqli_query($conn, $check_sql);

    if (mysqli_num_rows($result) > 0) {
        // -----------------Redirect to Stoping duplicate submission 
        header("Location: ../Backend/feedback.php?message=duplicate");
        exit();
    } else {
        // ------------Insert feedback
        $sql = "INSERT INTO feedback_form
        (name, rating, message)
        VALUES ('$name', '$rating', '$message')";

        if (mysqli_query($conn, $sql)) {
           
            header("Location: ../Backend/feedback.php?message=success");
            exit();
        } else {
           
            header("Location: ../Backend/feedback.php?message=error");
            exit();
        }
    }
} else {
    echo "Please make sure to fill out the form.";
}
