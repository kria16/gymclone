<?php
include 'header.php'; 

$qry = "SELECT * FROM tbl_gellery";
$result = mysqli_query($con, $qry);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="C:\xampp\htdocs\gymfinal\bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" ></script>
    <link href="bootstrap.min.css" rel="stylesheet">    
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="bootstrap.min.js"></script>
    <link rel="stylesheet" href="index.css">
    <title> gym home</title>  
    <style>
.w3-display-container {
    position: relative;
    width: 100%;
}
.w3-display-container img {
    width: 100%;
    height: 470px;
    object-fit: cover;
}
.overlay-text {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    text-align: center;
    color: white;
    font-size: 24px;
    font-weight: bold;
    z-index: 1;
    background-color: rgba(0, 0, 0, 0.6); 
    padding: 20px;
    border-radius: 10px;
    width: 80%; 
}
.overlay-text h1 {
    font-size: 36px;
    margin-bottom: 10px;
}
.overlay-text h5 {
    font-size: 18px;
    margin-bottom: 20px;
}
.overlay-text a {
    display: inline-block;
    padding: 10px 20px;
    color: white;
    background-color: orangered;
    text-decoration: none;
    font-size: 18px;
    border-radius: 5px;
}
.overlay-text a:hover {
    background-color: darkorange;
}
.w3-button {
    position: absolute;
    top: 50%;
    transform: translateY(-50%);
    z-index: 2;
    background-color: rgba(0, 0, 0, 0.5);
    color: white;
    padding: 16px;
    cursor: pointer;
    font-size: 18px;
}
.w3-display-left {
    left: 0;
}
.w3-display-right {
    right: 0;
}
.w3-button:hover {
    background-color: rgba(0, 0, 0, 0.7);
}
.amenities {
    padding: 20px;
}
.amenities-grid {
    display: flex;
    flex-wrap: wrap;
    gap: 10px;
    justify-content: center; 
}
.amenity-item {
    position: relative;
    width: 100%;
    max-width: 400px; 
}
.amenity-item img {
    width: 100%;
    height: auto;
    display: block;
    transition: opacity 0.3s ease;
}
.amenity-text {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: rgba(145, 138, 138, 0.6); 
    color: #fff;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 20px;
    text-align: center;
    opacity: 0;
    transition: opacity 0.3s ease;
    box-sizing: border-box; 
}
.amenity-item:hover .amenity-text {
    opacity: 1; 
}
.amenity-item:hover img {
    opacity: 0.3; 
}
.amenities h2 {
    text-align: center;
}
@media (max-width: 768px) {
    .amenity-item {
        flex: 1 1 calc(50% - 10px); 
        max-width: none;
    }
}
@media (min-width: 769px) {
    .amenity-item {
        flex: 1 1 calc(33.33% - 10px); 
        max-width: none; 
    }
}

.flex-container {
    display: flex;
    justify-content: space-around; 
    padding: 20px;
}
.flex-item {
    position: relative; 
    color: white;
    padding: 5px;
    transition: transform 0.3s, background-color 0.3s;
    height: 284px;
    overflow: hidden; 
}
.flex-item img {
    width: 100%; 
    height: 243px; 
}
.hover-text {
    display: none; 
    position: absolute; 
    top: 50%; 
    left: 50%; 
    transform: translate(-50%, -50%); 
    color: white;
    padding: 10px;
    border-radius: 5px;
    text-align: center;
}
.flex-item:hover {
    transform: scale(1.1); 
}
.flex-item:hover .hover-text {
    display: block; 
}
.gallery {
    display: flex;
    flex-wrap: wrap; 
    justify-content: center; 
    padding: 20px;
}

.trainer {
    position: relative;
    margin: 10px;
    scroll-snap-align: start;
    cursor: pointer;
    transition: transform 0.3s;
}

.trainer img {
    width: 100%;
    border-radius: 10px;
}

.details {
    background-color: orangered;
    color: black;
    padding: 10px;
    border-radius: 0 0 10px 10px;
    height: 200px;
}

.trainer:hover {
    transform: scale(1.05);
}

@media (min-width: 900px) {
    .trainer {
        width: calc(25% - 20px); 
    }
}

@media (max-width: 899px) and (min-width: 576px) {
    .trainer {
        width: calc(50% - 20px); 
    }
}

@media (max-width: 575px) {
    .trainer {
        width: calc(100% - 20px); 
    }
}

.container {
    width: 100%;
    padding: 10px;
    background-color: black;
    position: relative;
}

h1 {
    font-size: 3rem;
    color: white; 
}

.container h5 {
    word-spacing: 5px;
    font-weight: 500;
    margin-bottom: 20px;
}

.btn:not(:disabled):not(.disabled) {
    cursor: pointer;
}

.container a {
    font-size: 20px;
    font-weight: 700;
    background-color: orangered;
    border-radius: 5px;
    color: #000;
    margin-top: 10px;
    border: 2px solid transparent;
    transition: 0.4s;
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
<!--main content-->
  <!--slider-->
<div class="w3-display-container mySlides">
  <img src="s3.jpg" style="width:100%; height: 470px;">
  <div class="overlay-text">
      <h1><span style="color: orangered;">FITNESS + HEALTH</span> COACHING FOR BUSY <span style="color: orangered;">PROFESSIONALS</span></h1>
      <h5>It doesn’t matter if your goal is to get stronger, burn fat, or just stay fit, our world-class coaches will guide you every step of the way.</h5>
      <a href="contact.php">Contact Us</a>
  </div>
</div>
<div class="w3-display-container mySlides">
  <img src="s1.jpg" style="width:100%; height: 470px;">
  <div class="overlay-text">
      <h1><span style="color: orangered;">FITNESS + HEALTH</span> COACHING FOR BUSY <span style="color: orangered;">PROFESSIONALS</span></h1>
      <h5>It doesn’t matter if your goal is to get stronger, burn fat, or just stay fit, our world-class coaches will guide you every step of the way.</h5>
      <a href="contact.php">Contact Us</a>
  </div>
</div>
<div class="w3-display-container mySlides">
  <img src="s4.jpg" style="width:100%; height: 470px;">
  <div class="overlay-text">
      <h1><span style="color: orangered;">FITNESS + HEALTH</span> COACHING FOR BUSY <span style="color: orangered;">PROFESSIONALS</span></h1>
      <h5>It doesn’t matter if your goal is to get stronger, burn fat, or just stay fit, our world-class coaches will guide you every step of the way.</h5>
      <a href="contact.php">Contact Us</a>
  </div>
</div>
<div class="w3-display-container mySlides">
  <img src="GYM2.jpg" style="width:100%; height: 470px;">
  <div class="overlay-text">
      <h1><span style="color: orangered;">FITNESS + HEALTH</span> COACHING FOR BUSY <span style="color: orangered;">PROFESSIONALS</span></h1>
      <h5>It doesn’t matter if your goal is to get stronger, burn fat, or just stay fit, our world-class coaches will guide you every step of the way.</h5>
      <a href="contact.php">Contact Us</a>
  </div>
</div>

<!-- Slideshow navigation -->
<button class="w3-button w3-display-left w3-black" onclick="plusDivs(-1)">&#10094;</button>
<button class="w3-button w3-display-right w3-black" onclick="plusDivs(1)">&#10095;</button>

<!--amenities-->
<section class="amenities">
    <h2><span style="color:  orangered;">Our Amenities</span></h2>
    <div class="amenities-grid">
        <div class="amenity-item">
            <img src="ca.jpeg" alt="Amenity 1">
            <div class="amenity-text">Carpet Area:<br>5000  To 8000 Area</div>
        </div>
        <div class="amenity-item">
            <img src="sauna.jpeg" alt="Amenity 2">
            <div class="amenity-text">Steam Bath:<br>Relax with our sauna facilities</div>
        </div>
        <div class="amenity-item">
            <img src="gw1.jpeg" alt="Amenity 3">
            <div class="amenity-text">Group Workout:<br>We Have Group Fitness Session</div>
        </div>
        <div class="amenity-item">
            <img src="c.jpeg" alt="Amenity 4">
            <div class="amenity-text">Automatic Cardio Equipment:<br>Our All Gym Have Automatic Equipment</div>
        </div>
        <div class="amenity-item">
            <img src="im.jpeg" alt="Amenity 5">
            <div class="amenity-text">International Machines:<br>Aall Branch's Have Internal Standard Machines</div>
        </div>
        <div class="amenity-item">
            <img src="ba.jpeg" alt="Amenity 6">
            <div class="amenity-text">Personal Trainers:<br>All Branch's Have Personal Trainers </div>
        </div>
    </div>
</section>

<!--other -->

<div class="heading1">
    <h2 style="text-align: center;"> We Offer Something For<span style="color:  orangered;"> Everybody</span></h2>
</div>
<div class="flex-container">
    <div class="flex-item">
        <img src="b1.jpeg" alt="Image 1">
        <span class="hover-text">Personal Training</span>
    </div>
    <div class="flex-item">
        <img src="b2.jpeg" alt="Image 2">
        <span class="hover-text">Strength Training</span>
    </div>
    <div class="flex-item">
        <img src="b4.jpeg" alt="Image 3">
        <span class="hover-text">Weight Gain Programme</span>
    </div>
    <div class="flex-item">
        <img src="b3.jpeg" alt="Image 4">
        <span class="hover-text">Weight Loss Programme</span>
    </div>
    <div class="flex-item">
        <img src="b6.jpeg" alt="Image 5">
        <span class="hover-text">Cardio Workout</span>
    </div>
</div>
<!--trainer-->
<h1 style="text-align: center;">GYM <span style="color:orangered" >TRAINERS</span></h1>
<div class="gallery">
            <?php
            // Loop through each trainer and display their data
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<div class='trainer'>
                        <img src='{$row['photo']}' alt='Trainer {$row['name']}'>
                        <div class='details'>
                            <h2>{$row['name']}</h2>
                            <p>GYMSHINE {$row['branche']}</p>
                            <p>Experience: {$row['experiance']} years</p>
                            <p>Specialization: {$row['specialization']}</p>
                        </div>
                    </div>";
            }
            ?>
        </div>
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
            document.addEventListener('DOMContentLoaded', function() {
                const toggler = document.querySelector('.navbar-toggler');
                const navbarNav = document.querySelector('.navbar-nav');
        
                toggler.addEventListener('click', function() {
                    navbarNav.classList.toggle('active');
                });
            });
        </script>
        <script>
  var slideIndex = 1;
  showDivs(slideIndex);
  
  function plusDivs(n) {
    showDivs(slideIndex += n);
  }
  
  function showDivs(n) {
    var i;
    var x = document.getElementsByClassName("mySlides");
    if (n > x.length) {slideIndex = 1}
    if (n < 1) {slideIndex = x.length}
    for (i = 0; i < x.length; i++) {
       x[i].style.display = "none";  
    }
    x[slideIndex-1].style.display = "block";  
  }
  var myIndex = 0;
    carousel();
    function carousel() {
      var i;
      var x = document.getElementsByClassName("mySlides");
      for (i = 0; i < x.length; i++) {
        x[i].style.display = "none";  
      }
      myIndex++;
      if (myIndex > x.length) {myIndex = 1}    
      x[myIndex-1].style.display = "block";  
      setTimeout(carousel, 2000); // Change image every 2 seconds
    }
  </script>
</body>
</html>
