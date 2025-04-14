<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title>contact Management</title>
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
        .responsive-table {
            overflow-x: auto;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            padding: 10px;
            text-align: left;
            border: 1px solid white;
            color: white;
        }
        th {
            background-color: orangered;
            color: white;
        }
        .btn {
            margin: 5px 0;
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
    <h2>contact details</h2>
<br>
</body>
</html>
<?php
include("conne.php");
?>
<table border="1px">
        <tr>
            <th>Full Name</th>
            <th>Email</th>
            <th>Contact Number</th>
            <th>message</th>
        </tr>
            <?php
                $query="SELECT * FROM `contact`";
                $result=mysqli_query($conn,$query);
                $row=mysqli_num_rows($result);
                if($result){
                    while($row=mysqli_fetch_array($result)){
                            ?>
                        <tr>
                                <td><?php echo $row['name']?></td>
                                <td><?php echo $row ['email']?></td>
                                <td><?php echo $row ['phone']?></td>
                                <td><?php echo $row ['message']?></td>
                        </tr>
                    </table>
                        <?php
                    }
                   
                }
?>