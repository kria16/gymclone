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
    header("Location: admin_branch.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title>Branch Management</title>
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
            background-color: #4caf50;
            color: white;
        }
        .btn {
            margin: 5px 0;
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
    
    <div class="container">
    <h2 class="text-center">Branch Management</h2>
    <form id="branchForm" action="" method="POST" onsubmit="return validateForm();">
        <input type="hidden" name="id" value="<?= $branch ? $branch['id'] : '' ?>">        
        <div class="form-group">
            <label>Work Name:</label>
            <input type="text" name="name" class="form-control" value="<?= $branch ? $branch['name'] : '' ?>" autofocus>
            <span class="error" id="nameError" style="color: red;"></span>
        </div>
        <div class="form-group">
            <label>Front Desk:</label>
            <input type="text" name="desk" class="form-control" value="<?= $branch ? $branch['desk'] : '' ?>">
            <span class="error" id="deskError" style="color: red;"></span>
        </div>
        <div class="form-group">
            <label>General Trainer:</label>
            <input type="text" name="general" class="form-control" value="<?= $branch ? $branch['general'] : '' ?>">
            <span class="error" id="generalError" style="color: red;"></span>
        </div>
        <div class="form-group">
            <label>Personal Trainer:</label>
            <input type="text" name="personal" class="form-control" value="<?= $branch ? $branch['personal'] : '' ?>">
            <span class="error" id="personalError" style="color: red;"></span>
        </div>
        <div class="form-group">
            <label>Manager:</label>
            <input type="text" name="manager" class="form-control" value="<?= $branch ? $branch['manager'] : '' ?>">
            <span class="error" id="managerError" style="color: red;"></span>
        </div>
        <?php if ($branch): ?>
            <button type="submit" name="update" class="btn btn-warning">Update Branch</button>
        <?php else: ?>
            <button type="submit" name="insert" class="btn btn-success">Submit Branch</button>
        <?php endif; ?>
    </form>
</div>

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
                                <a href='admin_branch.php?update_id={$row['id']}' class='btn btn-warning'>Update</a>
                            </td>
                            <td>
                                <a href='admin_branch.php?delete={$row['id']}' class='btn btn-danger'>Delete</a>
                            </td>
                        </tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
</body>
</html>
