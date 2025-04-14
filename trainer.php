<?php
session_start();
include 'conne.php';

// Ensure the user is logged in
if (!isset($_SESSION['username'])) {
    header("Location: tlogin.php"); // Redirect to login page if not logged in
    exit();
}

// Fetch trainer data based on the logged-in username
$username = $_SESSION['username']; // Get the logged-in username from the session
$query = "SELECT * FROM tbl_gellery WHERE name = '$username'";
$res = mysqli_query($conn, $query);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="bootstrap.min.css">
    <title>Trainer Dashboard</title>
    <style>
        * {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}
body {
    font-family: Arial, sans-serif;
    background-color: white; /* Light background color */
    color: black;
}
.container {
    max-width: 1200px;
    margin: auto;
    padding: 20px;
}
.trainer-card {
    border: 2px solid white; /* Grayish border */
    padding: 20px;
    margin-bottom: 20px;
    background-color: white; /* Light background color for card */
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    display: flex;
    flex-direction: column;
    align-items: center;
    border-radius: 12px;
}
.trainer-card h2 {
    color: #6d8196; /* Grayish color for heading */
}
.trainer-card img {
    border-radius: 50%;
    margin-bottom: 15px;
}
.trainer-card .info {
    text-align: center;
}
.trainer-card .info p {
    margin: 10px 0;
    color: #6d8196; /* Lighter gray text for info */
}
.btn {
    margin-top: 10px;
    background-color: #6d8196; /* Gray button */
    color: white;
    padding: 8px 16px;
    border: none;
    cursor: pointer;
    text-decoration: none;
    border-radius: 5px;
}
.btn:hover {
    background-color: #6d8196; /* Darker gray on hover */
}
h1 {
    color: #6d8196; /* Gray heading */
    text-align: center;
    margin-bottom: 40px;
}

/* General Navbar styling */
.navbar {
    background-color: #6d8196; /* Darker background color for the navbar */
    padding: 10px 20px;
}

.navbar-nav .nav-item .nav-link {
    color: #ffffff !important; /* White color for links */
    font-weight: bold;
    text-transform: uppercase; /* Uppercase for the links */
    transition: color 0.3s ease-in-out; /* Smooth color transition on hover */
}

.navbar-nav .nav-item .nav-link:hover {
    color: #a1a3a7 !important; /* Light grey color on hover */
    text-decoration: underline; /* Underline effect on hover */
}

.navbar-brand h5 {
    color: #ffffff; /* White color for the brand name */
    font-weight: bold;
}

.navbar-toggler-icon {
    background-color: #ffffff; /* White color for the toggler icon */
}

.navbar-toggler {
    border-color: #ffffff; /* White color for the navbar toggler border */
}

/* Image styling for the logo */
.navbar-brand img {
    border: 3px solid #ffffff; /* White border color around the logo */
}

/* Navbar styling for smaller screens (responsive) */
@media (max-width: 768px) {
    .navbar-nav {
        text-align: center; /* Center the navbar links on smaller screens */
    }

    .navbar-nav .nav-item {
        margin-bottom: 10px; /* Add space between the items */
    }
}

/* Styling the links in the dropdown or additional sections */
.navbar-nav .nav-item a {
    color: #ffffff; /* White color for links */
}

.navbar-nav .nav-item a:hover {
    color: #a1a3a7; /* Light grey color for hover effect */
    font-weight: bold;
}


/* Make the form container more responsive */
@media (max-width: 767px) {
    body {
        margin-top: 50px;
    }
    .container {
        padding: 10px;
    }
    .trainer-card {
        width: 90%; /* Take more space on small screens */
        padding: 15px 25px;
    }
}

    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg">
        <a class="navbar-brand">
            <img src="LOGO.jpg" alt="logo" height="70" width="70" class="rounded-circle">
            <h5 class="d-inline-block"><span style="color: white;">GYMSHINE TRAINER</span></h5>
        </a>
        <button class="navbar-toggler" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item"><a class="nav-link" href="trainer.php">Trainer</a></li>
                <li class="nav-item"><a class="nav-link" href="tlogout.php">Logout</a></li>
            </ul>
        </div>
    </nav>

    <div class="container mt-5">
        <h1>Welcome, <?php echo $_SESSION['username']; ?>!</h1>

        <!-- Display trainer's data vertically -->
        <div class="trainer-cards">
            <?php
            // Assuming the session username is set and you are fetching trainer data
            $username = $_SESSION['username']; 
            $res = mysqli_query($conn, "SELECT * FROM tbl_gellery WHERE username = '$username'");
            
            // Check if there are any rows returned
            if (mysqli_num_rows($res) > 0) {
                while ($row = mysqli_fetch_assoc($res)) {
                    echo "<div class='trainer-card'>";
                    echo "<img src='" . $row['photo'] . "' alt='Trainer Photo' height='150' width='150'>";
                    echo "<h2>" . $row['name'] . "</h2>";
                    echo "<div class='info'>";
                    echo "<p><strong>Experience:</strong> " . $row['experiance'] . "</p>";
                    echo "<p><strong>Specialization:</strong> " . $row['specialization'] . "</p>";
                    echo "<p><strong>Branch:</strong> " . $row['branche'] . "</p>";
                    echo "</div>";
                    echo "<a href='update.php?id=" . $row['id'] . "' class='btn'>UPDATE</a>";
                    echo "</div>";
                }
            } else {
                echo "<p>No data found for this trainer.</p>";
            }
            ?>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
</body>
</html>
