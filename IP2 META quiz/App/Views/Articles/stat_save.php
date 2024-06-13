<?php

header('Content-Type: application/json');


$inputJSON = file_get_contents('php://input');
$input = json_decode($inputJSON, TRUE); 


$servername = "localhost";
$username = "root";
$password = "";
$dbname = "quiz_db";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
/*

quizId:quizId,
        userid:userid,
        score:c2,
        totalq:c1,
        percent:(c2/c1)*100,
        timetaken:(5*60*1000),
        endtime:new Date().toISOString()
*/

$attempt_sql = "SELECT MAX(attempt_number) AS max_attempt FROM stat WHERE user_id = ? AND quiz_id = ?";
$attempt_stmt = $conn->prepare($attempt_sql);
$attempt_stmt->bind_param("is", $input['userid'], $input['quizId']);
$attempt_stmt->execute();
$attempt_result = $attempt_stmt->get_result();
$attempt_row = $attempt_result->fetch_assoc();
$attempt_number = $attempt_row['max_attempt'] + 1;

$stmt = $conn->prepare("INSERT INTO stat (user_id, quiz_id, attempt_number, time_taken, score, percentage_solved) VALUES (?, ?, ?, ?, ?,?)");
$stmt->bind_param("isiiid", $input['userid'], $input['quizId'], $attempt_number, $input['timetaken'],  $input['score'], $input['percent']);


if ($stmt->execute()) {
    echo json_encode(array('status' => 'success'));
} else {
    echo json_encode(array('status' => 'error', 'message' => $stmt->error));
}

$attempt_stmt->close();
$stmt->close();
$conn->close();
?>
