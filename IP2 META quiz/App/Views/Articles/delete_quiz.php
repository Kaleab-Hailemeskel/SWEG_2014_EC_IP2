<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "quiz_db";

$connection = new mysqli($servername, $username, $password, $dbname);


if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}


$quiz_id = $_POST['quiz_id'];
$user_id = $_POST['user_id'];


$stmt = $connection->prepare("DELETE FROM user_quizzes WHERE quiz_id = ? AND user_id = ?");


$stmt->bind_param("ii", $quiz_id, $user_id);

if ($stmt->execute()) {
    echo 'success';
} else {
    echo 'error';
}

$stmt->close();
$connection->close();
?>
