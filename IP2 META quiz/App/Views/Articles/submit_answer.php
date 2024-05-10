<?php 

if($_SERVER['REQUEST_METHOD']=='POST'){
    $rawdata=file_get_contents("php://input");
    $data=json_decode($rawdata,true);
    $quizId=$data['quizId'];
    $answers=$data['answers'];
$connection=new mysqli("localhost","root","","quiz_db");
$statemnt=$connection->prepare(
    " SELECT ao.correct_choice 
    FROM admin_options ao 
    JOIN admin_questions aq ON ao.question_id = aq.question_id 
    WHERE aq.quiz_id = ?
");
$statemnt->bind_param("s",$quizId);
$statemnt->execute();
$result=$statemnt->get_result();
$correctAnswer=[];
while($row=$result->fetch_assoc()){
    $correctAnswer[]=$row['Correct_choice'];
}

$score=0;
foreach($correctAnswer as $questionID=>$correctAnswer){
    if(isset($answers[$questionID]) && $answers[$questionID]==$correctAnswer){
        $score++;
    }
}
echo json_encode(['score'=>$score]);
}
?>