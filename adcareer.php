<?php
include 'conne.php';

if (isset($_POST['insert'])) {
    $work_name = $_POST['work_name'];
    $location = $_POST['location'];
    $responsibilities = $_POST['responsibilities'];
    $exp = $_POST['exp'];
    $qry = "INSERT INTO careers (work_name, location, responsibilities, exp) VALUES ('$work_name', '$location', '$responsibilities', '$exp')";
    mysqli_query($conn, $qry);
}

if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $qry = "DELETE FROM careers WHERE id='$id'";
    mysqli_query($conn, $qry);
}

$careers = null;
if (isset($_GET['update_id'])) {
    $id = $_GET['update_id'];
    $qry = "SELECT * FROM careers WHERE id='$id'";
    $result = mysqli_query($conn, $qry);
    $careers = mysqli_fetch_assoc($result);
}

if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $work_name = $_POST['work_name'];
    $location = $_POST['location'];
    $responsibilities = $_POST['responsibilities'];
    $exp = $_POST['exp'];
    $qry = "UPDATE careers SET work_name='$work_name', location='$location', responsibilities='$responsibilities', exp='$exp' WHERE id='$id'";
    mysqli_query($conn, $qry);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="bootstrap.min.css">
    <title>Career Management</title>
    <style>
body {
    font-family: Arial, sans-serif;
    background-color: white;
    color: black;
    margin: 0;
    padding: 0;
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
        overflow-y: auto;
        transition: transform 0.3s ease;
    }
    .sidebar.collapsed {
        transform: translateX(-100%);
    }
    .sidebar .navbar-brand {
        display: flex;
        align-items: center;
        margin-bottom: 1rem;
        padding: 0 15px;
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
    #sidebarToggler {
        display: none;
    }
    .content {
        margin-left: 270px;
        padding: 20px;
        flex-grow: 1;
        overflow-y: auto;
        transition: margin-left 0.3s ease;
    }
    .content.sidebar-collapsed {
        margin-left: 0;
    }
.container-fluid {
    margin-left: 250px; /* Offset for the sidebar */
    padding: 20px;
}

/* Table Styles */
.table {
    width: 100%;
    border-collapse: collapse;
}

th, td {
    padding: 10px;
    text-align: left;
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
/* Button Styles */
.btn {
    padding: 10px 15px;
    border: none;
    color: white;
    cursor: pointer;
    border-radius: 4px;
}

.btn-success {
    background-color: #6D8196;
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

.form-group {
    margin-bottom: 1rem;
}

.form-group label {
    margin-bottom: 0.5rem;
}

.form-group input {
    width: 55%;
    border: 1px solid #ccc;
    border-radius: 2px solid;
    display: inline;
}
.form-control{
    width: 10%;
}
#careerForm{
    text-align:center;   
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
    .footer p{margin-bottom:0rem;}
/* Ensuring responsive layout */
@media (max-width: 768px) {
    /* Make the sidebar toggler button visible on small screens */
    #sidebarToggler {
        display: block;
        position: fixed;
        top: 20px;
        left: 20px;
        z-index: 999; /* Make sure it's above other elements */
        background-color: #6D8196;
        border: none;
        color: white;
        padding: 10px;
        font-size: 24px;
        cursor: pointer;
        border-radius: 5px;
    }

    /* Adjust the sidebar width for small screens */
    .sidebar {
        width: 200px;
    }
    /* Make sure the sidebar content adjusts when it's collapsed */
    .sidebar.collapsed {
        transform: translateX(-100%);
    }

    .content.sidebar-collapsed {
        margin-left: 0;
    }
        #sidebarToggler {
        display: block;
    }
    .chart-container{
        width:100%
    }
    }
     @media (max-width: 576px) {
      .sidebar{
        position:static;
        width:100%;
      }
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
        <!-- Main Content -->
        <div class="container-fluid">
            <div class="container mt-3">
                <h2 class="text-center">Career Management</h2>
                <form id="careerForm" action="adcareer.php" method="POST" onsubmit="return validateForm();">
                    <input type="hidden" name="id" value="<?= $careers ? $careers['id'] : '' ?>">
                    <div class="form-group">
                        <label class for="work_name">Work Name:</label>
                        <input type="text" class="form-control" id="work_name" name="work_name" value="<?= $careers ? $careers['work_name'] : '' ?>" autofocus>
                        <span class="error" id="workNameError"></span>
                    </div>
                    <div class="form-group">
                        <label for="location">Location:</label>
                        <input type="text" class="form-control" id="location" name="location" value="<?= $careers ? $careers['location'] : '' ?>">
                        <span class="error" id="locationError"></span>
                    </div>
                    <div class="form-group">
                        <label for="responsibilities">Responsibilities:</label>
                        <input type="text" class="form-control" id="responsibilities" name="responsibilities" value="<?= $careers ? $careers['responsibilities'] : '' ?>">
                        <span class="error" id="responsibilitiesError"></span>
                    </div>
                    <div class="form-group">
                        <label for="exp">Experience:</label>
                        <input type="text" class="form-control" id="exp" name="exp" value="<?= $careers ? $careers['exp'] : '' ?>">
                        <span class="error" id="expError"></span>
                    </div>
                    <?php if ($careers): ?>
                        <button type="submit" name="update" class="btn btn-warning">Update Career</button>
                    <?php else: ?>
                        <button type="submit" name="insert" class="btn btn-success">Add Career</button>
                    <?php endif; ?>
                </form>

                <br>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Work Name</th>
                                <th>Location</th>
                                <th>Responsibilities</th>
                                <th>Experience</th>
                                <th>Update</th>
                                <th>Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $qry = "SELECT * FROM careers";
                            $result = mysqli_query($conn, $qry);
                            while ($row = mysqli_fetch_assoc($result)) {
                                echo "<tr>
                                    <td>{$row['id']}</td>
                                    <td>{$row['work_name']}</td>
                                    <td>{$row['location']}</td>
                                    <td>{$row['responsibilities']}</td>
                                    <td>{$row['exp']}</td>
                                    <td><a href='adcareer.php?update_id={$row['id']}' class='btn btn-warning'>Update</a></td>
                                    <td><a href='adcareer.php?delete={$row['id']}' class='btn btn-danger'>Delete</a></td>
                                </tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
<!-- Footer Section -->
<footer class="footer">
        <div class="container">
            <p>© 2023-2024 All Rights Reserved. | <a href="#">Privacy Policy</a> | <a href="#">Terms of Service</a></p>
        </div>
    </footer>
    <script>
        function validateForm() {
            let valid = true;

            // Clear previous error messages
            document.getElementById("workNameError").textContent = "";
            document.getElementById("locationError").textContent = "";
            document.getElementById("responsibilitiesError").textContent = "";
            document.getElementById("expError").textContent = "";

            // Get values
            const workName = document.getElementById("work_name").value.trim();
            const location = document.getElementById("location").value.trim();
            const responsibilities = document.getElementById("responsibilities").value.trim();
            const exp = document.getElementById("exp").value.trim();

            // Validation checks
            if (workName === "") {
                document.getElementById("workNameError").textContent = "*Work Name cannot be empty";
                valid = false;
            }
            if (location === "") {
                document.getElementById("locationError").textContent = "*Location cannot be empty";
                valid = false;
            }
            if (responsibilities === "") {
                document.getElementById("responsibilitiesError").textContent = "*Responsibilities cannot be empty";
                valid = false;
            }
            if (exp === "") {
                document.getElementById("expError").textContent = "*Experience cannot be empty";
                valid = false;
            }

            return valid;
        }
    </script>
</body>
</html>
