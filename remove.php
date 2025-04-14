<?php

    $conn = mysqli_connect("localhost","root","","gymdb");

    $id = $_GET['id'];

    $del = "DELETE FROM `tbl_gellery` WHERE id = '$id'";

    $sel = "SELECT * FROM `tbl_gellery` WHERE id = '$id' ";


    $res = mysqli_query($conn,$sel);
   

    mysqli_query($conn,$del);

    header("location:trainer.php");
?>