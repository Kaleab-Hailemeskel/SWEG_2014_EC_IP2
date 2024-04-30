<?php

$servername = "localhost";
$username = "root";
$password = "";
$database = "quiz_db";

function make_table($connection, $query){
    if($connection->query($query) == TRUE){
        echo "Table created successfully.<br>";
    }
    else{
        echo "Error creating table: " . $connnection->error . "<br>";
    }
}
function delete_table($connection, $query){
    if($connection->query($query) == TRUE){
        echo "Table destroyed successfully.<br>";
    }
    else{
        echo "Error destroying table: " . $connnection->error . "<br>";
    }
}

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
else{
    echo "Database accessed successfully.";
}


$users_creator = "CREATE TABLE IF NOT EXISTS users (
    user_id INT NOT NULL AUTO_INCREMENT, 
    username VARCHAR(50) NOT NULL UNIQUE, 
    password VARCHAR(255) NOT NULL,       
    email VARCHAR(100) NOT NULL UNIQUE,  
    role ENUM('Admin', 'User') NOT NULL DEFAULT 'User', 
    PRIMARY KEY (user_id)   
);";

$admin_quizzes_creator = "CREATE TABLE IF NOT EXISTS admin_quizzes(
    quiz_id INT NOT NULL AUTO_INCREMENT,
    quiz_name VARCHAR(50) NOT NULL UNIQUE,
    PRIMARY KEY (quiz_id)
);";

$user_quizzes_creator = "CREATE TABLE IF NOT EXISTS user_quizzes(
    quiz_id INT NOT NULL AUTO_INCREMENT,
    quiz_name VARCHAR(50) NOT NULL UNIQUE,
    user_id INT NOT NULL, 
    FOREIGN KEY (user_id) REFERENCES users(user_id),
    PRIMARY KEY (quiz_id)
);";

$admin_questions_creator = "CREATE TABLE IF NOT EXISTS admin_questions(
    question_id INT NOT NULL AUTO_INCREMENT,
    question_text VARCHAR(4096) NOT NULL,
    quiz_id INT NOT NULL,
    FOREIGN KEY (quiz_id) REFERENCES admin_quizzes(quiz_id),
    PRIMARY KEY(question_id)
);";

$user_questions_creator = "CREATE TABLE IF NOT EXISTS user_questions(
    question_id INT NOT NULL AUTO_INCREMENT,
    question_text VARCHAR(4096) NOT NULL,
    quiz_id INT NOT NULL,
    FOREIGN KEY (quiz_id) REFERENCES user_quizzes(quiz_id), 
    PRIMARY KEY(question_id)
);";

$admin_options_creator = "CREATE TABLE IF NOT EXISTS admin_options (
    option_id INT NOT NULL AUTO_INCREMENT, 
    question_1 VARCHAR(512) DEFAULT NULL, 
    question_2 VARCHAR(512) DEFAULT NULL, 
    question_3 VARCHAR(512) DEFAULT NULL, 
    question_4 VARCHAR(512) DEFAULT NULL, 
    Correct_Choice VARCHAR(512) NOT NULL,  
    question_id INT NOT NULL,               
    FOREIGN KEY (question_id) REFERENCES admin_Questions(question_id), 
    PRIMARY KEY (option_id)                  
  );";

$user_options_creator = "CREATE TABLE IF NOT EXISTS user_options (
    option_id INT NOT NULL AUTO_INCREMENT, 
    question_1 VARCHAR(512) DEFAULT NULL, 
    question_2 VARCHAR(512) DEFAULT NULL, 
    question_3 VARCHAR(512) DEFAULT NULL, 
    question_4 VARCHAR(512) DEFAULT NULL, 
    correct_choice VARCHAR(512) NOT NULL,  
    question_id INT NOT NULL,               
    FOREIGN KEY (question_id) REFERENCES user_Questions(question_id), 
    PRIMARY KEY (option_id)                  
);";


make_table($conn, $users_creator);
make_table($conn, $admin_quizzes_creator);
make_table($conn, $user_quizzes_creator);
make_table($conn, $admin_questions_creator);
make_table($conn, $user_questions_creator);
make_table($conn, $admin_options_creator);
make_table($conn, $user_options_creator);



if($conn->query("INSERT INTO users (username, password, email) VALUES (0,0,0);") == TRUE){
    echo "Default user (username, password, and email all 0; user_id 1) created successfully.<br>";
} else {
    echo "Error destroying table: " . $connnection->error . "<br>";
}


$conn->close();

?>
