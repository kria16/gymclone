<?php
session_start();
require_once('conne.php');

if (!isset($_SESSION['email'])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_SESSION['email'];

    $name = $conn->real_escape_string($_POST['name']);
    $contact = $conn->real_escape_string($_POST['contact']);
    $age = $conn->real_escape_string($_POST['age']);
    $birthday = $conn->real_escape_string($_POST['birthday']);
    $gender = $conn->real_escape_string($_POST['gender']);
    $address = $conn->real_escape_string($_POST['address']);
    $city = $conn->real_escape_string($_POST['city']);
    $zip = $conn->real_escape_string($_POST['zip']);

    $sql = "UPDATE register SET 
            name='$name', 
            contact='$contact', 
            age='$age', 
            birthday='$birthday', 
            gender='$gender', 
            address='$address', 
            city='$city', 
            zip='$zip' 
            WHERE email='$email'";

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Profile updated successfully!');</script>";   
        echo "<script>window.location.href='userprofile.php';</script>";        
        exit();
    } else {
        echo "Error updating record: " . $conn->error;
    }        
}

$conn->close();
?>
