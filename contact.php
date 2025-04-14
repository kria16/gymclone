<?php
session_start();
error_reporting(0);

require_once('conne.php');
$id = $_SESSION['id'];
if (isset($_POST['submit'])) { 
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $message = $_POST['message'];
    $usermatch = mysqli_query($conn, "SELECT phone, email FROM contact WHERE (email='$email' || phone='$phone')");
    $row = mysqli_fetch_assoc($usermatch);
    
    $usrdbeml = $row['email'] ?? '';
    $usrdbmble = $row['phone'] ?? '';

    if (empty($name)) {
        $nameerror = "Please Enter Full Name";
    } else if (empty($email)) {
        $emailerror = "Please Enter Email";
    } else if ($email == $usrdbeml || $phone == $usrdbmble) {
        $error = "Email Id or phone Number Already Exists!";
    } else if (empty($phone)) {
        $phoneerror = "Please Enter phone No";
    } else if (empty($message)) {
        $messageerror = "Please Enter message";
    }else{ 
    $sql = "INSERT INTO contact (name, email, phone,message) 
                VALUES ('$name','$email', '$phone','$message')";
        
            if (!mysqli_query($conn, $sql)) {
                echo "Error: " . mysqli_error($conn); // This will show the exact SQL error
                $error = "info Not submitted";    
        } else {
            echo "<script>alert('info submitted successful.');</script>";
        }
    }
}
session_destroy();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" ></script>
    <link href="bootstrap.min.css" rel="stylesheet">    
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
     <script src="bootstrap.min.css"></script>
     <link rel="stylesheet" href="index.css">   
    <title>CONTACT US</title>
    <style>
        body {
            /* font-family: Arial, sans-serif; */
            background-color: black;
        }
        .error {
            color: red;
            font-size: 0.9em;
            display: none;
        }
        .error-message {
            color: red;
            font-size: 1em;
            display: none;
        }
        .wd {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }
        .contact p {
            font-size: 100px;
            text-align: center;
        }
        .contact2 {
            width: 100%;
            display: flex;
            flex-direction: column;
            gap: 10px;
        }
        .contact2 input, .contact2 textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 16px;
        }
        .contact2 textarea {
            resize: vertical;
        }
        button {
            padding: 12px;
            background-color: #ff6600;
            color: #fff;
            border: none;
            cursor: pointer;
            border-radius: 5px;
            font-size: 16px;
        }
        button:hover {
            background-color: #e65c00;
        }
        @media only screen and (min-width: 760px) {
            .wd {
                flex-direction: row;
                max-width: 800px;
            }
            .wd1, .w1 {
                flex: 1;
            }
            .contact2 input, .contact2 textarea {
                max-width: 100%;
            }
            .contact p {
                font-size: 35px;
            }
        }
    </style>
</head>
<body>
     <!--header-->
    <nav class="navbar navbar-expand-lg">
        <a class="navbar-brand">
            <img class="media-image rounded-circle" src="LOGO.jpg" alt="logo" height="70" width="70">
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
                    <a class="nav-link" href="contact.php">Contact</a>
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
    <!--contact-->
    <form id="contactForm" method="post" onsubmit="return validateForm()">
    <div class="wd">
        <div class="wd1">
            <article class="contact">
                <p>CONTACT US<br> FOR <br>MORE DETAILS</p>
            </article>
        </div>
        <div class="w1">
            <article class="contact2">
                <div>
                    <input 
                        type="text" 
                        name="name" 
                        placeholder="Your Name" 
                        minlength="2" 
                        maxlength="50" 
                        pattern="[A-Za-z\s]+" 
                        id="nameInput"
                    >
                    <div class="error" id="nameError" style="color: red; display: none;">Please enter a valid name (letters and spaces only).</div>
                </div>
                <div>
                    <input 
                        type="email" 
                        name="email" 
                        placeholder="Your Email" 
                        id="emailInput"
                    >
                    <div class="error" id="emailError" style="color: red; display: none;">Please enter a valid email address.</div>
                </div>
                <div>
                    <input 
                        type="tel" 
                        name="phone" 
                        placeholder="Your Mobile"  
                        pattern="[0-9]{10}" 
                        id="phoneInput"
                    >
                    <div class="error" id="phoneError" style="color: red; display: none;">Phone number must be 10 digits.</div>
                </div>
                <div>
                    <textarea 
                        name="message" 
                        rows="7" 
                        cols="46" 
                        placeholder="Message" 
                        minlength="10" 
                        maxlength="500" 
                        id="messageInput"
                    ></textarea>
                    <div class="error" id="messageError" style="color: red; display: none;">Message must be at least 10 characters long.</div>
                </div>
                <button type="submit" name="submit" value="Submit">SEND MESSAGE</button>
                <div class="error-message" id="formError" style="color: red; display: none;">Please fill out all fields correctly.</div>
            </article>
        </div>
    </div>
</form>
    <!--footer-->
    <footer class="bg-footer">
        <div class="containerr">
            <div class="row">
                <div class="col-md-4">
                    <div class="footer-test">
                        <p>Contact Us</p>
                        <ul class="mt-4">
                            <li><a href="tel:7096004208"><i class="fas fa-mobile-alt"></i> +91 7096646378</a></li>
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
        document.addEventListener('DOMContentLoaded', function() {
            const toggler = document.querySelector('.navbar-toggler');
            const navbarNav = document.querySelector('.navbar-nav');
    
            toggler.addEventListener('click', function() {
                navbarNav.classList.toggle('active');
            });
        });
    </script>
 <script>
    function validateForm() {
        // Clear previous error messages
        document.querySelectorAll('.error').forEach(error => error.style.display = 'none');
        
        let isValid = true;

        // Name validation
        const nameInput = document.getElementById('nameInput');
        if (!nameInput.value.match(/^[A-Za-z\s]+$/)) {
            document.getElementById('nameError').style.display = 'block';
            isValid = false;
        }

        // Email validation

        const emailInput = document.getElementById('emailInput');
        if (emailInput.value.trim() === '' || !emailInput.validity.valid) {
        document.getElementById('emailError').style.display = 'block';
        isValid = false;
        } else {
        document.getElementById('emailError').style.display = 'none'; // Hide error if valid
        }
        // Phone validation
        const phoneInput = document.getElementById('phoneInput');
        if (!phoneInput.value.match(/^[0-9]{10}$/)) {
            document.getElementById('phoneError').style.display = 'block';
            isValid = false;
        }

        // Message validation
        const messageInput = document.getElementById('messageInput');
        if (messageInput.value.length < 10) {
            document.getElementById('messageError').style.display = 'block';
            isValid = false;
        }

        // Overall form validation
        if (!isValid) {
            document.getElementById('formError').style.display = 'block';
        }

        return isValid; // Prevent form submission if validation fails
    }
</script>

</body>
</html>