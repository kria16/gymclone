<?php
    
    include 'conne.php';
   session_start(); // Start session at the beginning of the script

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Validate login credentials
    $qry = "SELECT * FROM login WHERE username='$username' AND password='$password'";
    $result = mysqli_query($conn, $qry);

    if (mysqli_num_rows($result) == 1) {
        // Login successful
        $_SESSION['admin_username'] = $username; // Store username in session
        echo "Login successful!";
        header("Location: admindash.php");
        exit;
    } else {
        echo "Invalid credentials. Please try again.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css\bootstrap.min.css">
     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" ></script>
     <link href="bootstrap.min.css" rel="stylesheet">    
     <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
     <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
     <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <title>Admin Login</title>
    <style>
        *{
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: "poppins", sans-serif;
        }
        body{
            margin-top: 100px;
            display: flex;
            justify-content: center;
            background-color: white;
        }
        .card{
            width: 350px;
            background: transparent;
            border: 2px solid #6d8196;
            backdrop-filter: blur(10px);
            color: black;
            border-radius: 12px;
            padding: 30px 40px;
        }
        h3{
            color: #6d8196;
        }
        .error {
            color: red;
            font-size: 12px;
        }
        .btn {
            background-color: #6d8196; /* Gray button */
            border-color: #6d8196;
            color: #fff;
        }
        .btn:hover {
            background-color: #5f5f5f; /* Darker gray on hover */
            border-color: #6d8196;
        }
        .form-control {
            border: 1px solid white;
            border-radius: 0.375rem;
            padding: 10px;
            background-color: white; /* Light gray background for input fields */
        }
        .form-control:focus {
            border-color: #6d8196; /* Gray border on focus */
            box-shadow: 0 0 0 0.2rem rgba(255, 255, 255, 0.72); 
        }
        /* Make the form container more responsive */
        @media (max-width: 767px) {
        body {
            margin-top: 50px;
        }

        .card {
            width: 90%; /* Take more space on small screens */
            padding: 20px 30px;
        }
    }
    </style>
</head>
<body>
<div class="container mt-5">
        <div class="row justify-content-center">
            <div class="card">
                <div class="card-header text-center">
                    <h3>ADMIN LOGIN</h3>
                </div>
                <div class="card-body">
                    <?php if (isset($login_error)): ?>
                        <div class='alert alert-danger'><?php echo $login_error; ?></div>
                    <?php endif; ?>
                    <form id="loginForm" action="" method="POST" onsubmit="return validateForm();">
                        <div class="form-group">
                            <label for="username">Username</label>
                            <input type="text" class="form-control" id="username" name="username" autofocus>
                            <span class="error" id="usernameError"></span>
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" class="form-control" id="password" name="password">
                            <span class="error" id="passwordError"></span>
                        </div>
                        <button type="submit" class="btn btn-primary btn-block">LOGIN</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        function validateForm() {
            let valid = true;

            // Clear previous error messages
            document.getElementById("usernameError").textContent = "";
            document.getElementById("passwordError").textContent = "";

            // Get values
            const username = document.getElementById("username").value;
            const password = document.getElementById("password").value;

            // Username validation
            if (username.trim() === "") {
                document.getElementById("usernameError").textContent = "*Username cannot be empty";
                valid = false;
            }

            // Password validation
            if (password.length < 6) {
                document.getElementById("passwordError").textContent = "*Password must be at least 6 characters long";
                valid = false;
            }

            return valid;
        }
    </script>
</body>
</html>

<!-- admin -->
<!--admin90  -->