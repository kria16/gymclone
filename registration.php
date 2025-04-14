<?php
include('conne.php' );
?>
            





<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title>Admin Dashboard</title>
<style>
        * {
            margin: 0;
            padding: 0;
        }
        body {
            font-family: Arial, sans-serif;
            background-color: black;
            color: white;
        }
        .container {
            max-width: 1200px;
            margin: auto;
            padding: 20px;
        }
.content{
    padding-left: 100px;
}
table{
    padding-left: 400px;
}
table th {
    background-color: orangered; 
    color: white; 
}
table td{
    color: white;
}
.profile-sidebar {
    background-color: white;
    color:black;
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
    color: white;
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
h1{
    padding-left:400px;
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
<nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand">
            <img src="LOGO.jpg" alt="logo" height="70" width="70" class="rounded-circle">
            <h5 class="d-inline-block">GYM<span style="color: orangered;">SHINE ADMIN</span></h5>
        </a>
        <button class="navbar-toggler" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item"><a class="nav-link" href="admindash.php">admin</a></li>
                <li class="nav-item"><a class="nav-link" href="admincareer.php">Careers</a></li>
                <li class="nav-item"><a class="nav-link" href="adminmembership.php">Membership</a></li>
                <li class="nav-item"><a class="nav-link" href="registration.php">Register</a></li>
                <li class="nav-item"><a class="nav-link" href="admtrainer.php">Trainers</a></li>
                <li class="nav-item"><a class="nav-link" href="admin_branch.php">Branch</a></li>
                <li class="nav-item"><a class="nav-link" href="franchise2.php">Franchise</a></li>
                <li class="nav-item"><a class="nav-link" href="admincontact.php">contact</a></li>
                <li class="nav-item"><a class="nav-link" href="adlogout.php">Logout</a></li>
            </ul>
        </div>
    </nav>
    <div class="content">
        <h1>user's details</h1>
    </div>
    <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
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

</body>
</html>
