<?php
session_start();
?>
<html>
<head> <link rel="stylesheet" href="../Resources/css/hfStyle.css">
<link rel="stylesheet" href="../Resources/css/course_selection.css"> 
<link href="../Resources/img/MQ_fav.png" type="image/png" rel="icon"></head>
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
    $user_id =$_SESSION['user_id'];
    echo $user_id;
    $query="SELECT quiz_id,quiz_name,user_id from user_quizzes where user_id='$user_id'";

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
            <a id="courseLinks" href="course_present_user.php?quiz_id=<?php echo urlencode($quiz['quiz_id']);?>&quiz_name=<?php echo urlencode($quiz['quiz_name'])?>">
                <button class = "btn-course"><?php echo $quiz['quiz_name']?></button> </a>
            <a href="#" class="delete-quiz" data-quiz-id="<?php echo urlencode($quiz['quiz_id']);?>" data-user-id="<?php echo urlencode($user_id);?>">
            <button class="btn-delete">Delete</button>
            </a>
        </div>
    </div>

<?php endforeach;?>
</tr>
<tr>

<div >
<a href="add_quiz.php">

    <button class="btn-adds">Add Quizzes</button>
</a>
</div>
</tr>
<tr>
<div >
<a href="stat_choice.php">
    <button class="btn-stat">See Stats</button>
</a>
</div>

</div>
</tr>
<style>
  .btn-stat, .btn-adds {
  background-color: pink; 
  color: black; 
  border: none; 
  padding: 10px 20px; 
  text-align: center; 
  text-decoration: none;
  display: inline-block; 
  font-size: 16px;
  margin: 4px 2px; 
  cursor: pointer; 
  border-radius: 8px; 
  box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2); 
  transition: 0.3s; 
}

.btn-adds {
  float: left; 
}

.btn-stat {
  float: right; 
}

.btn-adds:hover, .btn-stat:hover {
  box-shadow: 0 12px 16px 0 rgba(255, 192, 203, 0.8), 0 17px 50px 0 rgba(255, 192, 203, 0.19); /* Glow effect on hover */
}
  
</style>
    
</table>
<script  src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js" >
  
</script>
<script>
$(document).ready(function(){
    $('.delete-quiz').click(function(e){
        e.preventDefault();
        console.log("dlete button clicked");
        var quiz_id = $(this).data('quiz-id');
        var user_id=$(this).data('user-id')
        
        $.ajax({
            url: 'delete_quiz.php',
            type: 'POST',
            data: {
                'quiz_id': quiz_id,
                'user_id':user_id
            },
            success: function(response){
                console.log("ajax request succeful",response);
                if(response == 'success'){
                    $('div[data-quiz-id="' + quiz_id + '"]').remove();
                }
            },
            error: function(jqXHR, textStatus, errorThrown){
        console.log('AJAX request failed', textStatus, errorThrown);
    } 
        }); console.log("ajx reuest sent");
    });
});
</script>
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
