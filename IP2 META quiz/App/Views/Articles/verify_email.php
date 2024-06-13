

<?php
session_start();
global $con;


if($_SERVER["REQUEST_METHOD"] !== "POST"){
    echo "invalid request method<br>";
    
}
else{
    
    
include("dbcon.php");
$input_code=$_POST['verification_code'];
if($input_code==$_SESSION['temp_user']['code']){
$user_name=$_SESSION['temp_user']['name'];
$user_password=$_SESSION['temp_user']['password'];
$user_email=$_SESSION['temp_user']['email'];
$u_pass=password_hash($user_password,PASSWORD_DEFAULT);
        $register_query = "INSERT INTO users(username, password,email,role) VALUES ('$user_name', '$u_pass', '$user_email', 'User')";
        $register_query_run = mysqli_query($con, $register_query);

        if($register_query_run){
            $_SESSION['curr'] = "Registration successful";
            echo "Successful Registration<br>";
        }
        unset($_SESSION['temp_user']);
    }
        else{
            $_SESSION['curr'] = "Registration went wrong";
            echo "registration went wrong<br>";
        }

    
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="..\Resources\css\signup-style.css">
    <link rel="stylesheet" href="..\Resources\css\hfStyle.css">
    <link href="../Resources/img/MQ_fav.png" type="image/png" rel="icon">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IP</title>
</head>
<header>
    <img id="Logo" src="..\Resources\img\MQ.png" alt="Meta Quiz Logo"/>
    <div class="listContainer">
        <ul id="headerList">
            <li id="headerListPoints" class="rightBorder"><a id="home" href="index.php" style="color:white;"> Home </a>
            </li>
            <li id="headerListPoints" class="rightBorder"><a id="home" href="course_selection.php"
                                                             style="color:white;"> Practice </a></li>
            <li id="headerListPoints"><a id="home" href="about_us.html"> About Us </a></li>
        </ul>
    </div>

    <div id="LogTab">
        <span id="LogIn"><a id="home" href="log_in.php" style="color:white;">Log In</a> </span>
        <span id="SignUp"> <a id="home" href="sign_up.php" style="color:white;"> Sign Up </a></span>
        <div>
</header>
<body>
<main>
    <div class="img-wrapper">
        <img src="../Resources/img/Sign up.png" class="signup--img">
    </div>
    <div class="sign-container">
        <div class="section--signup">
            <h3 id="sign">Sign Up</h3>
            <p id="caption">Complete the following informations to get started </p>

            <form class="signin-form" action="verify_email.php" method="post">

                <div class="input-wrap">
                    <label for="name">Verifcation code: </label>
                    <input type="text" name="verification_code" id="verification_code" placeholder="verification code" required><br><br>
                </div>

                
                <button class="btn-signup">Code confirm</button>
                <br>

            </form>

            <p class="login-segue">Already have an account? <a href="log_in.html" id="login-link">Log in</a></p>
        </div>
    </div>
</main>

</body>


<footer>
    <div class="BoxContainer">
        <img id="fLogo" src="../Img/MQ.png" alt="Meta Quiz Logo"/>

        <div class="FBoxes">
            <span id="BoxTi">Company</span>
            <ul class="Ful">
                <li id="fLists"><a style="color:white;" id="home" href="redirect.html"> Who is META?</a></li>
                <li id="fLists"><a style="color:white;" id="home" href="redirect.html"> Where are we? </a></li>
                <li id="fLists"><a style="color:white;" id="home" href="redirect.html"> Our Clients? </a></li>
            </ul>
        </div>

        <div class="FBoxes">
            <span id="BoxTi"> Products</span>
            <ul class="Ful">
                <li id="fLists"><a style="color:white;" id="home" href="redirect.html"> Weather System </a></li>
                <li id="fLists"><a style="color:white;" id="home" href="redirect.html"> Book Store</a></li>
            </ul>

        </div>

    </div>

    <div class="Socials">
        <span id="follow"> Follow Us </span>
        <div id="SM">
            <a id="sLinks" href="http://instagram.com"><img src="..\Resources\img\Insta.png" alt="Instagram"></a>
            <a id="sLinks" href="http://facebook.com"> <img src="..\Resources\img\Facebook.png" alt="Facebook"></a>
            <a id="sLinks" href="http://Youtube.com"><img src="..\Resources\img\Youtube.png" alt="YouTube"></a>
            <a id="sLinks" href="http://twitter.com"> <img src="..\Resources\img\X.png" alt="Twitte X"></a>

        </div>
    </div>

    <div id="lic">
        <ul>
            <li id="footerListPoints" class="rightBorder"><a style="color:white;" id="home"
                                                             href="redirect.html">Privacy </a></li>
            <li id="footerListPoints" class="rightBorder"><a style="color:white;" id="home" href="redirect.html">Terms
                &amp; Conditions </a></li>
            <li id="footerListPoints"><a style="color:white;" id="home" href="redirect.html"> Security </a></li>
        </ul>

        <span id="MetaCopy"> &copy; META 2024 </span>
    </div>
</footer>
</html>

