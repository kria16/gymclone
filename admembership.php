<?php
include 'conne.php';

if (isset($_POST['insert'])) {
    $month = $_POST['month'];
    $price = $_POST['price'];
    $datamonth = $_POST['datamonth'];
    $equipment = $_POST['equipment'];
    $trainer = $_POST['trainer'];
    $restriction = $_POST['restriction'];
    $yaz = $_POST['yaz'];
    $qry = "INSERT INTO membership (month, price, datamonth, equipment, trainer, restriction, yaz) VALUES ('$month', '$price', '$datamonth', '$equipment', '$trainer', '$restriction', '$yaz')";
    $result = mysqli_query($conn, $qry);
    if ($result) {
        echo "Membership inserted successfully!";
    } else {
        echo "Error inserting membership!";
    }
}

if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $qry = "DELETE FROM membership WHERE id='$id'";
    mysqli_query($conn, $qry);
}

// Fetch membership data for updating
$membership = null;
if (isset($_GET['update_id'])) {
    $id = $_GET['update_id'];
    $qry = "SELECT * FROM membership WHERE id='$id'";
    $result = mysqli_query($conn, $qry);
    $membership = mysqli_fetch_assoc($result);
}

// Update query
if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $month = $_POST['month'];
    $price = $_POST['price'];
    $datamonth = $_POST['datamonth'];
    $equipment = $_POST['equipment'];
    $trainer = $_POST['trainer'];
    $restriction = $_POST['restriction'];
    $yaz = $_POST['yaz'];

    $qry = "UPDATE membership SET month='$month', price='$price', datamonth='$datamonth', equipment='$equipment', trainer='$trainer', restriction='$restriction', yaz='$yaz' WHERE id='$id'";
    $result = mysqli_query($conn, $qry);
    if ($result) {
        echo "Membership updated successfully!";
        header("Location: admembership.php"); 
        exit;
    } else {
        echo "Error updating membership!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title>Membership Management</title>
    <style>
        * {
        margin: 0;
        padding: 0;
    }
    body {
        font-family: Arial, sans-serif;
        background-color: white;
        color: black;
    }
    .container {
        max-width: 1200px;
        margin: auto;
        padding: 20px;
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
        margin-left: 250px;
        padding: 20px;
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
        

    }

    th, td {
        padding: 10px;
        text-align: left;
       
        color: black;
    } 
    .main {
            margin-left: 270px;
            padding: 20px;
        }
    th {
        background-color: #6D8196;
        color: white;
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
.footer {
        background-color: #6D8196;
        color: white;
        padding: 2px 0;
        text-align: center;
        margin-top: 50px;
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
#membershipForm{
    text-align:center;   
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

    <div class="main">
        <h2 class="text-center">Membership Management</h2>
        <form id="membershipForm" action="admembership.php" method="POST" onsubmit="return validateForm();">
            <input type="hidden" name="id" value="<?= $membership ? $membership['id'] : '' ?>">
            <div class="form-group">
                <label>Month:</label>
                <input type="text" class="form-control" name="month" id="month" value="<?= $membership ? $membership['month'] : '' ?>" autofocus>
                <span class="error" id="monthError" style="color: red;"></span>
            </div>
            <div class="form-group">
                <label>Price:</label>
                <input type="text" class="form-control" name="price" id="price" value="<?= $membership ? $membership['price'] : '' ?>">
                <span class="error" id="priceError" style="color: red;"></span>
            </div>
            <div class="form-group">
                <label>Data Month:</label>
                <input type="text" class="form-control" name="datamonth" id="datamonth" value="<?= $membership ? $membership['datamonth'] : '' ?>">
                <span class="error" id="datamonthError" style="color: red;"></span>
            </div>
            <div class="form-group">
                <label>Equipment:</label>
                <input type="text" class="form-control" name="equipment" id="equipment" value="<?= $membership ? $membership['equipment'] : '' ?>">
                <span class="error" id="equipmentError" style="color: red;"></span>
            </div>
            <div class="form-group">
                <label>Trainer:</label>
                <input type="text" class="form-control" name="trainer" id="trainer" value="<?= $membership ? $membership['trainer'] : '' ?>">
                <span class="error" id="trainerError" style="color: red;"></span>
            </div>
            <div class="form-group">
                <label>Restriction:</label>
                <input type="text" class="form-control" name="restriction" id="restriction" value="<?= $membership ? $membership['restriction'] : '' ?>">
                <span class="error" id="restrictionError" style="color: red;"></span>
            </div>
            <div class="form-group">
                <label>Yoga & Zumba:</label>
                <input type="text" class="form-control" name="yaz" id="yaz" value="<?= $membership ? $membership['yaz'] : '' ?>">
                <span class="error" id="yazError" style="color: red;"></span>
            </div>

            <?php if ($membership): ?>
                <button type="submit" name="update" class="btn btn-warning">Update Membership</button>
            <?php else: ?>
                <button type="submit" name="insert" class="btn btn-success">Add Membership</button>
            <?php endif; ?>
        </form>

        <script>
        function validateForm() {
            let valid = true;

            // Clear previous error messages
            document.getElementById("monthError").textContent = "";
            document.getElementById("priceError").textContent = "";
            document.getElementById("datamonthError").textContent = "";
            document.getElementById("equipmentError").textContent = "";
            document.getElementById("trainerError").textContent = "";
            document.getElementById("restrictionError").textContent = "";
            document.getElementById("yazError").textContent = "";

            // Get values
            const month = document.getElementById("month").value.trim();
            const price = document.getElementById("price").value.trim();
            const datamonth = document.getElementById("datamonth").value.trim();
            const equipment = document.getElementById("equipment").value.trim();
            const trainer = document.getElementById("trainer").value.trim();
            const restriction = document.getElementById("restriction").value.trim();
            const yaz = document.getElementById("yaz").value.trim();

            // Validation checks
            if (month === "") {
                document.getElementById("monthError").textContent = "*Month cannot be empty";
                valid = false;
            }
            if (price === "" || isNaN(price)) {
                document.getElementById("priceError").textContent = "*Price must be a valid number";
                valid = false;
            }
            if (datamonth === "") {
                document.getElementById("datamonthError").textContent = "*Data Month cannot be empty";
                valid = false;
            }
            if (equipment === "") {
                document.getElementById("equipmentError").textContent = "*Equipment cannot be empty";
                valid = false;
            }
            if (trainer === "") {
                document.getElementById("trainerError").textContent = "*Trainer cannot be empty";
                valid = false;
            }
            if (restriction === "") {
                document.getElementById("restrictionError").textContent = "*Restriction cannot be empty";
                valid = false;
            }
            if (yaz === "") {
                document.getElementById("yazError").textContent = "*Yoga & Zumba cannot be empty";
                valid = false;
            }

            return valid;
        }
        </script>

        <br>
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Month</th>
                        <th>Price</th>
                        <th>Data Month</th>
                        <th>Equipment</th>
                        <th>Trainer</th>
                        <th>Restriction</th>
                        <th>Yoga & Zumba</th>
                        <th>Update</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $qry = "SELECT * FROM membership";
                    $result = mysqli_query($conn, $qry);
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>
                            <td>{$row['id']}</td>
                            <td>{$row['month']}</td>
                            <td>{$row['price']}</td>
                            <td>{$row['datamonth']}</td>
                            <td>{$row['equipment']}</td>
                        <td>{$row['trainer']}</td>
                        <td>{$row['restriction']}</td>
                        <td>{$row['yaz']}</td>
                        <td>
                            <a href='admembership.php?update_id={$row['id']}' class='btn btn-warning'>Update</a>
                        </td>
                        <td>
                            <a href='admembership.php?delete={$row['id']}' class='btn btn-danger'>Delete</a>
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

    <!-- Footer Section -->
    <footer class="footer">
        <div class="containerr">
            <p>© 2023-2024 All Rights Reserved. | <a href="#">Privacy Policy</a> | <a href="#">Terms of Service</a></p>
        </div>
    </footer>
</body>
</html>
 