<?php
    include("header.php");

    if(isset($_POST["submit"]))
    {
        
        $name = $_POST["name"];
        $Description = $_POST["Description"];

        $img = $_FILES["image"]["name"];

        $stimg = "images/".$img;

        move_uploaded_file($_FILES["image"]["tmp_name"],$stimg);

        $qur = "INSERT INTO `tbl_gellery`( `name`,`Description`,`photo`) VALUES ('$name','$Description','$stimg')";
        if(mysqli_query($con,$qur))
        {
            echo "your record is inserted..";
            header("location:g_index.php");
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
    <title>Crud Opration in Jounral</title>
</head>
<body>
    <br><br><br>
   <div class="container">
    <div class="col-md-11">
        <div class="row justify-content-center">
        <div class="card">
            <div class="card-header" style="background-color :rgb(143, 10, 10) ; color : #B5BBC9;">Registration Form </div>
                <div class="card-body">
                    <form action="#" method="POST" enctype="multipart/form-data">
                        <table class="table">
                            <tr>
                                <td>Photo</td>
                                <td><input type="file" name="image"></td>
                            </tr>
                            
                            <tr>
                                <td>Name</td>
                                <td><input type="text" name="name" required ></td>
                            </tr>

                            <tr>
                                <td>Description</td>
                                <td><input type="text" name="Description" required ></td>
                            </tr>
                            
                            <tr>
                                <td><button type="submit" name="submit" class="btn btn-info">Submit</button></td>
                            </tr>
                         
                        </table>
    
                    </form>
                </div>
        </div>
</div>
    </div> 
</div>

<br>
 
   
</div>
    </form>
       
    
       
    
        
    <br>
    <div class="container-fluid">
                        <table class="table table-hover">
                        <?php
                            $res=mysqli_query($con,"select * from tbl_gellery");
                        
                            
                            echo "<thead class='thead-dark'>";
                            echo "<tr>";
                            echo "<th>"; echo "Id"; "</th>";
                            
                            echo "<th>"; echo "Name"; "</th>";
                            echo "<th>"; echo "Description"; "</th>";
                           
                            echo "<th>"; echo "Images"; "</th>";
                            echo "<th>"; echo "Edit"; "</th>";
                            echo "<th>"; echo "Remove"; "</th>";

                            echo "</tr>";
                            echo "</thead>";
                                                       

                            while($row=mysqli_fetch_array($res))
                            {
                                echo "<tr>";
                                echo "<td>"; echo $row['id']; "</td>";
                                
                                echo "<td>"; echo $row['name']; "</td>";
                                echo "<td>"; echo $row['Description']; "</td>";
                               
                                echo "<td>"; ?><img src="<?php echo $row['photo'];?>" height="100" width="100"> <?php "</td>";
                                echo "<td>"; ?><a class="btn btn-outline-danger"  onclick= "return confirm('Are you sure? Record Updated ..');" href="update.php?id=<?php echo $row['id']; ?>"> Edit </a><?php echo "</td>";
                                echo "<td>"; ?> <a class="btn btn-outline-info"  onclick="return confirm('Are you sure? Record Delted..');"  href="remove.php?id=<?php echo $row['id']; ?>">Remove</a> <?php echo "</td>";
                            }
    
                        ?>
                        </table>

             
            </div>
     
</body>
</html>