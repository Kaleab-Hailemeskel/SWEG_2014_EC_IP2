<?php
session_start();
include("clean_input.php");
include("dbcon.php");


$user_email = $user_password = "";
if(isset($_POST["login_btn"])){
    $user_email = clean_input( $_POST["email"]);
    $user_password = clean_input($_POST["pass"]);

    $search_query = "SELECT * FROM quiz_db WHERE email = '$user_email' AND password = '$user_password' LIMIT 1";
    $search_query_run =  mysqli_query($con, $search_query);

    if(mysqli_num_rows($search_query_run) == 1){
        $_SESSION["curr"] = "correct password login allowed";
        echo "correct email and password<br>";
    }

}





?>
