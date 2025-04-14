<?php
session_start(); // Start the session to manage login

include 'conne.php'; // Include your database connection

// Check if the user is already logged in, redirect to the trainer page if true
if (isset($_SESSION['username'])) {
    header("Location: trainer.php"); // Redirect if already logged in
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get user input
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Prepare the SQL query to prevent SQL injection
    $qry = "SELECT * FROM tbl_gellery WHERE username = ? AND password = ?";

    if ($stmt = mysqli_prepare($conn, $qry)) {
        // Bind parameters to the SQL query
        mysqli_stmt_bind_param($stmt, "ss", $username, $password);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        // Check if the user exists and password matches
        if (mysqli_num_rows($result) == 1) {
            $_SESSION['username'] = $username; // Store the username in session for later use
            header("Location: trainer.php"); // Redirect to the trainer data page
            exit();
        } else {
            // Show an error message if invalid credentials
            $login_error = "Invalid Username or Password";
        }
        
        // Close the prepared statement
        mysqli_stmt_close($stmt);
    }
}

// Close the database connection
// mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="bootstrap.min.css">
    <title>Trainer Login</title>
    <style>
        * {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: "Poppins", sans-serif;
}
body {
    margin-top: 100px;
    display: flex;
    justify-content: center;
    background-color: white; /* Light background color */
}
.card {
    width: 100%; /* 100% width on small screens */
    max-width: 350px; /* Set max width for larger screens */
    background: #ffffff; /* White background for the card */
    border: 2px solid #6d8196; /* New gray border */
    border-radius: 12px;
    padding: 30px 40px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); 
}
h3 {
    color: #6d8196; /* Gray color for the header */
}
.error {
    color: red;
    font-size: 12px;
}
.alert-danger {
    background-color: #f8d7da; /* Light red background for error */
    color: #721c24; /* Darker red text */
    border: 1px solid #f5c6cb;
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
                <h3>TRAINER LOGIN</h3>
            </div>
            <div class="card-body">
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

                    <!-- Display login error if credentials are wrong -->
                    <?php if (isset($login_error)): ?>
                        <div class="alert alert-danger"><?php echo $login_error; ?></div>
                    <?php endif; ?>

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
        if (password.length < 8) {
            document.getElementById("passwordError").textContent = "*Password must be at least 8 characters long";
            valid = false;
        }

        return valid;
    }
</script>
</body>
</html>

