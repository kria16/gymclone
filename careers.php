<?php
include 'conne.php';

// Fetch career data from the database
$qry = "SELECT * FROM careers";
$result = mysqli_query($conn, $qry);
$jobListings = [];

while ($row = mysqli_fetch_assoc($result)) {
    $jobListings[] = $row;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" ></script>
     <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">    
     <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
     <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
     <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="index.css">
     <title>Careers</title>
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
        .text-center{
            font-weight: 800;
            font-size: 400%;
        }
        .scentence{
            padding-top: 2%;
            font-size: larger;
            padding-bottom: 2%;
        }
        .images{
            display: flex; 
        }
        .about-gym{
            display: flex;
            flex-wrap: wrap;
            margin-top: 2%;
        }
        .col-lg-6 .col-md-12{
            position: relative;
            width: 100%;
            display: flex;
            padding-right: 15px;
            padding-left: 15px;
            
        }
        .images img{
            border-radius: 4%;
            width: 100%;
        }
        .about-gym img{
            width: 100%;
            border-radius: 5%;
        }
        .events, .benefit, .ourteam{
            padding-bottom: 20%;
            padding-top: 10%;
            width: 60%;
            margin: auto;
        }
        .team{
            display: block;
        }
        .contentcontainer{
            margin-top: 5%;
            background-color: rgba(240, 239, 239, 0.985);
            color: black;
        }
        .container {
            margin: 3%;
            padding-top: 5%;
            color: rgb(242, 239, 239);
        }
        h2 {
            margin-bottom: 1rem;
        }
        #jobs{
            background-color: rgba(189, 48, 48, 0);
        }
        .job-listing {
            border: 1px solid #ddd;
            padding: 1rem;
            margin-bottom: 1rem;
            border-radius: 8px
        }
        .job-listing h3 {
            margin-bottom: 0.5rem;
        }
        .job-listing a {
            color: #007bff;
            text-decoration: none;
        }
        .job-listing a:hover {
            text-decoration: underline;
        }
        .job-listing p{
            margin: 0%;
        }
        @media (max-width: 992px) {
        .text-center {
            font-size: 2.5rem;
        }
        .scentence {
            font-size: 1rem;
        }
        .images{
                flex-direction: column;
            }
        }
        @media (max-width: 890px){
            .images{
                flex-direction: column;
            }
        }
        @media (max-width: 768px) {
        .text-center {
            font-size: 2rem;
        }
        .scentence {
            font-size: 0.9rem;
            padding: 2% 2%;
        }
        .images {
            flex-direction: column;
        }
        .about-gym {
            flex-direction: column;
            align-items: center;
        }
        .events, .benefit, .ourteam {
            padding: 5% 2%;
        }
        }
        @media (max-width: 576px) {
        .text-center {
            font-size: 1.5rem;
        }
        .scentence {
            font-size: 0.8rem;
            padding: 2% 1%;
        }
        .job-listing {
            padding: 0.5rem;
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
                        <a class="nav-link" href="login.php">Login</a>
                    </li>
                </ul>
                <ul>
                <li class="nav-item">
                    <a href="userprofile1.php"><img src="user 2.png" width="30px" ></a>
                </li>
            </ul>
            </div>
        </nav>
        <!--careers-->
        <h1 style="margin: auto; text-align: center; padding-top: 3%; padding-bottom: 2%;">COME JOIN US</h1>
        <div class="about-gym">
            <div class="col-lg-6 col-md-12">
                <div class="events">
                    <h4>Events at fitpass</h4>
                    <div class="team">New and exciting events are unravelling at FITPASS as we push the boundaries of what's possible in fitness technology.</div>
                </div>
                <img src="team.jpg">
                <div class="benefit">
                    <h4>Benefit</h4>
                    <div class="team">Our young, ambitious team is driven by a shared passion for fitness and a relentless pursuit of progress</div>
                </div>
            </div>
            <div class="col-lg-6 col-md-12">
                <img src="events.jpg">
                <div class="ourteam">
                    <h4>Our team</h4>
                    <div class="team">We provide our employees the support and resources they need to thrive, including competitive compensation and comprehensive benefits.</div>
                </div>
                <img src="ourteam.jpg">
            </div>
        </div>
        <div class="contentcontainer">
            <div class="text-center">
                What are we looking for?
            </div>
            <div class="scentence">
                A craze for fitness and zeal that’s hard to contain. It doesn’t matter who you are, how old you are or where you’re from. We are a young group with no limits when it comes to initiative and responsibility. And, we are looking for others like us. Apart from executing the assigned tasks, we want to expand our team with people who have the vision and drive to take things to the next level. If you have ideas and a passion to execute them
            </div>
            <div class="images">
                <div class="col-lg-6 col-md-12">
                    <img src="look1.jpg"alt="gymshine">
                </div>
                <div class="col-lg-6 col-md-12">
                    <img src="look2.jpg" alt="gymshine">
                </div>
            </div>
        </div>
        <section id="jobs">
            <div class="container">
                <h2>Job Openings</h2>
                <div class="job-listings-container">
                    <?php foreach ($jobListings as $job): ?>
                        <div class="job-listing">
                            <h3><?php echo htmlspecialchars($job['work_name']); ?></h3>
                            <p>Location: <?php echo htmlspecialchars($job['location']); ?></p>
                            <p>Responsibilities: <?php echo htmlspecialchars($job['responsibilities']); ?></p>
                            <p>Exp: <?php echo htmlspecialchars($job['exp']); ?></p>
                            <a href="mailto:gymshine123@gmail.com">Apply Now</a>
                        </div>
                        <?php endforeach; ?>
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