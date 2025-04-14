<?php
    include("connection.php");
    $user=$_GET['user'];
    $quary="DELETE FROM `customer` WHERE `user`='$user'";
    $result=mysqli_query($con,$quary);
    
    if($result){
        header("location:view.php");
    }
    else{
        echo "Error to Delete Data";
    }
?> 