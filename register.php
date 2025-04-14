<?php
session_start();
require_once('conne.php');

if (isset($_POST['submit'])) {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $contact = mysqli_real_escape_string($conn, $_POST['contact']);
    $age = mysqli_real_escape_string($conn, $_POST['age']);
    $birthday = mysqli_real_escape_string($conn, $_POST['birthday']);
    $gender = mysqli_real_escape_string($conn, $_POST['gender']);
    $address = mysqli_real_escape_string($conn, $_POST['address']);
    $city = mysqli_real_escape_string($conn, $_POST['city']);
    $zip = mysqli_real_escape_string($conn, $_POST['zip']);
    $password = $_POST['password'];  
    $repeatPassword = $_POST['RepeatPassword'];

    $usermatch = mysqli_query($conn, "SELECT contact, email FROM register WHERE email='$email' OR contact='$contact'");
    $row = mysqli_fetch_assoc($usermatch);
    
    $usrdbeml = $row['email'] ?? '';
    $usrdbmble = $row['contact'] ?? '';

    if (empty($name)) {
        $nameerror = "Please Enter Full Name";
    } elseif (empty($contact)) {
        $contacterror = "Please Enter contact No";
    } elseif (empty($email)) {
        $emailerror = "Please Enter Email";
    } elseif ($email == $usrdbeml || $contact == $usrdbmble) {
        $error = "Email Id or contact Number Already Exists!";
    } elseif (empty($password) || empty($repeatPassword)) {
        $error = "Password And Confirm Password Cannot Be Empty!";
    } elseif ($password != $repeatPassword) {
        $error = "Password And Confirm Password Do Not Match!";
    } else {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $sql = "INSERT INTO register (name, email, contact, age, birthday, gender, address, city, zip, password) 
                VALUES ('$name', '$email', '$contact', '$age', '$birthday', '$gender', '$address', '$city', '$zip', '$hashedPassword')";
        
        if (!mysqli_query($conn, $sql)) {
            $error = "Registration Not successful: " . mysqli_error($conn);
        } else {
            echo "<script>alert('Registration successful. Please login');</script>";
            header("Location: login.php");
            exit();  
        }
    }
}

$conn->close();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="bootstrap.min.css">
    <script src="bootstrap.min.js"></script>
    <title>Registration</title>
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
    align-items: center; 
    min-height: 100vh;
    background-image: url(GYM2.JPG);
    background-size: cover;
    background-position: center;
    color: #B5BBC9;
    
}

.wrapper {
    background: rgba(255, 255, 255, 0.2);
    border: 1px solid #B5BBC9;
    backdrop-filter: blur(10px);
    width: 100%;
    max-width: 500px; 
    box-shadow: 0 4px 30px rgba(0, 0, 0, 0.1);
    padding: 20px;
    border-radius: 15px;
    overflow: auto; 
}

.wrapper h1 {
    font-size: 24px; 
    text-align: center;
    margin-bottom: 20px; 
}        

.form-label {
    font-size: 14px;
    margin-bottom: 5px;
    display: inline-block;
    color: black;
}

.form-control {
    width: 100%;
    padding: 10px;
    font-size: 14px;
    border-radius: 5px;
    border: 1px solid black; 
    outline: none;
    margin-bottom: 15px; 
}

.form-check-inline {
    display: inline-block;
    margin-right: 10px;
}

.form-check-input {
    margin-right: 5px;
}

button {
    width: 100%;
    padding: 10px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
}

.btn-success, .btn-danger {
    margin-top: 10px;
    font-size: 16px;
}

.button {
    display: flex;
    gap: 10px;
}

.btn-success:hover, .btn-danger:hover {
    opacity: 0.9;
    text-decoration: underline;
}

.error {
    font-size: 12px; 
    color: red;
}

    </style>
</head>
<body>
    <div class="wrapper">
    <form action="" method="post" onsubmit="return validateForm();">
    <h1>GYM REGISTRATION FORM</h1>
    
    <div class="form-control">
        <label for="fname" class="form-label">Full Name:</label>
        <input type="text" name="name" class="form-control" id="fname"  autofocus pattern="[A-Za-z\s]+" title="Only alphabets and spaces are allowed" minlength="3">
        <span class="error" id="nameError" style="color: red;"></span>
    </div>
    
    <div class="form-control">
        <label for="email" class="form-label">Email:</label>
        <input type="email" name="email" class="form-control" id="email" >
        <span class="error" id="emailError" style="color: red;"></span>
    </div>
    
    <div class="form-control">
        <label for="mno" class="form-label">Contact no:</label>
        <input type="text" name="contact" class="form-control" id="mno"  pattern="[0-9]{10}" title="Contact number must be 10 digits">
        <span class="error" id="contactError" style="color: red;"></span>
    </div>
    
    <div class="form-control">
        <label for="age" class="form-label">Age:</label>
        <input type="number" name="age" class="form-control" id="age"  min="18" max="60" title="Please enter Age must be between 18 and 60">
        <span class="error" id="ageError" style="color: red;"></span>
    </div>
    
    <div class="form-control">
        <label for="dob" class="form-label">Birth Date:</label>
        <input type="date" name="birthday" class="form-control" id="dob" >
        <span class="error" id="dobError" style="color: red;"></span>
    </div>
    
    <div class="form-check">
        <label class="form-check-label">Gender:</label>
        <div class="form-check-inline">
            <input class="form-check-input" type="radio" name="gender" id="male" value="Male" >
            <label class="form-check-label" for="male">Male</label>
        </div>
        <div class="form-check-inline">
            <input class="form-check-input" type="radio" name="gender" id="female" value="Female" >
            <label class="form-check-label" for="female">Female</label>
        </div>
        <span class="error" id="genderError" style="color: red;"></span>
    </div>
    
    <div class="form-control">
        <label for="add" class="form-label">Address:</label>
        <textarea name="address" class="form-control" id="add" ></textarea>
        <span class="error" id="addressError" style="color: red;"></span>
    </div>
    
    <div class="form-control">
        <label for="city" class="form-label">City:</label>
        <input type="text" name="city" class="form-control" id="city"  pattern="[A-Za-z\s]+" title="Only alphabets and spaces are allowed">
        <span class="error" id="cityError" style="color: red;"></span>
    </div>
    
    <div class="form-control">
        <label for="code" class="form-label">Zip/Pincode:</label>
        <input type="text" name="zip" class="form-control" id="code"  pattern="[0-9]{6}" title="Zip code must be 6 digits">
        <span class="error" id="zipError" style="color: red;"></span>
    </div>
    
    <div class="form-control">
        <label for="passwd" class="form-label">Password:</label>
        <input type="password" name="password" class="form-control" id="password" autocomplete="off"  minlength="8" maxlength="20">
        <span class="error" id="passwordError" style="color: red;"></span>
    </div>
    
    <div class="form-control">
        <label for="RepeatPassword" class="form-label">Confirm Password:</label>
        <input type="password" name="RepeatPassword" class="form-control" id="RepeatPassword" autocomplete="off" >
        <span class="error" id="confirmPasswordError" style="color: red;"></span>
    </div>
    
    <div class="button">
        <button type="submit" name="submit" class="btn btn-success">SUBMIT</button>
        <button type="reset" name="reset" class="btn btn-danger">RESET</button>
    </div>
</form>

    </div>
    <script>
function validateForm() {
    let valid = true;

    // Clear previous error messages
    document.getElementById("nameError").textContent = "";
    document.getElementById("emailError").textContent = "";
    document.getElementById("contactError").textContent = "";
    document.getElementById("ageError").textContent = "";
    document.getElementById("dobError").textContent = "";
    document.getElementById("genderError").textContent = "";
    document.getElementById("addressError").textContent = "";
    document.getElementById("cityError").textContent = "";
    document.getElementById("zipError").textContent = "";
    document.getElementById("passwordError").textContent = "";
    document.getElementById("confirmPasswordError").textContent = "";

    const name = document.getElementById("fname").value;
    const email = document.getElementById("email").value;
    const contact = document.getElementById("mno").value;
    const age = document.getElementById("age").value;
    const birthday = document.getElementById("dob").value;
    const gender = document.querySelector('input[name="gender"]:checked');
    const address = document.getElementById("add").value;
    const city = document.getElementById("city").value;
    const zip = document.getElementById("code").value;
    const password = document.getElementById("password").value;
    const confirmPassword = document.getElementById("RepeatPassword").value;

    // Name validation
    if (!/^[A-Za-z\s]+$/.test(name)) {
        document.getElementById("nameError").textContent = "*Enter valid Name";
        valid = false;
    }
    
    // Email validation
    if (!/\S+@\S+\.\S+/.test(email)) {
        document.getElementById("emailError").textContent = "*Enter valid Email";
        valid = false;
    }
    
    // Contact validation
    if (!/^[0-9]{10}$/.test(contact)) {
        document.getElementById("contactError").textContent = "*Contact number must be 10 digits";
        valid = false;
    }
    
    // Age validation
    if (age < 18 || age > 60) {
        document.getElementById("ageError").textContent = "*Age must be between 18 and 60";
        valid = false;
    }
    
    // Gender validation
    if (!gender) {
        document.getElementById("genderError").textContent = "*Please select your Gender";
        valid = false;
    }
    
    // Address validation
    if (address.trim() === "") {
        document.getElementById("addressError").textContent = "*Address is mandatory";
        valid = false;
    }
    
    // City validation
    if (!/^[A-Za-z\s]+$/.test(city)) {
        document.getElementById("cityError").textContent = "*Enter City Name";
        valid = false;
    }
    
    // Zip validation
    if (!/^[0-9]{6}$/.test(zip)) {
        document.getElementById("zipError").textContent = "*Zip code must be 6 digits";
        valid = false;
    }
    
    // Password validation
    if (password.length < 8 || password.length > 20) {
        document.getElementById("passwordError").textContent = "*Password must be 8-20 characters long";
        valid = false;
    }
    
    // Confirm Password validation
    if (password !== confirmPassword) {
        document.getElementById("confirmPasswordError").textContent = "*Passwords do not match";
        valid = false;
    }

    return valid;
}
</script>



</body>
</html>