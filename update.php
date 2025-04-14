<?php
// Ensure no HTML output or any spaces before this
include("header.php");

$id = $_GET['id'];

$sel = "SELECT * FROM `tbl_gellery` WHERE id='$id'";

$res = mysqli_query($con, $sel);

// Check for database query error
if (!$res) {
    die("Error fetching data: " . mysqli_error($con));
}

while ($row = mysqli_fetch_array($res)) {
    $name = $row["name"];
    $experiance = $row["experiance"];
    $branche = $row["branche"];
    $specialization = $row["specialization"];
}

if (isset($_POST["submit"])) {
    $name = $_POST["name"];
    $experiance = $_POST["experiance"];
    $branche = $_POST["branche"];
    $specialization = $_POST["specialization"];

    // Check if a new photo is uploaded
    if ($_FILES["photo"]["name"] != "") {
        // New photo uploaded
        $photo = $_FILES["photo"]["name"];
        $stphoto = "photo/" . $photo;
        // Uncomment the following line to save the uploaded photo
        // move_uploaded_file($_FILES["photo"]["tmp_name"], $stphoto);

        // Update with new photo
        $upd = "UPDATE `tbl_gellery` SET `name`='$name', `photo`='$photo', `experiance` ='$experiance', `branche` ='$branche', `specialization` ='$specialization' WHERE id='$id'";
    } else {
        // No new photo, retain the old one
        // Fetch the current photo from the database
        $sel = "SELECT * FROM `tbl_gellery` WHERE id='$id'";
        $res = mysqli_query($con, $sel);

        if (!$res) {
            die("Error fetching photo data: " . mysqli_error($con)); // Error fetching the photo
        }

        $row = mysqli_fetch_array($res);
        $photo = $row['photo'];  // Use the existing photo

        // Update without changing the photo
        $upd = "UPDATE `tbl_gellery` SET `name`='$name', `photo`='$photo', `experiance` ='$experiance', `branche` ='$branche', `specialization` ='$specialization' WHERE id='$id'";
    }

    // Execute the update query
    if (mysqli_query($con, $upd)) {
        // Redirect after the update
        header("Location: trainer.php");
        exit(); // Always call exit() after header to stop further script execution
    } else {
        // Error handling
        die("Error updating record: " . mysqli_error($con)); // Error updating the record
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="bootstrap.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trainer Update</title>
    <style>
         /* Reset styles */
         * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background-color: #f7f7f7; /* Light grey background */
            color: #6d8196; /* Soft grey text color */
        }

        h1 {
            text-align: center;
            color: #6d8196; /* Soft grey color for heading */
            margin-bottom: 30px;
            font-size: 30px;
            font-weight: 700;
        }

        .container {
            max-width: 100%;
            margin: auto;
            padding: 20px;
        }

        .card {
            background-color: #ffffff; /* White background for the card */
            border: 1px solid #6d8196; /* Light grey border for the card */
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .card-body {
            padding: 20px;
        }

        form {
            display: flex;
            flex-direction: column;
            gap: 3px;
        }

        label {
            font-weight: bold;
            color: #6d8196; /* Soft grey color for labels */
            font-size: 16px;
        }

        input[type="text"],
        input[type="file"],
        button {
            padding: 12px;
            border: 1px solid #ddd;
            border-radius: 8px;
            font-size: 16px;
        }

        input[type="text"] {
            width: 100%;
            background-color: #f7f7f7;
        }

        /* Submit Button Styling */
        button {
            background-color: #6d8196; /* Soft grey background */
            color: white;
            cursor: pointer;
            border: none;
            transition: background-color 0.3s ease, transform 0.2s ease;
            font-size: 18px;
            font-weight: 600;
        }

        button:hover {
            background-color: #a1a3a7; /* Lighter grey on hover */
            transform: translateY(-3px);
        }

        button:active {
            transform: translateY(1px); /* Click effect */
        }

        /* Table Styles (for later use, if needed) */
        table,
        th,
        td {
            border: 2px solid #a1a3a7; /* Light grey border for tables */
            text-align: left;
            color: #6d8196; /* Soft grey text */
        }

        th {
            background-color: #6d8196; /* Grey header */
            color: white;
        }

        /* Responsive Styles */
        @media (max-width: 767px) {
            body {
                padding: 10px;
            }

            .container {
                padding: 15px;
            }

            .card {
                width: 100%;
            }

            h1 {
                font-size: 24px;
            }

            label,
            input[type="text"],
            input[type="file"],
            button {
                font-size: 16px;
            }
        }

        .btn-upload {
            background-color: white; /* Grey button */
            color: white;
            border: 1px solid white;
            cursor: pointer;
            padding: 10px;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        .btn-upload:hover {
            background-color: #a1a3a7;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Trainer Update</h1>
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <form action="#" method="POST" enctype="multipart/form-data">
                            <label>Photo (Optional)</label>
                            <input type="file" name="photo" class="btn-upload">
                            <label>Name</label>
                            <input type="text" name="name" value="<?php echo $name; ?>" required>
                            <label>Branch</label>
                            <input type="text" name="branche" value="<?php echo $branche; ?>" required>
                            <label>Experience</label>
                            <input type="text" name="experiance" value="<?php echo $experiance; ?>" required>
                            <label>Specialization</label>
                            <input type="text" name="specialization" value="<?php echo $specialization; ?>" required>
                            <div class="form-group">
                                <button type="submit" name="submit">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
</body>

</html>
