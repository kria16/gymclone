<?php
include('conne.php' );
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="bootstrap.min.css">
<title>User Details Management</title>
<style>
    * {
        margin: 0;
        padding: 0;
    }
    body {
        font-family: Arial, sans-serif;
        background-color:white;
        color: black;
        
    }
    .container {
        max-width: 1200px;
        margin: auto;
        padding-left: 170px;
    }
    .content{
    padding-left: 360px;
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
        color: white;
    }

    .container-fluid {
        margin-left: 250px;
        padding: 20px;
    }

    .footer {
        background-color: #6D8196;
        color: white;
        padding: 2px 0;
        text-align: center;
    }
    .footer a {
        color: white;
        text-decoration: none;
        text-align: center;
    }
    .footer p{margin-bottom:0rem;}
    .footer a:hover {
        color: black;
    }
    .responsive-table {
        display: flex;
        justify-content: center;
        align-items: center;
        flex-direction: column;
    }

    .table {
        width: 100%;
        border-collapse: collapse;
        border: 1px solid #6D8196;
    }

    th, td {
        padding: 10px;
        text-align: left;
        border: 1px solid #6D8196;
        color: black;
    }
    th {
        background-color: #6D8196;
        color: white;
    }
    span{
    padding-left:6px;
}
    #logo{
        padding-left:3px;
    }
    .btn {
        margin: 5px 0;
        padding: 10px 15px;
        border: none;
        color: white;
        cursor: pointer;
        border-radius: 4px;
    }

    .btn-success {
        background-color: #585E6C;
    }

    .btn-warning {
        background-color: #ff9800;
    }

    .btn-danger {
        background-color: #f44336;
    }

    .btn:hover {
        opacity: 0.8;
    }

    @media (max-width: 767px) {
        .container-fluid {
            margin-left: 0;
        }

        .sidebar {
            width: 100%;
            height: auto;
            position: relative;
        }

        .sidebar .navbar-nav {
            flex-direction: row;
            justify-content: space-around;
        }

        .responsive-table {
            width: 100%;
        }

        .table {
            width: 100%;
        }
    }
    .footer {
        background-color: #6D8196;
        color: white;
        padding: 3px 0;
        text-align: center;
    }
    .footer a {
        color: white;
        text-decoration: none;
        text-align: center;
    }
    .footer a:hover {
        color: black;
    }
</style>
</head>
<body>
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
</div>
    <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
        <div class="content">
            <h1>User Details</h1>
        </div>
            <table class="table table-bordered text-center">
                <thead>
                    <tr>
                        <th>Full Name</th>
                        <th>Email</th>
                        <th>Contact Number</th>
                        <th>Age</th>
                        <th>Birthday</th>
                        <th>Gender</th>
                        <th>Address</th>
                        <th>City</th>
                        <th>Zip</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $query = "SELECT * FROM `register`";
                        $result = mysqli_query($conn, $query);
                        if ($result) {
                            while ($row = mysqli_fetch_array($result)) {
                                ?>
                                <tr>
                                    <td><?php echo $row['name']; ?></td>
                                    <td><?php echo $row['email']; ?></td>
                                    <td><?php echo $row['contact']; ?></td>
                                    <td><?php echo $row['age']; ?></td>
                                    <td><?php echo $row['birthday']; ?></td>
                                    <td><?php echo $row['gender']; ?></td>
                                    <td><?php echo $row['address']; ?></td>
                                    <td><?php echo $row['city']; ?></td>
                                    <td><?php echo $row['zip']; ?></td>
                                </tr>
                                <?php
                            }
                        }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

   
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
<!-- Footer Section -->

<footer class="footer" style="margin-top: 390px;">
        <div class="container">
            <p>© 2023-2024 All Rights Reserved. | <a href="#">Privacy Policy</a> | <a href="#">Terms of Service</a></p>
        </div>
    </footer>
</body>
</html>
