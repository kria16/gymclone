<?php
require_once('conne.php');

if (isset($_POST['submit'])) { 
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $location = $_POST['location'];
    $capital = $_POST['capital'];
    $businessexp = $_POST['businessexp'];
    $business = $_POST['business'];
  
        $sql = "INSERT INTO franchies (name, email, phone,location,capital, businessexp,business) 
                VALUES ('$name','$email', '$phone','$location', '$capital', '$businessexp','$business')";
        
            if (!mysqli_query($conn, $sql)) {
                echo "Error: " . mysqli_error($conn); 
                $error = "form Not submitted";    
        } else {
            echo "<script>alert('form submitted successful.');</script>";
        }
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta email="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" ></script>
     <link href="bootstrap.min.css" rel="stylesheet">    
     <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
     <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
     <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
     <link rel="stylesheet" href="index.css">
     <title>franchies</title>
    <style>
        .body{
            color: black;
        }
        .header-franchies{
            background-color: black;
            height: 30vh;
            padding-top: 5%;
            font-weight: 900;
        }
        .container{
            margin: auto;
        }
        .row{
            padding-top: 4%;
            color: white;
        }
        .info .form{
            font-weight: 900;
        }
        .info p{
            color: rgba(0, 0, 0, 0.594);
        }
        .form{
            background-color: black;
            color: white;
            border: 2px white;
        }
        .form p{
            color: white;
        }
        /*inquire form*/
        .inquire-plocation{
            border: #a19c9c 1px dotted;
            border-radius: 3px;
        }
        .inquire-form-section {
            padding-top: 10px;
            padding-bottom: 100px;
        }
        .form-container {
            max-width: 960px;
            width: 100%;
            padding: 15px;
            margin: 0 auto;
        }
        .form-group {
            margin-bottom: 20px;
        }
        .form-group label {
            display: block;
            font-weight: 600;
            margin-bottom: 8px;
        }
        .form-group input,
        .form-group textarea,
        .form-group select {
            width: 100%;
            padding: 10px;
            border: 1px solid #464646;
            border-radius: 4px;
            font-size: 16px;
        }
        .radio-group {
            display: flex;
            gap: 10px;
        }
        .radio-group label {
            display: flex;
            align-items: center;
        }
        button#submitBtn:disabled {
            background-color: #ccc;
            cursor: not-allowed;
        }
        .form-group button {
            background-color: orangered;
            border: none;
            padding: 15px 30px;
            font-size: 16px;
            font-weight: 700;
            text-transform: uppercase;
            cursor: pointer;
            border-radius: 4px;
            display: inline-block;
        }
        @media (max-width: 768px) {
        .form-container {
            padding: 10px;
        }
        button#submitBtn {
            width: 100%;
        }
        } 
    </style>
</head>
<body>
    <!--header-->
    <nav class="navbar navbar-expand-lg">
        <a class="navbar-brand">
            <img class="media-imlocation rounded-circle" src="LOGO.jpg" alt="logo" height="70" width="70">
            <h5 style="color: black;">GYM<span style="color: orangered;">SHINE</span></h5>
        </a>
        <button class="navbar-toggler" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="index.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="branch.php">Branch</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="membership.php">Membership</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="about.php">About</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="contact.php">contact</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="login.php">login</a>
                </li>
            </ul>
            <ul>
                <li class="nav-item">
                    <a href="userprofile1.php"><img src="user 2.png" width="30px" ></a>
                </li>
            </ul>
        </div>
    </nav>
    <!--franchies-->
    <header class="header-franchies align-items-center" >
        <div class="container text-center">
              <h1 class="display-4 fw-bold text-#B5BBC9 text-uppercase">BECOME AN OWNER</h1>
        </div>
    </header>
    <section class="main bg-#B5BBC9">
    <form method="post" id="inquireForm">
    <div class="container">
        <div class="row align-item-start">
            <div class="col-md-6 col-lg-5">
                <div class="info">
                    <h1>OWN SOMETHING OTHERS CAN'T</h1>
                    <h5>A COMMUNITY FOR HOLISTIC HEALTH</h5>
                </div>
            </div>
            <div class="col-md-6 col-lg-5 border-1">
                <div class="inquire-plocation">
                    <div class="form bg-black p-4">
                        <h1 class="text-uppercase">Inquire Today</h1>
                        <p class="bg-black">Learn more about gymshine and join us</p>
                    </div>
                    <div class="form-container">
                        <table>
                            <tr class="form-group">
                                <td>
                                    <input type="text" id="name" name="name" placeholder="Full name" >
                                    <span class="error-message" id="nameError" style="color: red;"></span>
                                </td>
                            </tr>
                            <tr class="form-group">
                                <td>
                                    <input type="email" id="email" name="email" placeholder="Email" >
                                    <span class="error-message" id="emailError" style="color: red;"></span>
                                </td>
                            </tr>
                            <tr class="form-group">
                                <td>
                                    <input type="tel" id="phone" name="phone" placeholder="Phone" >
                                    <span class="error-message" id="phoneError" style="color: red;"></span>
                                </td>
                            </tr>
                            <tr class="form-group">
                                <td>
                                    <input type="text" name="location" id="location" placeholder="Location" >
                                    <span class="error-message" id="locationError" style="color: red;"></span>
                                </td>
                            </tr>
                            <tr class="form-group">
                                <td>
                                    <label for="capital">How much liquid capital do you have?</label>
                                </td>
                            </tr>
                            <tr class="radio-group">
                                <td>
                                    <label><input type="radio" name="capital" value="over 100k" > Over 100k</label>
                                    <label><input type="radio" name="capital" value="under 100k"> Under 100k</label>
                                    <span class="error-message" id="capitalError" style="color: red;"></span>
                                </td>
                            </tr>
                            <tr class="form-group">
                                <td>
                                    <label>Have you operated a business before?</label>
                                </td>
                            </tr>
                            <tr class="radio-group">
                                <td>
                                    <label><input type="radio" name="businessexp" value="yes" > Yes</label>
                                    <label><input type="radio" name="businessexp" value="no"> No</label>
                                </td>
                            </tr>
                            <tr class="form-group">
                                <td>
                                    <label>Have you operated a franchise before?</label>
                                </td>
                            </tr>
                            <tr class="radio-group">
                                <td>
                                    <label><input type="radio" name="business" value="yes" > Yes</label>
                                    <label><input type="radio" name="business" value="no"> No</label>
                                </td>
                            </tr>
                            <tr class="form-group">
                                <td><button type="submit" name="submit" class="btn">Submit</button></td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form> 
</section>
     <!--footer-->
     <footer class="bg-footer">
        <div class="containerr">
            <div class="row">
                <div class="col-md-4">
                    <div class="footer-test">
                        <p>Contact Us</p>
                        <ul class="mt-4">
                            <li><a href="tel:7096004208"><i class="fas fa-phone-alt"></i> +91 7096646378</a></li>
                            <li><a href="gymshine234@gmail.com"><i class="fas fa-envelope"></i>
                                    gymshine111@gmail.com</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-2 col-6">
                    <div class="footer-test">
                        <p>Pages</p>
                        <ul class="mt-4">
                            <li><a href="index.php">Home</a></li>
                            <li><a href="branch.php">Branch</a></li>
                            <li><a href="membership.php">Membership</a></li>
                            <li><a href="about.php">About Us</a></li>
                            <li><a href="contact.php">Contact Us</a></li>
                            <li><a href="franchies.php">franchies</a></li>
                            <li><a href="careers.php">careers</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-3 col-6">
                    <div class="footer-test">
                        <p>Our Branches</p>
                        <ul class="mt-4">
                            <li><a href="#ourBranch">Vesu </a></li>
                            <li><a href="#ourBranch">Ghod Dod</a></li>
                            <li><a href="#ourBranch">Adajan</a></li>
                            <li><a href="#ourBranch">Vip Road</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-3 p-0">
                    <div class="footer-test">
                        <p>Follow Us</p>
                        <div class="social_icon">
                            <img src="instagram.png" width="10%" height="10%">
                            <img src="whatsapp.png" width="10%" height="10%">
                            <img src="facebook.png" width="10%" height="10%">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <hr>
        <div class="footer-copyright">
        <center><p style="color: black;">© 2024-2025All Rights Reserved</p></center>
        </div>
    </footer>
    <script>
    document.getElementById('inquireForm').addEventListener('submit', function(event) {
    // Clear previous error messages
    document.querySelectorAll('.error-message').forEach(error => {
        error.textContent = ''; // Clear error message
    });

    let isValid = true;

    // Name validation
    const name = document.getElementById('name').value;
    if (!name) {
        document.getElementById('nameError').textContent = 'Please enter Fullname.';
        isValid = false;
    }

    // Email validation
    const email = document.getElementById('email').value;
    if (!email) {
        document.getElementById('emailError').textContent = 'Enter Email.';
        isValid = false;
    }

    // Phone validation
    const phone = document.getElementById('phone').value;
    const phonePattern = /^\+?[0-9\s\-\(\)]{10,15}$/;
    if (!phonePattern.test(phone)) {
        document.getElementById('phoneError').textContent = 'Please enter a valid phone number.';
        isValid = false;
    }

    // Location validation
    const location = document.getElementById('location').value;
    if (!location) {
        document.getElementById('locationError').textContent = 'Please enter Location.';
        isValid = false;
    }

    // Capital validation
    const capitalSelected = document.querySelector('input[name="capital"]:checked');
    if (!capitalSelected) {
        document.getElementById('capitalError').textContent = 'Please select a capital option.';
        isValid = false;
    }

    // Prevent form submission if validation fails
    if (!isValid) {
        event.preventDefault();
    }
});
</script>
</body>
</html>