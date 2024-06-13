<?php
session_start();

if(isset($_POST['export'])) {
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "quiz_db";
    $connection = mysqli_connect($servername, $username, $password, $dbname);
    $user_id = $_SESSION['user_id'];
    $quiz_id = $_GET['quiz_id'];
    $query = "SELECT * from stat where user_id='$user_id' and quiz_id='$quiz_id'";

    $result = mysqli_query($connection, $query);

    header('Content-Type: application/vnd.ms-excel');
    header('Content-Disposition: attachment; filename=quiz_data.xls');

    $delimiter = "\t";
    $newline = "\r\n";

    
    $f = fopen('php://output', 'w');

    
    $fields = array('Attempt Number', 'Score', 'Percentage Correct', 'Attempt DateTime');
    fputcsv($f, $fields, $delimiter);

    
    while($row = mysqli_fetch_assoc($result)) {
        $lineData = array($row['attempt_number'], $row['score'], $row['percentage_solved'], $row['end_timestamp']);
        fputcsv($f, $lineData, $delimiter);
    }

    


    fflush($f);

 
    fclose($f);

    exit();
}
?>

<!DOCTYPE html>
<html>
 <head> <link href="../Resources/img/MQ_fav.png" type="image/png" rel="icon"><link rel="stylesheet" href="../Resources/css/hfStyle.css">
<link rel="stylesheet" href="../Resources/css/S.css"> </head>
<header>
<img id="Logo" src="../Resources/Img/MQ.png" alt="Meta Quiz Logo"/>
<div class="listContainer">
<ul id="headerList"> 
<li id="headerListPoints" class="rightBorder"> <a id="home" href="index.html" style="color:white;"> Home </a> </li> 
<li id="headerListPoints" class="rightBorder"><a id="home" href="course_selection.html" style="color:white;"> Practice </a> </li>
<li id="headerListPoints"><a id="home" href="user.html" style="color:white;"> Account</a> </li>
</ul>

</div>

<div id="LogTab">
<span id="LogIn"><a id="home" href="log_in.html" style="color:white;">Log In</a> </span>
<span id="SignUp"> <a id="home" href="sign_up.html" style="color:white;"> Sign Up </a></span>
<div>
</header>
<div id="timeleft">
    <div id="timer"></div>
</div>
<main id="aa">
<div class="historyQuestionBody">
<div class="subInfo"> Statistics</div>
<div class="subInfo"><?php echo $_GET['quiz_id']?></div>
<table>
   <tr>
      <th>Attempt Number</th>
      <th>Score</th>
      <th>Percentage Correct</th>
      <th>Attempt DateTime</th>
   </tr>
   <?php
   $servername = "localhost";
   $username = "root";
   $password = "";
   $dbname = "quiz_db";
   $connection = mysqli_connect($servername, $username, $password, $dbname);
   $user_id = $_SESSION['user_id'];
   $quiz_id = $_GET['quiz_id'];
   $query = "SELECT * from stat where user_id='$user_id' and quiz_id='$quiz_id'";

   $result = mysqli_query($connection, $query);
   $quizzes = array();
   if (mysqli_num_rows($result) > 0) {
       while ($row = mysqli_fetch_assoc($result)) {
           $quizzes[] = $row;
       }
   }
   mysqli_close($connection);

   foreach ($quizzes as $quiz): ?>
   <tr>
      <td><?php echo htmlspecialchars($quiz['attempt_number']); ?></td>
      <td><?php echo htmlspecialchars($quiz['score']); ?></td>
      <td><?php echo htmlspecialchars($quiz['percentage_solved']); ?></td>
      <td><?php echo htmlspecialchars($quiz['end_timestamp']); ?></td>
   </tr>
   <?php endforeach; ?>
</table>



<style>
    table {
  width: 100%;
  border-collapse: collapse;
}

th, td {
  border: 1px solid #ddd;
  padding: 8px;
  text-align: left;
}





</style>


<form action="" method="post">

    <input type="submit" name="export" value="Export to Excel" />
</form>


</div>


</main>

<footer>
<div class="BoxContainer">
<img id="fLogo" src="../Resources/Img//MQ.png" alt="Meta Quiz Logo"/>

<div class="FBoxes">
<span id="BoxTi">Company</span>
<ul class="Ful"> 
<li id="fLists"> <a style="color:white;" id="home" href="redirect.html"> Who is META?</a> </li>
<li id="fLists"><a style="color:white;" id="home" href="redirect.html"> Where are we? </a></li>
<li id="fLists"><a style="color:white;" id="home" href="redirect.html"> Our Clients? </a></li>
</ul>
 </div>
 
 <div class="FBoxes">
<span id="BoxTi"> Products</span>
<ul class="Ful"> 
<li id="fLists"> <a style="color:white;" id="home" href="redirect.html"> Weather System </a></li>
<li id="fLists"><a style="color:white;" id="home" href="redirect.html"> Book Store</a> </li>
</ul>

 </div>
 
 </div>
 
 <div class="Socials">
 <span id="follow"> Follow Us </span>
 <div id="SM">
 <a id="sLinks" href="http://instagram.com"><img src="../Resources/Img/Insta.png" alt="Instagram"></a>
<a id="sLinks" href="http://facebook.com"> <img src="../Resources/Img/Facebook.png" alt="Facebook"></a>
 <a id="sLinks" href="http://Youtube.com"><img src="../Resources/Img/Youtube.png" alt="YouTube"></a>
<a id="sLinks" href="http://twitter.com"> <img src="../Resources/Img/X.png" alt="Twitte X"></a>
 
 </div>
 </div>
 
 <div id="lic">
 <ul> 
 <li id="footerListPoints" class="rightBorder"><a style="color:white;" id="home" href="redirect.html">Privacy </a></li>
 <li id="footerListPoints" class="rightBorder"> <a style="color:white;" id="home" href="redirect.html">Terms &amp; Conditions </a> </li>
 <li id="footerListPoints"><a style="color:white;" id="home" href="redirect.html"> Security </a></li>
 </ul>
 
 <span id="MetaCopy"> &copy; META 2024 </span>
 </div>
</footer>
<li id="subj" value="his"></li>



</html>