<?php
include("header.php");

    if(isset($_POST["submit"]))
    {
        
        $name = $_POST["name"];
        $experiance = $_POST["experiance"];
        $branche = $_POST["branche"];
        $specialization = $_POST["specialization"];

        $img = $_FILES["image"]["name"];

        $stimg = "images/".$img;

        move_uploaded_file($_FILES["image"]["tmp_name"],$stimg);

        $qry = "INSERT INTO `tbl_gellery`( `name`, `branche`, `photo`, `experiance`, `specialization`) VALUES ('$name','$branche','$stimg','$experiance','$specialization')";
        if(mysqli_query($con,$qry))
        {
            echo "your record is inserted..";
            header("location:adtrainer.php");
        }
        else
        {
            echo "Your Record Is Not Inserted.";
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="bootstrap.css">
    <title>Trainer Management</title>
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
        width: 70%;
        border-collapse: collapse;
        margin-left: 260px;
    }
    span{
    padding-left:6px;
}
    #logo{
        padding-left:3px;
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
    .btn {
        margin: 5px 0;
        padding: 10px 15px;
        border: none;
        color: white;
        cursor: pointer;
        border-radius: 4px;
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
    .form-group input {
        width:75%;
        border: 1px solid #ccc;
        border-radius: 2px solid;
        display: inline;
    }
    #trainerForm {
        text-align: center;
        align-items:center;   
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
    
    <div class="container mt-5">
    <h1 class="text-center">Trainer Management</h1>
    <div class="row justify-content-center">
        <div class="col-md-8">
            
                <div class="card-body">
                    <form id="trainerForm" action="#" method="POST" enctype="multipart/form-data" onsubmit="return validateForm();">
                        <div class="form-group">
                            <label class="form-label">Photo:</label>
                            <input type="file" class="form-control" style="margin: -5px;" name="image"  id="image" accept="image/*" autofocus>
                            <span class="text-danger" id="imageError"></span>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Name:</label>
                            <input type="text" class="form-control" style="margin: -1px;"name="name" id="name">
                            <span class="text-danger" id="nameError"></span>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Branch:</label>
                            <input type="text" class="form-control"style="margin: -1px;" name="branch" id="branch">
                            <span class="text-danger" id="branchError"></span>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Experience:</label>
                            <input type="text" class="form-control" style="margin: -1px;"name="experience" id="experience">
                            <span class="text-danger" id="experienceError"></span>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Specialization:</label>
                            <input type="text" class="form-control" style="margin: -1px;"name="specialization" id="specialization">
                            <span class="text-danger" id="specializationError"></span>
                        </div>
                        <button type="submit" class="btn btn-success">Add Trainer</button>
                    </form>
                </div>
          
        </div>
    
</div>
   

<script>
function validateForm() {
    let valid = true;

    // Clear previous error messages
    document.getElementById("imageError").textContent = "";
    document.getElementById("nameError").textContent = "";
    document.getElementById("branchError").textContent = "";
    document.getElementById("experienceError").textContent = "";
    document.getElementById("specializationError").textContent = "";

    // Get values
    const image = document.getElementById("image").value;
    const name = document.getElementById("name").value.trim();
    const branch = document.getElementById("branche").value.trim();
    const experience = document.getElementById("experiance").value.trim();
    const specialization = document.getElementById("specialization").value.trim();

    // Validation checks
    if (image === "") {
        document.getElementById("imageError").textContent = "*Photo is required";
        valid = false;
    }
    if (name === "") {
        document.getElementById("nameError").textContent = "*Name cannot be empty";
        valid = false;
    }
    if (branch === "") {
        document.getElementById("branchError").textContent = "*Branch cannot be empty";
        valid = false;
    }
    if (experience === "" || isNaN(experience)) {
        document.getElementById("experienceError").textContent = "*Experience must be a valid number";
        valid = false;
    }
    if (specialization === "") {
        document.getElementById("specializationError").textContent = "*Specialization cannot be empty";
        valid = false;
    }

    return valid;
}
</script>

                </div>
        </div>
    </div>
    </div> 
</div>

</div>
    </form>
  
    <div class="responsive-table">
                        <table class="table table-bordered table-hover">
                        <?php
                            $res=mysqli_query($con,"select * from tbl_gellery");
                        
                            echo "<thead>";
                            echo "<tr>";
                            echo "<th>"; echo "Id"; "</th>";
                            echo "<th>"; echo "Name"; "</th>";
                            echo "<th>"; echo "experiance"; "</th>";
                            echo "<th>"; echo "specialization"; "</th>";
                            echo "<th>"; echo "branche"; "</th>";
                            echo "<th>"; echo "Images"; "</th>";
                            echo "<th>"; echo "Update"; "</th>";
                            echo "<th>"; echo "Delete"; "</th>";
                            echo "</tr>";
                            echo "</thead>";                        
                            while($row=mysqli_fetch_array($res))
                            {
                                echo "<tr>";
                                echo "<td>"; echo $row['id']; "</td>";
                                echo "<td>"; echo $row['name']; "</td>";
                                echo "<td>"; echo $row['experiance']; "</td>";
                                echo "<td>"; echo $row['specialization']; "</td>";
                                echo "<td>"; echo $row['branche']; "</td>";
                                echo "<td>"; ?><img src="<?php echo $row['photo'];?>" height="100" width="100"> <?php "</td>";
                                echo "<td>"; ?><a class="btn btn-warning"  href="uptrainer.php?id=<?php echo $row['id']; ?>"> UPDATE </a><?php echo "</td>";
                                echo "<td>"; ?> <a class="btn btn-danger"  href="remove2.php?id=<?php echo $row['id']; ?>">DELETE</a> <?php echo "</td>";
                            }
    
                        ?>
                        </table>

            </div>
             <!-- Footer Section -->
    <footer class="footer">
        <div class="container">
            <p>© 2023-2024 All Rights Reserved. | <a href="#">Privacy Policy</a> | <a href="#">Terms of Service</a></p>
        </div>
    </footer>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
</body>
</html>
