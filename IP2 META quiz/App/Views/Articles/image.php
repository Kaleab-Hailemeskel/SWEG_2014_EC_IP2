<html>

<form method="POST" action="image.php" enctype="multipart/form-data">
<input type="file" id="quiz_image" name="quiz_image">
<input type="submit">
</form>

<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

 $con = mysqli_connect("localhost", "root", "", "test");
 if (!$con) {
    echo "connection problem";
    die("Connection failed: " . mysqli_connect_error());
    }
    
if(!empty($_FILES['quiz_image']['name'])){
    echo $_FILES['quiz_image']['error'];
    echo"<h2>Phase 1 </h2>";
    $file=$_FILES['quiz_image']['name'];
    $fileT=$_FILES['quiz_image']['tmp_name'];
    $folder="Images/".$file;
     
    $sqlInsertQuiz = "INSERT INTO image (id, images) VALUES (1,'$file')";
    if(mysqli_query($con,$sqlInsertQuiz)){
        echo"Uploaded successfully";
    }
    else echo"Query not executed: " . mysqli_error($con);
    

    echo "<img src=\"Images/{$file}\"/>";
    
   if(move_uploaded_file($fileT,$folder)){
        echo "file uploaded";
    }
   else{
echo"file failed to upload";}
}


?>

</html>
