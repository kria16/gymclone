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
            header("location:admtrainer.php");
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
            background-color: black;
            color: white;
        }
        .container {
            max-width: 1200px;
            margin: auto;
            padding: 20px;
        }
        table, th, td {
            border: 2px solid white;
            text-align: left;
            color: white;
        }
        th {
            background-color: #4caf50;
            color:white;
        }
        .responsive-table {
            overflow-x: auto;
        }
        form {
            margin: 20px 0;
        }
        input, button {
            margin: 5px 0;
        }
        input{
            width: 100%;
        }
        .btn {
            margin-right: 5px;
        }
        .card{
            background-color: black;
        }
        h1{
            color: orangered;
        }
    </style>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand">
            <img src="LOGO.jpg" alt="logo" height="70" width="70" class="rounded-circle">
            <h5 class="d-inline-block"><span style="color: black;">GYM</span><span style="color: orangered;">SHINE ADMIN</span></h5>
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
   <h1 class="text-center">Trainer Management</h1>
    <div class="col-md-11">
        <div class="row justify-content-center">
        <div class="card">
                <div class="card-body">
                <form id="trainerForm" action="#" method="POST" enctype="multipart/form-data" onsubmit="return validateForm();">
    <div class="form-group">
        <label>Photo:</label>
        <input type="file" name="image" id="image" accept="image/*">
        <span class="error" id="imageError" style="color: red;"></span>
    </div>
    <div class="form-group">
        <label>Name:</label>
        <input type="text" name="name" id="name">
        <span class="error" id="nameError" style="color: red;"></span>
    </div>
    <div class="form-group">
        <label>Branch:</label>
        <input type="text" name="branche" id="branche">
        <span class="error" id="branchError" style="color: red;"></span>
    </div>
    <div class="form-group">
        <label>Experience:</label>
        <input type="text" name="experiance" id="experiance">
        <span class="error" id="experienceError" style="color: red;"></span>
    </div>
    <div class="form-group">
        <label>Specialization:</label>
        <input type="text" name="specialization" id="specialization">
        <span class="error" id="specializationError" style="color: red;"></span>
    </div>
    <button type="submit" name="submit" class="btn btn-success">Add Trainer</button>
</form>

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
                                echo "<td>"; ?><a class="btn btn-warning"  onclick= "return confirm('Are you sure? Record Updated ..');" href="update2.php?id=<?php echo $row['id']; ?>"> UPDATE </a><?php echo "</td>";
                                echo "<td>"; ?> <a class="btn btn-danger"  onclick="return confirm('Are you sure? Record Delted..');"  href="remove2.php?id=<?php echo $row['id']; ?>">DELETE</a> <?php echo "</td>";
                            }
    
                        ?>
                        </table>

            </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
</body>
</html>
