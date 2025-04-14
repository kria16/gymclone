<?php
session_start();
require_once('conne.php');


if (!isset($_SESSION['email'])) {
    header("Location: login.php");
    exit();
}

$email = $_SESSION['email'];  
$sql = "SELECT * FROM register WHERE email='$email'";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();
} else {
    echo "No user data found!";
    exit();
}
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile Page</title>
    <link href="bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="index.css">
    <style>
       
body {
    font-family: Arial, sans-serif;
    background-color: black;
    color: #B5BBC9;
}

.profile-sidebar {
    background-color: #B5BBC9;
    padding: 20px;
    position: absolute;
    height: 100%;
    transition: margin-right 0.3s ease-in-out;

}

@media (min-width: 768px) {
    .profile-sidebar {
        transform: translateX(0); 
        width: 250px;
    }
}

.profile-sidebar a {
    display: block;
    padding: 10px 0;
    color: black;
    text-decoration: none;
}
.profile-sidebar a:hover {
    background-color: #f0f0f0;
}

.sidebar-toggle {
    background-color: orange;
    color: #B5BBC9;
    border: none;
    padding: 10px 20px;
    font-size: 18px;
    cursor: pointer;
    display: block;
    margin: 10px;
    transition: 0.3s ease-in-out;

}
.sidebar-toggle:hover {
    background-color: #ff7f00;
}

.profile-sidebar.active {
    transform: translateX(0); 
}

.profile-main {
    padding: 20px;
    margin-left: 250px; 
    transition: margin-left 0.3s ease-in-out;
}
.profile-header {
    text-align: center;
}
.profile-header img {
    width: 100px;
    height: 100px;
    border-radius: 50%;
}

.profile-info {
    margin-top: 20px;
    display: flex;
    flex-wrap: wrap;
}
.profile-info label {
    font-weight: bold;
    width: 50%;
    padding-bottom: 10px;
}
.profile-info input, select {
    width: 50%;
    padding: 5px 0;
    border: none;
    border-bottom: 2px solid #ccc;
    margin-bottom: 20px;
    background-color: transparent;
    outline: none;
    color: #B5BBC9;
}
.profile-info input:focus, select:focus {
    border-bottom: 2px solid orange;
}
.profile-info input::placeholder {
    color: #999;
}
.profile-info select {
    padding-left: 0;
}
.save-button {
    background-color: orange;
    color: #B5BBC9;
    border: none;
    padding: 10px 15px;
    cursor: pointer;
    margin-top: 10px;
}
.save-button:hover {
    background-color: #ff7f00;
}

@media (max-width: 768px) {
    
    .profile-sidebar {
        width: 50%; 
        transform: translateX(-100%); 
    }
    
    .profile-sidebar.active {
        transform: translateX(0); 
    }
    .profile-main {
        margin-left: 0; 
    }
    
    .profile-info label,
    .profile-info input,
    select {
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
                    <a class="nav-link" href="userprofile.php"><img src="user 2.png" width="30"></a>
                </li>
            </ul>
            
        </div>
    </nav>
    <!--main page-->
    <div class="container-fluid">
    <div class="row">
        <button class="sidebar-toggle d-md-none" onclick="toggleSidebar()">☰</button>

        <!-- Sidebar -->
        <div class="col-md-3 profile-sidebar" id="profileSidebar">
            <a href="userprofile.php" class="text-danger">VIEW PROFILE</a>
            <a href="logout.php">Logout<img src="logout 2.png" width="30px"></a>
        </div>

        <!-- Profile Main Content -->
        <div class="col-md-9 profile-main">
            <h3>Profile</h3>
            <hr>
            <form method="POST" action="update_profile.php">
                <div class="profile-info">
                    <!-- Profile fields here -->
                    <label for="name">Name</label>
                    <input type="text" id="name" name="name" value="<?php echo $user['name']; ?>">

                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" value="<?php echo $user['email']; ?>">

                    <label for="contact">Contact</label>
                    <input type="text" id="contact" name="contact" value="<?php echo $user['contact']; ?>">

                    <label for="age">Age</label>
                    <input type="text" id="age" name="age" value="<?php echo $user['age']; ?>">

                    <label for="birthday">Date Of Birth</label>
                    <input type="date" id="birthday" name="birthday" value="<?php echo $user['birthday']; ?>">

                    <label for="gender">Gender</label>
                    <select id="gender" name="gender">
                        <option value="Male" <?php if (strcasecmp($user['gender'], 'Male') == 0) echo 'selected'; ?>>Male</option>
                        <option value="Female" <?php if (strcasecmp($user['gender'], 'Female') == 0) echo 'selected'; ?>>Female</option>
                    </select>


                    <label for="address">Address</label>
                    <input type="text" id="address" name="address" value="<?php echo $user['address']; ?>">

                    <label for="city">City</label>
                    <input type="text" id="city" name="city" value="<?php echo $user['city']; ?>">

                    <label for="zip">ZIP Code</label>
                    <input type="text" id="zip" name="zip" value="<?php echo $user['zip']; ?>">
                </div>
                <button type="submit" class="save-button">Save Changes</button>
            </form>
        </div>
    </div>
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
            <p style="color: black;">© 2024-2025All Rights Reserved</p>
        </div>
</footer>
<script>
    function toggleSidebar() {
        var sidebar = document.getElementById('profileSidebar');
        sidebar.classList.toggle('active'); 
        if (sidebar.classList.contains('active')) {
            document.addEventListener('click', outsideClickListener);
        } else {
            document.removeEventListener('click', outsideClickListener);
        }
    }

    function outsideClickListener(event) {
        var sidebar = document.getElementById('profileSidebar');
        if (!sidebar.contains(event.target) && !event.target.classList.contains('sidebar-toggle')) {
            sidebar.classList.remove('active');
            document.removeEventListener('click', outsideClickListener);
        }
    }
</script>


</body>
</html>