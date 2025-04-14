<?php
include 'conne.php';

if (isset($_POST['insert'])) {
    $name = $_POST['name'];
    $desk = $_POST['desk'];
    $general = $_POST['general'];
    $personal = $_POST['personal'];
    $manager = $_POST['manager'];
    
    $qry = "INSERT INTO branches (name, desk, general, personal, manager) VALUES ('$name', '$desk', '$general', '$personal', '$manager')";
    mysqli_query($conn, $qry);
}

if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $qry = "DELETE FROM branches WHERE id='$id'";
    mysqli_query($conn, $qry);
}

$branch = null;
if (isset($_GET['update_id'])) {
    $id = $_GET['update_id'];
    $qry = "SELECT * FROM branches WHERE id='$id'";
    $result = mysqli_query($conn, $qry);
    $branch = mysqli_fetch_assoc($result);
}

if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $desk = $_POST['desk'];
    $general = $_POST['general'];
    $personal = $_POST['personal'];
    $manager = $_POST['manager'];

    $qry = "UPDATE branches SET name='$name', desk='$desk', general='$general', personal='$personal', manager='$manager' WHERE id='$id'";
    mysqli_query($conn, $qry);
    
    // Redirect to avoid resubmission
    header("Location: adbranch.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="bootstrap.min.css">
    <title>Branch Management</title>
    <style>
        /* Include the updated CSS provided below */
        /* General Styles */
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
    }
span{
    padding-left:6px;
}
    #logo{
        padding-left:3px;
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

/* Button Styles */
.btn {
    margin: 5px 0;
    padding: 10px 15px;
    border: none;
    color: white;
    cursor: pointer;
    border-radius: 4px;
}

.btn-success {
    background-color:  #6D8196;
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
#branchForm{
    text-align:center;   
}
.footer {
    background-color: #6D8196;
    color: white;
    padding: 2px 0;
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
                <h2 class="text-center">Branch Management</h2>
                <form id="branchForm" action="" method="POST" onsubmit="return validateForm();">
                    <input type="hidden" name="id" value="<?= $branch ? $branch['id'] : '' ?>">
                    <div class="form-group">
                        <label>Work Name:</label>
                        <input type="text" name="name" class="form-control" value="<?= $branch ? $branch['name'] : '' ?>" autofocus>
                        <span class="error" id="nameError"></span>
                    </div>
                    <div class="form-group">
                        <label>Front Desk:</label>
                        <input type="text" name="desk" class="form-control" value="<?= $branch ? $branch['desk'] : '' ?>">
                        <span class="error" id="deskError"></span>
                    </div>
                    <div class="form-group">
                        <label>General Trainer:</label>
                        <input type="text" name="general" class="form-control" value="<?= $branch ? $branch['general'] : '' ?>">
                        <span class="error" id="generalError"></span>
                    </div>
                    <div class="form-group">
                        <label>Personal Trainer:</label>
                        <input type="text" name="personal" class="form-control" value="<?= $branch ? $branch['personal'] : '' ?>">
                        <span class="error" id="personalError"></span>
                    </div>
                    <div class="form-group">
                        <label>Manager:</label>
                        <input type="text" name="manager" class="form-control" value="<?= $branch ? $branch['manager'] : '' ?>">
                        <span class="error" id="managerError"></span>
                    </div>
                    <?php if ($branch): ?>
                        <button type="submit" name="update" class="btn btn-warning">Update Branch</button>
                    <?php else: ?>
                        <button type="submit" name="insert" class="btn btn-success">Submit Branch</button>
                    <?php endif; ?>
                </form>

                <br>
                <div class="responsive-table">
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Desk</th>
                                <th>General Trainer</th>
                                <th>Personal Trainer</th>
                                <th>Manager</th>
                                <th>Update</th>
                                <th>Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $qry = "SELECT * FROM branches";
                            $result = mysqli_query($conn, $qry);
                            while ($row = mysqli_fetch_assoc($result)) {
                                echo "<tr>
                                    <td>{$row['id']}</td>
                                    <td>{$row['name']}</td>
                                    <td>{$row['desk']}</td>
                                    <td>{$row['general']}</td>
                                    <td>{$row['personal']}</td>
                                    <td>{$row['manager']}</td>
                                    <td>
                                        <a href='adbranch.php?update_id={$row['id']}' class='btn btn-warning'>Update</a>
                                    </td>
                                    <td>
                                        <a href='adbranch.php?delete={$row['id']}' class='btn btn-danger'>Delete</a>
                                    </td>
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
            document.getElementById("nameError").textContent = "";
            document.getElementById("deskError").textContent = "";
            document.getElementById("generalError").textContent = "";
            document.getElementById("personalError").textContent = "";
            document.getElementById("managerError").textContent = "";

            // Get values
            const name = document.querySelector('input[name="name"]').value.trim();
            const desk = document.querySelector('input[name="desk"]').value.trim();
            const general = document.querySelector('input[name="general"]').value.trim();
            const personal = document.querySelector('input[name="personal"]').value.trim();
            const manager = document.querySelector('input[name="manager"]').value.trim();

            // Validation checks
            if (name === "") {
                document.getElementById("nameError").textContent = "*Work Name cannot be empty";
                valid = false;
            }
            if (desk === "") {
                document.getElementById("deskError").textContent = "*Front Desk cannot be empty";
                valid = false;
            }
            if (general === "") {
                document.getElementById("generalError").textContent = "*General Trainer cannot be empty";
                valid = false;
            }
            if (personal === "") {
                document.getElementById("personalError").textContent = "*Personal Trainer cannot be empty";
                valid = false;
            }
            if (manager === "") {
                document.getElementById("managerError").textContent = "*Manager cannot be empty";
                valid = false;
            }

            return valid;
        }
    </script>
</body>
</html>
