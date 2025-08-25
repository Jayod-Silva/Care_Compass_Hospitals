<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Care Compass Hospitals</title>
    <link rel="stylesheet" href="../CSS/login & regi.css">
    <link rel="stylesheet" href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/remixicon@3.4.0/fonts/remixicon.css" />
</head>
<body>

    <div class="login-container">
        <div class="login-box-container">
    
            <span class="close-icon" onclick="window.location.href='../HTML/Homepage.html';" aria-label="Close">
                <i class="bx bx-x"></i>
            </span>

            <div class="login-img">
                <img src="../IMG/login-img.png" alt="Login Illustration">
            </div>

    
            <div class="login-box">
                <div class="login-form">
                    <h2>Log In</h2>
                    <form action="../Backend/Authenticator.php" id="login-form" method="POST">
                                
                        <div class="input-group">
                            <input type="text" id="username" name="username" placeholder="Username" required>
                        </div>
                
                        <div class="input-group">
                            <input type="password" id="password" name="password" placeholder="Password" required>
                        </div>
                
                        <button type="submit" class="login-submit-btn">Log In</button>
                
                        <div class="signup-link">
                            <p>Don't have an account? <a href="javascript:void(0);" onclick="showRegisterForm();">Register</a></p>
                        </div>
                    </form>
                </div> 
            </div>
        </div>
    </div>

    <div class="register-container">
        <div class="register-box-container">

            <span class="close-icon" onclick="window.location.href='/HTML/Homepage.html';" aria-label="Close">
                <i class="bx bx-x"></i>
            </span>
            
            <div class="register-img">
                <img src="../IMG/register-img.png" alt="Login Illustration">
            </div>

            <div class="register-box">
                <div class="register-form">
                    <h2>Register</h2>
                    <form action="../Backend/Authenticator.php" id="register-form" method="POST">
                                
                        <div class="input-group">
                            <input type="text" id="username" name="username" placeholder="Username" required>
                        </div>

                        <div class="input-group">
                            <input type="email" id="email" name="email" placeholder="Email" required>
                        </div>
                
                        <div class="input-group">
                            <input type="password" id="password" name="password" placeholder="Password" required>
                        </div>

                        <div class="input-group">
                            <input type="password" id="confirm_password" name="confirm_password" placeholder="Confirm Password" required>
                        </div>

                        <div class="input-group">
                            <select class="role-select" id="role" name="role" required>
                                <option value="">-- Select Role --</option>
                                <option value="admin">Admin</option>
                                <option value="patient">Patient</option>
                                <option value="staff">Staff</option>
                            </select>       
                        </div>
                        
                        <button type="submit" class="register-submit-btn">Register</button>
                
                        <div class="signup-link">
                            <p>Already have an account? <a href="javascript:void(0);" onclick="showLoginForm();">Log In</a></p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</body>
</html>


<script>

    function showRegisterForm() {
        document.querySelector('.register-container').style.display = 'block';
        document.querySelector('.login-container').style.display = 'none';
    }

    function showLoginForm() {
        document.querySelector('.register-container').style.display = 'none';
        document.querySelector('.login-container').style.display = 'block';
    }

</script>