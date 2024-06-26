<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head> <link href="../Resources/img/MQ_fav.png" type="image/png" rel="icon"><link rel="stylesheet" href="../Resources/css/hfStyle.css">
<link rel="stylesheet" href="../Resources/css/login-style.css">  </head>
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
 
 
    <main>
    <div class="img-container">
      <img src="../Resources/img/Welcome Back.png" class="log--sign">

    </div>
    <div class="container">
    <div class="login--box"> 
     <div class="box--content">
        <form action = "log_in.php" method="post">
          <h2>Log In</h2>
          <p id="label-sign">Sign Back in to continue your practice</p>
          <input type="email" name="email" placeholder="Email" class="inputs" required><br>
          <input type="password" name="pass" placeholder="Password" class="inputs" required>
          <p class="forgot-pass"><a id="home" href="redirect.html" style="color:white;"> Forgot your password? </a></p>
          <button type="submit" name="login_btn" class="btn--login">Log In</button>
           <p  id="signup-segue">New to META Quiz? <a href="sign_up.html" style="color:white;"> <i>Join Now<i></a></p>
        </form>
        <?php
include("clean_input.php");
include("dbcon.php");

$user_email = $user_password = "";
if(isset($_POST["login_btn"])){
    $user_email = clean_input( $_POST["email"]);
    $user_password = clean_input($_POST["pass"]);
    $search_query = "SELECT * FROM users WHERE email = '$user_email'";
    $search_query_run =  mysqli_query($con, $search_query);
    $user = mysqli_fetch_assoc($search_query_run);
    if($user['role']=='Admin'){
      header("Location: add_quiz_admin.php");
          exit;
    }
    if((mysqli_num_rows($search_query_run) == 1) and (password_verify($user_password,$user['password']))){
      
        $_SESSION["user_id"] = $user['user_id']; 
        $_SESSION["curr"] = "correct password login allowed";
        if($user['role']=='User'){
        header("Location: course_selection_for_users.php");
        exit;
      }
        else{
          header("Location: add_quiz_admin.php");
          exit;
        }
    }
    else{
        echo "<script><alert('login failed')</script>";
    }
}
?>
     </div>     
  </div>
</div>

</main>
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

