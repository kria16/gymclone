<?php
include 'conne.php'; // Database connection

// Fetch branches from the database
$qry = "SELECT * FROM branches";
$result = mysqli_query($conn, $qry);
$branches = mysqli_fetch_all($result, MYSQLI_ASSOC);
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" ></script>
     <link href="bootstrap.min.css" rel="stylesheet">    
     <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
     <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
     <script src="bootstrap.min.css"></script>
     <link rel="stylesheet" href="index.css">
    <title>Branch</title>
    <style>
        body{
            color: white;
            letter-spacing: 1px;
            word-spacing: 2px;
            background-color: #080808;
        }
        *{
            box-sizing: border-box;
        }
        .header{
            align-items: center;
            color: rgb(243, 238, 238);
            padding-top: 5px;
            font-size: 40px;
            font-weight: 8;
            text-align: center;
            font-family: 'Trebuchet MS', 'Lucida Sans Unicode', 'Lucida Grande', 'Lucida Sans', Arial, sans-serif;
        }
        .branches{
            padding-bottom: 5%;
        }
        .branches a{
            font-size: 18px;
            color: white;
            padding: 7px;
            margin: 3px;
            cursor: pointer;
            border: 2px solid white;
            border-radius: 10px;
        }
        .btn-active {
            color: #2bd40f !important;
            border: 2px solid #2bd40f !important;
        }
        .container-fluid{
            width: 100%;
            padding-right: 15px;
            padding-left: 15px;
            margin-right: auto;
            margin-left: auto;
        }
        .row {
            display: flex;
            flex-wrap: wrap;
            margin-right: -15px;
            margin-left: -15px;
        }
        .col-lg-6.col-md-6.col-sm-12.col-12 {
            flex: 0 0 50%;
            max-width: 50%;
        }
        .branch-details{
            display: flex;
            flex: 0 0 50%; 
            margin-left: 50px;
            margin-top: 20px;
            text-align: justify;
            padding-left: 50px; 
            padding: 15px;
            padding-top: 5px;       
        }
        .map-location {
            height: 500px;
            position: relative;
            margin-left: -15px;
            margin-right: -15px;
        }
        .map-location iframe {
            position: absolute;
            width: 100%;
            height: 100%;
            left: 0;
            top: 0;
            border: 0;
        }
        .section-title{
            margin-right: 20px;
            margin-left: -15px;
        }
        .section-title p{
            font-size: larger;
            font-weight: bold;
        }
        .section-title h2{
            font-size: 500;
            margin-bottom: 10px;
            color: orangered;
        }
        /*responsive style*/
        @media (max-width: 992px) {
            .header {
                font-size: 30px; 
            }
            .branches {
                padding-bottom: 5%;
            }
            .branch-details {
                margin-left: 20px; 
                padding-left: 20px; 
            }
            .map-location {
               width: 400px;
               height: 400px;
            }
        }
        @media (max-width: 760px) {
            .header {
                font-size: 24px; 
            }
            .branches {
                padding-bottom: 5%;
            }
            .branches a {
                width: 100%; 
                text-align: center; 
            }
            .branch-details {
                margin-left: 50px; 
                padding-left: 0;
                margin-top: 4px; 
            }
            .map-location {
                width: 400px;
                height: 400px;
            }
            .col-lg-6,.col-md-6,.col-sm-12,.col-12{
                flex: 0 0 100%;
                max-width: 100%;
            }
        }
        @media (max-width:430px){
            .col-lg-6,.col-md-6,.col-sm-12,.col-12{
                flex: 0 0 100%;
                max-width: 100%;
            }
            .branch-details {
                margin-top: 10px;
                padding: 10px; 
            }
            .map-location {
                width: auto;
                height: 400px;
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
        <!--branch-->
        <div class="branch">
    <div class="header">
        <div class="heading">
            <h2>Our <span style="color: orangered;">Branches</span></h2>
        </div>
        <div class="branches mt-md-4">
            <?php foreach ($branches as $index => $branch): ?>
                <a href="javascript:void(0);" id="<?= strtolower(str_replace(' ', '-', $branch['name'])) ?>-btn" class="<?= $index === 0 ? 'btn-active' : '' ?>">
                    <?= $branch['name'] ?>
                </a>
            <?php endforeach; ?>
        </div>
    </div>
    <div class="container-fluid">
        <?php foreach ($branches as $index => $branch): ?>
            <div class="branch-content <?= strtolower(str_replace(' ', '-', $branch['name'])) ?> row" style="<?= $index === 0 ? '' : 'display: none;' ?>">
                <div class="col-lg-6 col-md-12">
                    <div class="map-location">
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3717.596782094336!2d72.76432190920875!3d21.287422778765716!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3be04a52953e0849%3A0x467b9c475ae0ebe6!2sM%20L%20Parmar%20Science%20College!5e0!3m2!1sen!2sin!4v1723564349251!5m2!1sen!2sin"  style="border:0;"></iframe>
                    </div>
                </div>
                <div class="col-lg-6 col-md-12">
                    <div class="branch-details">
                        <div class="section-title">
                            <h2><?= $branch['name'] ?> Branch</h2>
                            <p>Front Desk: <?= $branch['desk'] ?></p>
                            <p>General Trainer: <?= $branch['general'] ?></p>
                            <p>Personal Trainers: <?= $branch['personal'] ?></p>
                            <p>Branch Manager: <?= $branch['manager'] ?></p>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>


        <hr>
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
                            <li><a href="branch.php">Vesu </a></li>
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
    // JavaScript to handle branch tab switching
    document.querySelectorAll('.branches a').forEach(btn => {
        btn.addEventListener('click', function() {
            const branchClass = this.id.replace('-btn', '');
            document.querySelectorAll('.branch-content').forEach(content => {
                content.style.display = 'none';
            });
            document.querySelector('.' + branchClass).style.display = 'flex';
            document.querySelectorAll('.branches a').forEach(a => {
                a.classList.remove('btn-active');
            });
            this.classList.add('btn-active');
        });
    });
</script>
</body>
</html>
