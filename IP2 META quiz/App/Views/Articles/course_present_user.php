<!DOCTYPE html>
<html>
 <head> <link href="../Resources/img/MQ_fav.png" type="image/png" rel="icon"><link rel="stylesheet" href="../Resources/css/hfStyle.css">
<link rel="stylesheet" href="../Resources/css/S.css"> </head>
<body>
<header>
<img id="Logo" src="../Resources/Img/MQ.png" alt="Meta Quiz Logo"/>
<div class="listContainer">
<ul id="headerList"> 
<li id="headerListPoints" class="rightBorder"> <a id="home" href="index.html" style="color:white;"> Home </a> </li> 
<li id="headerListPoints" class="rightBorder"><a id="home" href="course_selection.html" style="color:white;"> Practice </a> </li>
<li id="headerListPoints"><a id="home" href="about_us.html" style="color:white;"> About Us </a> </li>
</ul>
</div>

<div id="LogTab">
<span id="LogIn"><a id="home" href="log_in.html" style="color:white;">Log In</a> </span>
<span id="SignUp"> <a id="home" href="sign_up.html" style="color:white;"> Sign Up </a></span>
<div>
</header>

<main>
<div class="historyQuestionBody">
<div id="timeleft"></div>
<div class="subInfo"><?php echo $_GET['quiz_name']?></div>
<div id="timer"></div>
<form method="" action="">
<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "quiz_db";

$conn = mysqli_connect($servername, $username, $password, $dbname);


if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}


$quiz_id = $_GET['quiz_id'];
$user_id=$_SESSION['user_id'];
$sql_questions = "SELECT question_id, question_text FROM user_questions WHERE quiz_id = '$quiz_id' and user_id='$user_id'";


$result_questions = mysqli_query($conn, $sql_questions);

if (mysqli_num_rows($result_questions) > 0) {
   
    while($row = mysqli_fetch_assoc($result_questions)) {
        echo '<div class="container">';
        echo "<p>" . $row['question_text'] . "</p>";
        echo '<div class="options">';

        $sql_options = "SELECT question_1, question_2, question_3, question_4 FROM user_options WHERE question_id = " . $row['question_id'];

        $result_options = mysqli_query($conn, $sql_options);

        if (mysqli_num_rows($result_options) > 0) {
           
            while($option = mysqli_fetch_assoc($result_options)) {
                for ($i = 1; $i <= 4; $i++) {
                    echo '<label class="radioWrapper">' . $option['question_'.$i];
                    echo '<input type="radio" id="q' . $row['question_id'] . 'o' . $i . '" name="q' . $row['question_id'] . '">';
                    echo '<span class="checkmark"></span>';
                    echo '</label>';
             
                }
                echo 'div class="answers"></div>';
            }
        }
        echo '</div></div>';
    }
} 

mysqli_close($conn);
?>
<div>
<input type="hidden" id="quizId" value="<?php echo $quiz_id;?>">
<input type="hidden" id="userid" value="<?php echo $user_id;?>">
<button type="submit" id="submit">Submit </button> <span>  </span><button type="reset" id="reset">Reset</button>
</div>

 </div>
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
<script src="Timer2.js">     
  

 </script>
</body>
</html>
