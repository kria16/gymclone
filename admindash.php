<?php
include 'conne.php';
// session_start(); // Start session to access session variables

// // Check if the admin_username session is set
// if (isset($_SESSION['admin_username'])) {
//     $adminUsername = $_SESSION['admin_username'];
//     echo "Welcome back, Admin: " . $adminUsername;

//count of registered users
$userCountQuery = "SELECT COUNT(*) AS count FROM register";
$userCountResult = $conn->query($userCountQuery);
$userCount = $userCountResult->fetch_assoc()['count'];

//count of trainers
$trainerCountQuery = "SELECT COUNT(*) AS count FROM trainer";
$trainerCountResult = $conn->query($trainerCountQuery);
$trainerCount = $trainerCountResult->fetch_assoc()['count'];

//count of registered users
$membershipCountQuery = "SELECT COUNT(*) AS count FROM membership";
$membershipCountResult = $conn->query($membershipCountQuery);
$membershipCount = $membershipCountResult->fetch_assoc()['count'];

$conn->close();
// }
?>



<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="bootstrap.min.css">
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<title>Admin Dashboard</title>
<style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }
    body {
        font-family: Arial, sans-serif;
        background-color: white;
        color: black;
        display: flex;
        flex-direction: column;
        min-height: 100vh;
    }
    .sidebar {
        width: 270px;
        position: fixed;
        top: 0;
        left: 0;
        height: 100%;
        background-color: #6D8196;
        padding-top: 20px;
        border-right: 1px solid #e4e5e7;
    }
    span {
        padding-left: 6px;
    }
    #logo {
        padding-left: 3px;
    }
    .sidebar .navbar-brand {
        display: flex;
        align-items: center;
        margin-bottom: 1rem;
        padding: -2px 15px;
    }
    .sidebar .navbar-nav {
        flex-direction: column;
        width: 100%;
    }
    .sidebar .nav-item {
        width: 100%;
    }
    .sidebar .nav-link {
        color: white;
        padding: 10px 15px;
        display: block;
        width: 100%;
        text-align: left;
    }
    .sidebar .nav-link:hover {
        background-color: white;
        color: black;
    }
    .sidebar .nav-item.active .nav-link {
        background-color: white;
        color: black;
    }
    .content {
        margin-left: 270px;
        padding: 20px;
        flex-grow: 1;
        overflow-y: auto;
    }
    .dashboard-stats {
        display: flex;
        justify-content: center;
        gap: 20px;
        margin-top: 20px;
    }
    .chart-container {
    width: 750px;
    height: 400px;
    margin-left: 500px;
}

    .stat {
        background-color: #6D8196;
        color: white;
        border-radius: 12px;
        padding: 20px;
        width: 200px;
        text-align: center;
    }
    #userCount, #trainerCount, #membershipCount{
        font-size: 50px;
    }
    .footer {
        background-color: #6D8196;
        color: white;
        padding: 3px 0;
        text-align: center;
        margin-top:50px; 
    }
    .footer a {
        color: white;
        text-decoration: none;
        text-align: center;
    }
    .footer a:hover {
        color: black;
    }
    .dashboard-container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            margin-left:275px;
            gap: 10px;
        }
        .dashboard-card {
            background: #e0e0e0;
            color: #333;
            text-align: center;
            padding: 20px;
            border-radius: 10px;
            transition: transform 0.3s, box-shadow 0.3s;
        }
        .dashboard-card:hover {
            transform: scale(1.10);
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        }
        .dashboard-card i {
            font-size: 30px;
            margin-bottom: 10px;
            color: #555;
        }
        .btn-light {
            background-color: #d6d6d6;
            border: none;
            color: #333;
        }
        .btn-light:hover {
            background-color: #bfbfbf;
        }
</style>
</head>
<body>
    <!-- Sidebar -->
    <div class="d-flex">
        <!-- Side Navbar -->
        <nav class="sidebar">
            <div class="sidebar-sticky">
                <a class="navbar-brand">
                    <img class="media-imlocation rounded-circle" id="logo" src="LOGO.jpg" alt="logo" height="70" width="70" margin="2px">
                    <span style="color: white;">GYMSHINE ADMIN</span>
                </a>
                <ul class="navbar-nav flex-column">
                    <li class="nav-item"><a class="nav-link" href="admindash.php">Admin</a></li>
                    <li class="nav-item"><a class="nav-link" href="adcareer.php">Careers</a></li>
                    <li class="nav-item"><a class="nav-link" href="admembership.php">Membership</a></li>
                    <li class="nav-item"><a class="nav-link" href="aduserdetails.php">Register</a></li>
                    <li class="nav-item"><a class="nav-link" href="adtrainer.php">Trainers</a></li>
                    <li class="nav-item"><a class="nav-link" href="payments.php">Payment</a></li>
                    <li class="nav-item"><a class="nav-link" href="adbranch.php">Branch</a></li>
                    <li class="nav-item"><a class="nav-link" href="adfranchise.php">Franchise</a></li>
                    <li class="nav-item"><a class="nav-link" href="adcontact.php">Contact</a></li>
                    <li class="nav-item"><a class="nav-link" href="adlogout.php">Logout</a></li>
                </ul>
            </div>
        </nav>

        <div class="content">
            <h1>Welcome Admin!</h1>

            <div class="dashboard-stats">
                <div class="stat">
                    <h3>Total Users</h3>
                    <p id="userCount"><?php echo $userCount; ?></p>
                </div>
                <div class="stat">
                    <h3>Total Trainers</h3>
                    <p id="trainerCount"><?php echo $trainerCount; ?></p>
                </div>
                <div class="stat">
                    <h3>Total Membership</h3>
                    <p id="membershipCount"><?php echo $membershipCount; ?></p>
                </div>
            </div>
        </div>
    </div>
    <div class="chart-container">
    <canvas id="pageChart"></canvas>
</div>

<br>
<script>
    // Sample data for pages
    const data = {
        labels: ['Career', 'Franchise', 'User', 'Trainer', 'Membership', 'Contact', 'Branch'], // Added "Branch"
        datasets: [{
           
            data: [3, 2, 2, 4, 4, 1, 4], // Added data for "Branch"
            backgroundColor: [
                '#A3B1C2',
                '#A3B1C2',
                '#A3B1C2',
                '#A3B1C2',
                '#A3B1C2',
                '#A3B1C2',
                '#A3B1C2' // Color for "Branch"
            ],
            borderColor: [
                'rgb(201, 208, 212)',
                'rgb(201, 208, 212)',
                'rgb(201, 208, 212)',
                'rgb(201, 208, 212)',
                'rgb(201, 208, 212)',
                'rgb(201, 208, 212)',
                'rgb(201, 208, 212)' // Border color for "Branch"
            ],
            borderWidth: 1
        }]
    };

    const config = {
    type: 'bar',
    data: data,
    options: {
        responsive: true, // Stops auto-resizing
        maintainAspectRatio: false, // Ensures fixed height
        scales: {
            y: { beginAtZero: true }
        },
        plugins: {
            legend: { display: false },
            title: {
                display: true,
                text: 'Page Interaction Overview'
            }
        }
    }
};


    // Render the chart
    const myChart = new Chart(
        document.getElementById('pageChart'),
        config
    );
</script>
    <!-- Footer Section -->
    <footer class="footer">
        <div class="container">
            <p>© 2023-2024 All Rights Reserved. | <a href="#">Privacy Policy</a> | <a href="#">Terms of Service</a></p>
        </div>
    </footer>

    <script>
        function toggleSidebar() {
            var sidebar = document.getElementById('profileSidebar');
            sidebar.classList.toggle('active');
            document.addEventListener('click', outsideClickListener);
        }

        function outsideClickListener(event) {
            var sidebar = document.getElementById('profileSidebar');
            if (!sidebar.contains(event.target) && sidebar.classList.contains('active')) {
                sidebar.classList.remove('active');
                document.removeEventListener('click', outsideClickListener);
            }
        }
    </script>
</body>
</html>
