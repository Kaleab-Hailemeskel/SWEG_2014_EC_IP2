<?php 

if($_SERVER['REQUEST_METHOD']=='POST'){
    $rawdata=file_get_contents("php://input");
    $data=json_decode($rawdata,true);
    $quizId=$data['quizId'];
    $userid=$data['userid'];
$connection=new mysqli("localhost","root","","quiz_db");
$statemnt=$connection->prepare(
    " SELECT ao.correct_choice 
    FROM user_options ao 
    JOIN user_questions aq ON ao.question_id = aq.question_id 
    JOIN user_quizzes uq ON aq.quiz_id = uq.quiz_id
    WHERE aq.quiz_id = ? AND uq.user_id = ?"
);
$statemnt->bind_param("ss", $quizId, $userid);
$statemnt->execute();
$result=$statemnt->get_result();
$correctAnswer=[];
while($row=$result->fetch_assoc()){
    $correctAnswer[]=$row['correct_choice'];
}
echo json_encode(['correctAnswer'=>$correctAnswer]);
}
?>
