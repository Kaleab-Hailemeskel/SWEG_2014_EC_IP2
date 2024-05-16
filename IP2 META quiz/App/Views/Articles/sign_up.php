<?php
// REGISTRATION PHP FILE
global $con;
session_start();
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
    include("dbcon.php");

    if(!preg_match("/^[a-zA-Z-' ]*$/", $user_full_name)){
        echo "Only letters and spaces are allowed <br>";
        return;
    }
    if(!filter_var($user_email , FILTER_VALIDATE_EMAIL)){
        echo "invalid email format<br>";
        return;
    }
    if(!preg_match("/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[a-zA-Z]).{8,}$/", $user_password)){
        echo ("Password must contain both small and capital characters including underscore and numbers<br>");
        return;
    }
    if($user_cof_password !== $user_password){
        echo " two different passwords found in the form<br>";
        return;
    }
    
    include("dbcon.php");
    $search_query = "SELECT * FROM users WHERE email = '$user_email' LIMIT 1";
    $search_query_run =  mysqli_query($con, $search_query);

    if(mysqli_num_rows($search_query_run) > 0 ){
        $_SESSION['curr'] = "user already exist";
        echo "user already exist<br>";
        header("Location: sign_up.html");
        return;
    }
    else{
        $register_query = "INSERT INTO users(username, password,email,role) VALUES ('$user_full_name', '$user_password', '$user_email', 'user')";
        $register_query_run = mysqli_query($con, $register_query);

        if($register_query_run){
            $_SESSION['curr'] = "Registration successful";
            echo "Successful Registration<br>";
        }
        else{
            $_SESSION['curr'] = "Registration went wrong";
            echo "registration went wrong<br>";
        }

    }

    
}




?>