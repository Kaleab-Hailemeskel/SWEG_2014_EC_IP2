
<?php

session_start();
ob_start();
global $con;

include("clean_input.php");
$user_email = $user_password = $user_cof_password = $user_school_level = $user_full_name = "";
$can_register = true;

if($_SERVER["REQUEST_METHOD"] !== "POST"){
    echo "invalid request method<br>";
    
}
else{
    $user_email = clean_input($_POST["email"]);
    $user_password = clean_input($_POST["password"]);
    $user_cof_password = clean_input($_POST["passwordconfirm"]);
    $user_school_level = $_POST["school-level"];
    $user_full_name = clean_input($_POST["name"]);
    $verification_code = rand(100000, 999999);
    
include("dbcon.php");
    $search_query = "SELECT * FROM users WHERE email = '$user_email' LIMIT 1";
    $search_query_run =  mysqli_query($con, $search_query);

    if(mysqli_num_rows($search_query_run) > 0 ){
        $_SESSION['curr'] = "user already exist";
        echo "user already exist<br>";
        ob_end_flush();
        return;
    }
    else{
        $headers="From: Meta Quiz";

       if (mail($user_email, "Your Verification Code", "Your verification code is: $verification_code",$headers)){
        echo "messgae has been sent";
        $_SESSION['temp_user']=[
            'email'=>$user_email,
            'password'=>$user_cof_password,
            'name'=>$user_full_name,
            'role'=>"user",
            'code'=>$verification_code,
        ];

          header("Location: verify_email.php");
          ob_end_flush();
          exit;
         
        }
        else{
            echo "email was not sent";
        }
 
    }
}
ob_end_flush();
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
    <div class="img-wrapper">
        <img src="../Resources/img/Sign up.png" class="signup--img">
    </div>
    <div class="sign-container">
        <div class="section--signup">
            <h3 id="sign">Sign Up</h3>
            <p id="caption">Complete the following informations to get started </p>
            <!-- THE FORM SHOULD HAVE action = "sign_in.php"-->
            <form class="signin-form" action="sign_up.php" method="post">

                <div class="input-wrap">
                    <label for="name">Full Name: </label>
                    <input type="text" name="name" id="name" placeholder="Full Name" required><br><br>
                </div>

                <div class="input-wrap">
                    <label for="email">Email: </label>
                    <input type="email" id="email" name="email" placeholder="Email" required><br><br>
                </div>
                <div class="input-wrap">
                    <label for="password">Password: </label>
                    <input type="password" id="password" name="password" placeholder="Password"
                           pattern="^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$"
                           title="Password must be at least 8 characters long and include at least one letter and one number, special characters forbidden"
                           required><br><br>
                </div>
                <div class="input-wrap">
                    <label for="passwordconfirm">Confirm Password: </label>
                    <input type="password" id="passwordconfirm" name="passwordconfirm" placeholder="Confirm Password"
                           pattern="^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$"
                           title="Password must be at least 8 characters long and include at least one letter and one number, special characters forbidden"
                           required><br><br>
                </div>
                <div class="input-wrap">
                    <label for="school-level">Choose your education level: </label>
                    <select id="school-level" name="school-level" required>
                        <option value="level:1"> Elementary School</option>
                        <option value="level:2"> Middle School</option>
                        <option value="level:3"> High School</option>
                        <option value="level:4"> Undergraduate</option>
                        <option value="level:5"> Postgraduate</option>
                        <option value="level:6"> Not listed</option>
                    </select><br><br>
                </div>
                <button class="btn-signup">Sign Up</button>
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

