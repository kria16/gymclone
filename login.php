<?php
session_start();
require_once('conne.php');
if (isset($_POST['submit'])) {
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = $_POST['password'];  
    $sql = "SELECT * FROM register WHERE email='$email'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        if (password_verify($password, $user['password'])) {
            session_regenerate_id(true);
            $_SESSION['email'] = $user['email'];  
            echo "<script>alert('Login successful');</script>";           
            echo "<script>window.location.href='index.php';</script>";
            exit();
        } else {
            echo "<script>alert('Invalid password. Please try again.');</script>";
            echo "<script>window.location.href='login.php';</script>";
            exit();
        }
    } else {
        echo "<script>alert('No account found with that email. Please register.');</script>";
        echo "<script>window.location.href='register.php';</script>";
        exit();
    }
}

$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <title>Login Form</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: "Poppins", sans-serif;
        }
        body {
            display: flex;
            justify-content: center;
            align-items: center;c:\xampp\htdocs\gymfinal\membership.php
            min-height: 100vh;
            background-image: url(GYM2.jpg);
            background-size: cover;
            background-position: center;
            color: white;
        }
        .wrapper {
            width: 350px;
            background: rgba(255, 255, 255, 0.2); 
            border: 2px solid rgba(255, 255, 255, 0.1); 
            backdrop-filter: blur(10px); 
            border-radius: 12px;
            padding: 30px 40px;
            box-shadow: 0 4px 30px rgba(0, 0, 0, 0.1);
        }
        .wrapper h1 {
            font-size: 30px;
            text-align: center;
        }
        .input-box {
            width: 100%;
            height: 50px;
            margin: 30px 0;
        }
        .input-box input {
            width: 100%;
            height: 100%;
            background: transparent;
            border: none;
            outline: none;
            border: 2px solid rgb(7, 7, 7);
            border-radius: 40px;
            font-size: 16px;
            padding: 20px 45px 20px 20px;
            font-weight: bold; 
            color: white; 
        }
        .input-box input::placeholder {
            color: white; 
            font-weight: bold; 
        }
        .error {
            color: red;
            font-size: 12px;
        }
        .login, .forgot {
            display: flex;
            font-size: 15px;
            margin: -15px 0 15px;
            justify-content: center;
        }
        .wrapper .btn,
        .submit {
            width: 100%;
            height: 50px;
            background: #fff;
            border: none;
            border-radius: 40px;
            cursor: pointer;
            font-size: 16px;
            font-weight: 600;
        }
        .logint {
            font-size: 15px;
            text-align: center;
            margin: 20px 0 15px;
        }
        .logint a {
            text-decoration: none;
            font-weight: 600;
            color: black;
        }
        .btn:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <form id="loginForm" action="" method="POST" onsubmit="return validateForm();">
            <h1>LOGIN</h1>
            <div class="input-box">
                <input type="email" name="email" id="email" placeholder="Email"  autofocus>
                <span class="error" id="emailError"></span>
            </div>
            <div class="input-box">
                <input type="password" name="password" id="password" placeholder="Password" >
                <span class="error" id="passwordError"></span>
            </div><br>
            <div class="login">
                <button type="submit" name="submit" class="submit">Login</button>
            </div>
            <div class="logint">
                <p>Don't have an account?</p>
                <button type="button" class="btn"><a href="register.php">Register</a></button>
            </div>
        </form>
    </div>

    <script>
        function validateForm() {
            let valid = true;

            // Clear previous error messages
            document.getElementById("emailError").textContent = "";
            document.getElementById("passwordError").textContent = "";

            // Get values
            const email = document.getElementById("email").value;
            const password = document.getElementById("password").value;

            // Email validation
            if (!/\S+@\S+\.\S+/.test(email)) {
                document.getElementById("emailError").textContent = "*Invalid Email";
                valid = false;
            }

            // Password validation
            if (password.length < 8) {
                document.getElementById("passwordError").textContent = "*Password must be at least 8 characters long";
                valid = false;
            }

            return valid;
        }
    </script>
</body>
</html>
<!-- username : doshikriya16@gmail.com -->
<!-- dkriya90@ -->
<!-- mehtaashavi@gmail.com -->
<!-- mashavi14@ -->
 <!-- yashvimehta30@gmail.com -->
<!-- Yashvi@30 -->