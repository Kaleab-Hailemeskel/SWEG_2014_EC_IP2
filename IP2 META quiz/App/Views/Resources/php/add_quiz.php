<?php

// Database connection details (replace with your actual details)
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "quiz_db";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Get form data
$quizName = $_POST["quiz_name"];
$userId = 1;

// Prepare SQL statements
$sqlInsertQuiz = "INSERT INTO user_quizzes (quiz_name, user_id) VALUES (?, ?)";
$sqlInsertQuestion = "INSERT INTO user_questions (question_text, quiz_id) VALUES (?, ?)";
$sqlInsertOption = "INSERT INTO user_options (question_id, question_1, question_2, question_3, question_4, correct_choice) VALUES (?, ?, ?, ?, ?, ?)";

// Insert quiz data
$stmt = $conn->prepare($sqlInsertQuiz);
$stmt->bind_param("si", $quizName, $userId);
$stmt->execute();
$quizId = $conn->insert_id; // Get the last inserted quiz ID

// Insert question data and options for each question
foreach ($_POST["question_text"] as $key => $value) {
  $questionText = $value;
  $correctChoice = $_POST["correct_choice"][$key];

  // Insert question
  $stmt = $conn->prepare($sqlInsertQuestion);
  $stmt->bind_param("si", $questionText, $quizId);
  $stmt->execute();
  $questionId = $conn->insert_id; // Get the last inserted question ID

  // Insert options
  $optionTextOne = $_POST["option_1"][$key];
  $optionTextTwo = $_POST["option_2"][$key];
  $optionTextThree = $_POST["option_3"][$key];
  $optionTextFour = $_POST["option_4"][$key];
  $correctOptionText;

  $stmt = $conn->prepare($sqlInsertOption);
  switch($_POST["correct_choice"][$key]){
    case 1:
        $correctOptionText = $optionTextOne;
        break;
    case 2:
        $correctOptionText = $optionTextTwo;
        break;
    case 3:
        $correctOptionText = $optionTextThree;
        break;
    case 4:
        $correctOptionText = $optionTextFour;
        break;
  }
  $stmt->bind_param("isssss", $questionId, $optionTextOne, $optionTextTwo, $optionTextThree, $optionTextFour, $correctOptionText);
  $stmt->execute();
}

// Close connection
$conn->close();

// Success message or redirect to a confirmation page
echo "Quiz created successfully!";

?>
