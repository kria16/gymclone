<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" ></script>
     <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">    
     <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
     <script src="bootstrap.min.css"></script>
     <link rel="stylesheet" href="index.css">   
     <title>about</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            overflow-x: hidden;
        }
        .hero {
            background: linear-gradient(135deg, #333 0%, #111 100%);
            padding: 50px 0;
            color: white;
        }
        
        .heading h1 {
            color: white;
            font-size: 50px;
            text-align: center;
            margin-bottom: 40px;
            font-weight: bold;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.3);
        }
        
        .about-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            width: 90%;
            margin: 0 auto;
            gap: 30px;
        }
        
        .hero-content {
            flex: 1;
            animation: fadeInUp 1.5s ease;
        }
        
        .hero-content h2 {
            font-size: 32px;
            margin-bottom: 20px;
            color: white;
            font-weight: bold;
            position: relative;
            padding-bottom: 10px;
        }
        
        .hero-content h2:after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 60px;
            height: 3px;
            background-color: orangered;
        }
        
        .hero-content p {
            font-size: 18px;
            line-height: 1.6;
            margin-bottom: 20px;
            color: #f0f0f0;
        }
        
        .hero-img {
            flex: 1;
            text-align: center;
            animation: fadeInRight 1.5s ease;
        }
        
        .about-image {
            width: 100%;
            max-width: 500px;
            height: auto;
            border-radius: 10px;
            box-shadow: 0 10px 20px rgba(0,0,0,0.3);
            transition: transform 0.3s;
        }
        
        .about-image:hover {
            transform: scale(1.02);
        }
@media screen and (max-media: 768px){
    @media (max-width: 768px) {
            .heading h1 {
                font-size: 40px;
                margin-top: 20px;
            }
            
            .about-container {
                flex-direction: column-reverse;
                width: 100%;
                padding: 0 20px;
            }
            
            .hero-content {
                width: 100%;
                margin: 30px 0;
            }
            
            .hero-content h2 {
                font-size: 28px;
            }
            
            .hero-content p {
                font-size: 16px;
            }
            
            .hero-img {
                width: 100%;
            }
            
            .about-image {
                max-width: 100%;
            }
        }
        
        @keyframes fadeInUp {
            0% {
                opacity: 0;
                transform: translateY(50px);
            }
            100% {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        @keyframes fadeInRight {
            0% {
                opacity: 0;
                transform: translateX(50px);
            }
            100% {
                opacity: 1;
                transform: translateX(0);
            }
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
     <!-- About Us Section -->
     <section class="hero">
        <div class="heading">
            <h1>ABOUT US</h1>
        </div>
        <div class="about-container">
            <div class="hero-img">
                <img class="about-image" src="https://images.unsplash.com/photo-1534438327276-14e5300c3a48?ixlib=rb-1.2.1&auto=format&fit=crop&w=1000&q=80" alt="Modern gym with equipment">
            </div>
            <div class="hero-content">
                <h2>OUR STORY</h2>
                <p>At GYM SHINE, our journey began with a simple yet powerful vision: to create a fitness space that truly connects with people and transforms lives. Our story is one of passion, dedication, and a deep commitment to fostering a healthier, more active community.</p>
                <p>The seeds for GYM SHINE were sown when our founder, Kartik Grover, recognized a need for a gym that wasn't just about working out, but about creating a supportive environment where everyone felt empowered to pursue their fitness goals. With a background in fitness training, Kartik dreamed of a place where people of all backgrounds could come together to improve their health and well-being.</p>
            </div>
        </div>
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
</body>
</html>