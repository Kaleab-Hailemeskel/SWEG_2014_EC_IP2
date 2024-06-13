<?php
session_start();

?>
<!DOCTYPE html>
<html>
 <head> <link href="../Resources/img/MQ_fav.png" type="image/png" rel="icon"><link rel="stylesheet" href="../Resources/css/hfStyle.css">
<link rel="stylesheet" href="../Resources/css/S.css"> </head>
<link rel="stylesheet" href="../Resources/css/hfStyle.css">
<link rel="stylesheet" href="../Resources/css/course_selection.css"> 
<header>
<img id="Logo" src="../Resources/Img/MQ.png" alt="Meta Quiz Logo"/>
<div class="listContainer">
<ul id="headerList"> 
<li id="headerListPoints" class="rightBorder"> <a id="home" href="index.php" style="color:white;"> Home </a> </li> 
<li id="headerListPoints" class="rightBorder"><a id="home" href="course_selection.php" style="color:white;"> Practice </a> </li>
<li id="headerListPoints"><a id="home" href="about_us.html" style="color:white;"> About Us </a> </li>
</ul>

</div>

<div id="LogTab">
<span id="LogIn"><a id="home" href="log_in.php" style="color:white;">Log In</a> </span>
<span id="SignUp"> <a id="home" href="sign_up.php" style="color:white;"> Sign Up </a></span>
<div>
</header>
<div id="timeleft">
    <div id="timer"></div>
</div>
<main id="aa">
<div class="historyQuestionBody">
<div class="subInfo">Stat select </div>
<?php
$servername="localhost";
$username="root";
$password="";
$dbname="quiz_db";
$connection=mysqli_connect($servername,$username,$password,$dbname);
    $user_id =$_SESSION['user_id'];
  
    $query="SELECT DISTINCT quiz_id from stat where user_id='$user_id'";

$result=mysqli_query($connection,$query);
$quizzes=array();
if(mysqli_num_rows($result)>0){
    while($row=mysqli_fetch_assoc($result)){
        $quizzes[]=$row;
    }
}
mysqli_close($connection);
?>

    <tr>
	<?php foreach($quizzes as $quiz):?>
    
<div class="Content">
    <div class="rounded-box">
        
        <div class="button-container">
            <a id="courseLinks" href="Stats.php?quiz_id=<?php echo urlencode($quiz['quiz_id']);?>">
                <button class = "btn-course"><?php echo $quiz['quiz_id']?></button> </a>
            </a>
        </div>
    </div>

<?php endforeach;?>

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