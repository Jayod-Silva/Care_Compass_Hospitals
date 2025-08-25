<?php
session_start(); 

include 'connection.php'; 


if (isset($_POST['username']) && isset($_POST['email']) && isset($_POST['password']) && isset($_POST['confirm_password']) && isset($_POST['role'])) {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    $role = $_POST['role'];


    $query = "SELECT * FROM users WHERE username = '$username' OR email = '$email'";
    $result = mysqli_query($conn, $query);
    
    if (mysqli_num_rows($result) > 0) {
        echo "<script>alert('Username or Email already exists!'); window.location.href='login&regi.php';</script>";
        exit();

    } else {
        if ($password === $confirm_password) {
            
            $query = "INSERT INTO users (username, email, password, role) VALUES ('$username', '$email', '$password', '$role')";
            if (mysqli_query($conn, $query)) {
                echo "<script>alert('Registration successful!'); window.location.href='login&regi.php';</script>";
                exit(); 
            } else {
                echo "<script>alert('Error: " . mysqli_error($conn) . "'); window.location.href='login&regi.php';</script>";
                exit();
            }
        } else {
            echo "<script>alert('Passwords do not match!'); window.location.href='login&regi.php';</script>";
            exit(); 
        }
    }
}

// Handle login
if (isset($_POST['username']) && isset($_POST['password'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];


    $query = "SELECT * FROM users WHERE username = '$username' LIMIT 1";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {

        $row = mysqli_fetch_assoc($result);
        if ($password == $row['password']) {

            $_SESSION['user_id'] = $row['id'];
            $_SESSION['username'] = $row['username'];
            $_SESSION['role'] = $row['role'];

            // Redirect based on role
            if ($row['role'] == 'admin') {
                header("Location: admin_portal.php"); 
                exit(); 
            } elseif ($row['role'] == 'patient') {
                header("Location: patient_portal.php");
                exit(); 
            } elseif ($row['role'] == 'staff') {
                header("Location: staff_portal.php"); 
                exit(); 
            }
        } else {
            echo "<script>alert('Incorrect password!'); window.location.href='login&regi.php';</script>";
            exit(); 
        }
    } else {
        echo "<script>alert('No user found with that username!'); window.location.href='login&regi.php';</script>";
        exit(); 
    }
}

mysqli_close($conn);
?>