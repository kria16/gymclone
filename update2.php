<?php
include("header.php");

$id = $_GET['id'];

$sel = "SELECT * FROM `tbl_gellery` WHERE id='$id'";

$res = mysqli_query($con, $sel);

while ($row = mysqli_fetch_array($res)) {
   
    $name = $row["name"];
    $experiance = $row["experiance"];
    $branche = $row["branche"];
    $specialization = $row["specialization"];
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="bootstrap.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>trainer update</title>
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
    <div class="container">
    <h1 class="text-center">Trainer Update</h1>
        <div class="col-md-11">
            <div class="row justify-content-center">
                <div class="card">
                    <div class="card-body">
                        <form action="#" method="POST" enctype="multipart/form-data">
                           
                                    <label>Photo</label>
                                    <input type="file" name="photo">
                                    <label>Name</label>
                                    <input type="text" name="name" value=<?php echo $name ?>>
                                    <label>branche</label>
                                    <input type="text" name="branche" value=<?php echo $branche ?>>
                                    <label>experiance</label>
                                    <input type="text" name="experiance" value=<?php echo $experiance ?>>
                                    <label>specialization</label>
                                    <input type="text" name="specialization" value=<?php echo $specialization ?>>
                                    <button type="submit" name="submit" class="btn btn-success">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php
    if (isset($_POST["submit"])) {
        $name = $_POST["name"];
        $experiance = $_POST["experiance"];
        $branche = $_POST["branche"];
        $specialization = $_POST["specialization"];

        $photo = $_FILES["photo"]["name"];
        if ($photo == "") {
            $upd = "UPDATE `tbl_gellery` SET `name`='$name',`photo`='$photo',`experiance` ='$experiance',`branche` ='$branche',`specialization` ='$specialization' WHERE id='$id' ";
            mysqli_query($con, $upd);
            header("location:admtrainer.php");


        } else {
            $photo = $_FILES["photo"]["name"];
            $stphoto = "photo/" . $pho;
            move_uploaded_file($_FILES["photo"]["tmp_name"], $stphoto);

            $upd = "UPDATE `tbl_gellery` SET `name`='$name',`photo`='$photo',`experiance` ='$experiance',`branche` ='$branche',`specialization` ='$specialization' WHERE id='$id' ";

            mysqli_query($con, $upd);
            header("location:admtrainer.php");

        }
    }

    ?>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
</body>

</html>