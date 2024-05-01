<html>
<head> <link rel="stylesheet" href="../Resources/css/hfStyle.css">
<link rel="stylesheet" href="../Resources/css/course_selection.css"> 
<link href="../Resources/img/MQ_fav.png" type="image/png" rel="icon"></head>
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
<span id="SignUp"> <a id="home" href="sign_up.html"style="color:white;"> Sign Up </a></span>
<div>
</header>
<body>

<table>
    <tr>
        <div class="Content-image">
            <div class="box" >
                <img src="../Resources/Img/Course Selection.png" alt="Course Selection">
               </div>
                </div>
            </tr><tr>
                <div class="Content-image">
            <div class="box">
                <img id="prac" src="../Resources/Img/Practice Description.png" alt="Practice Explanation">
                
                
            </div>
        </div>
        </tr>
<?php
$servername="localhost";
$username="root";
$password="";
$dbname="quiz_db";
$connection=mysqli_connect($servername,$username,$password,$dbname);

if(!$connection){
    die("connection failed: ".mysqli_connect_error());
}
$query="Select quiz_id,quiz_name from admin_quizzes";
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
        <img src="../Resources/Img/science.jpg" alt="Science Image">
        <div class="button-container">
        <a id="courseLinks" href="course_present.php?quiz_id=<?php echo urlencode($quiz['quiz_id']);?>&quiz_name=<?php echo urlencode($quiz['quiz_name'])?>">
    <button class = "btn-course"><?php echo $quiz['quiz_name']?></button>
</a>

        </div>
    </div>

<?php endforeach;?>
</tr>
</table>
</body>


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


</html>
