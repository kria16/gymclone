<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
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
            background-color: black;
        }
        .card {
            width: 350px;
            background: transparent;
            border: 2px solid #B5BBC9;
            backdrop-filter: blur(10px);
            color: #fff;
            border-radius: 12px;
            padding: 30px 40px;
        }
        h3 {
            color: orangered;
        }
        .error {
            color: red;
            font-size: 12px;
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
                    <form id="loginForm" onsubmit="return validateForm();">
                        <div class="form-group">
                            <label for="username">Username</label>
                            <input type="text" class="form-control" id="username" name="username"  autofocus>
                            <span class="error" id="usernameError"></span>
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" class="form-control" id="password" name="password" >
                            <span class="error" id="passwordError"></span>
                        </div>
                        <button type="submit" class="btn btn-primary btn-block btn-success">LOGIN</button>
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
