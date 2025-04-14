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
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title>Career Management</title>
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
            padding: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 2px solid #fff; 
            padding: 10px;
            text-align: left;
            color: white; 
        }
        th {
            background-color: #4caf50; 
            color: white; 
        }
        .btn {
            padding: 10px 15px;
            border: none;
            color: white;
            cursor: pointer;
        }
        .btn-success {
            background-color: #4caf50;
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
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand">
            <img class="media-imlocation rounded-circle" src="LOGO.jpg" alt="logo" height="70" width="70">
            GYM<span style="color: orangered;">SHINE ADMIN</span>
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav">
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

    <div class="container">
    <h2 class="text-center">Career Management</h2>
    <form id="careerForm" action="" method="POST" onsubmit="return validateForm();">
        <input type="hidden" name="id" value="<?= $careers ? $careers['id'] : '' ?>">
        <div class="form-group">
            <label for="work_name">Work Name:</label>
            <input type="text" class="form-control" id="work_name" name="work_name" value="<?= $careers ? $careers['work_name'] : '' ?>" autofocus>
            <span class="error" id="workNameError" style="color: red;"></span>
        </div>
        <div class="form-group">
            <label for="location">Location:</label>
            <input type="text" class="form-control" id="location" name="location" value="<?= $careers ? $careers['location'] : '' ?>">
            <span class="error" id="locationError" style="color: red;"></span>
        </div>
        <div class="form-group">
            <label for="responsibilities">Responsibilities:</label>
            <input type="text" class="form-control" id="responsibilities" name="responsibilities" value="<?= $careers ? $careers['responsibilities'] : '' ?>">
            <span class="error" id="responsibilitiesError" style="color: red;"></span>
        </div>
        <div class="form-group">
            <label for="exp">Experience:</label>
            <input type="text" class="form-control" id="exp" name="exp" value="<?= $careers ? $careers['exp'] : '' ?>">
            <span class="error" id="expError" style="color: red;"></span>
        </div>
        <?php if ($careers): ?>
            <button type="submit" name="update" class="btn btn-warning">Update Career</button>
        <?php else: ?>
            <button type="submit" name="insert" class="btn btn-success">Add Career</button>
        <?php endif; ?>
    </form>
</div>

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
                            <td><a href='admincareer.php?update_id={$row['id']}' class='btn btn-warning'>Update</a></td>
                            <td><a href='admincareer.php?delete={$row['id']}' class='btn btn-danger'>Delete</a></td>
                        </tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
