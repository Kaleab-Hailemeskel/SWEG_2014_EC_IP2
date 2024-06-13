<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="../Resources/css/hfStyle.css">
    <link rel="stylesheet" href="../Resources/css/QuestionsCSS2.css">
</head>
<header>
    <img id="Logo" src="../Resources/Img/MQ.png" alt="Meta Quiz Logo" />
    <div class="listContainer">
        <ul id="headerList">
            <li id="headerListPoints" class="rightBorder"> <a id="home" href="index.php" style="color:white;"> Home
                </a>
            </li>
            <li id="headerListPoints"><a id="home" href="about_us.html" style="color:white;"> About Us </a> </li>
        </ul>
    </div>

    <div id="LogTab">
        <div>
</header>

<body>
    <main>
        <h1>Design Your Own Quiz!</h1>
        <form action="add_quiz_admin.php" method="post" enctype="multipart/form-data">
            <label for="quiz_name">Quiz Name:</label>
            <input type="text" id="quiz_name" name="quiz_name" required><br>
            <label for="quiz_id">Quiz ID:</label>
            <input type="text" id="quiz_id" name="quiz_id" required>
            <input type="file" id="quiz_image" name="quiz_image">
            <br><br>

            <h2>Questions</h2>
            <div id="questions">
                <div class="question">
                    <label for="question_text">Question 1:</label>
                    <textarea name="question_text[]" class="question_text" required></textarea><br>
                    <label for="option_1">Option 1:</label>
                    <input type="text" name="option_1[]" required><br>
                    <label for="option_2">Option 2:</label>
                    <input type="text" name="option_2[]" required><br>
                    <label for="option_3">Option 3:</label>
                    <input type="text" name="option_3[]"><br>
                    <label for="option_4">Option 4:</label>
                    <input type="text" name="option_4[]"><br>
                    <label for="correct_choice">Correct Choice (Number):</label>
                    <input type="number" name="correct_choice[]" min="1" max="4" required><br>
                    <button type="button" onclick="deleteQuestion(this)">Delete</button><br><br>
                </div>
            </div>
            <button type="button" onclick="addQuestion()">Add another Question</button><br><br>
            <input type="submit" value="Create Quiz">
        </form>

        <script>
            let questionCount = 1;

            function addQuestion() {
                questionCount++;
                let newQuestion = document.createElement('div');
                newQuestion.classList.add('question');
                newQuestion.innerHTML = `
                    <label for="question_text">Question ${questionCount}:</label>
                    <textarea name="question_text[]" class="question_text" required></textarea><br>
                    <label for="option_1">Option 1:</label>
                    <input type="text" name="option_1[]" required><br>
                    <label for="option_2">Option 2:</label>
                    <input type="text" name="option_2[]" required><br>
                    <label for="option_3">Option 3:</label>
                    <input type="text" name="option_3[]"><br>
                    <label for="option_4">Option 4:</label>
                    <input type="text" name="option_4[]"><br>
                    <label for="correct_choice">Correct Choice (Number):</label>
                    <input type="number" name="correct_choice[]" min="1" max="4" required><br>
                    <button type="button" onclick="deleteQuestion(this)">Delete</button><br><br>
                `;
                document.getElementById('questions').appendChild(newQuestion);
            }

            function deleteQuestion(button) {
                let questionDiv = button.parentNode;
                questionDiv.parentNode.removeChild(questionDiv);
                questionCount--;
                // Update question numbers after deletion
                let questionLabels = document.querySelectorAll('.question label');
                questionLabels.forEach((label, index) => {
                    label.innerHTML = `Question ${index + 1}:`;
                });
            }
        </script>


    </main>

</body>
<footer>
    <div class="BoxContainer">
        <img id="fLogo" src="../Resources/Img//MQ.png" alt="Meta Quiz Logo" />

        <div class="FBoxes">
            <span id="BoxTi">Company</span>
            <ul class="Ful">
                <li id="fLists"> <a style="color:white;" id="home" href="redirect.html"> Who is META?</a> </li>
                <li id="fLists"><a style="color:white;" id="home" href="redirect.html"> Where are we? </a></li>
                <li id="fLists"><a style="color:white;" id="home" href="redirect.html"> Our Clients? </a></li>
            </ul>
        </div>

        <div class="FBoxes">
            <span id="BoxTi"> Products</span>
            <ul class="Ful">
                <li id="fLists"> <a style="color:white;" id="home" href="redirect.html"> Weather System </a></li>
                <li id="fLists"><a style="color:white;" id="home" href="redirect.html"> Book Store</a> </li>
            </ul>

        </div>

    </div>

    <div class="Socials">
        <span id="follow"> Follow Us </span>
        <div id="SM">
            <a id="sLinks" href="http://instagram.com"><img src="../Resources/Img/Insta.png" alt="Instagram"></a>
            <a id="sLinks" href="http://facebook.com"> <img src="../Resources/Img/Facebook.png" alt="Facebook"></a>
            <a id="sLinks" href="http://Youtube.com"><img src="../Resources/Img/Youtube.png" alt="YouTube"></a>
            <a id="sLinks" href="http://twitter.com"> <img src="../Resources/Img/X.png" alt="Twitte X"></a>

        </div>
    </div>

    <div id="lic">
        <ul>
            <li id="footerListPoints" class="rightBorder"><a style="color:white;" id="home" href="redirect.html">Privacy
                </a>
            </li>
            <li id="footerListPoints" class="rightBorder"> <a style="color:white;" id="home" href="redirect.html">Terms
                    &amp;
                    Conditions </a> </li>
            <li id="footerListPoints"><a style="color:white;" id="home" href="redirect.html"> Security </a></li>
        </ul>

        <span id="MetaCopy"> &copy; META 2024 </span>
    </div>
</footer>


</html>

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
$quizId = $_POST["quiz_id"];

$temps="SELECT * from admin_quizzes where quiz_id='$quizId' ";
$result=mysqli_query($conn,$temps);
if(mysqli_num_rows($result)==0){
    $sqlInsertQuiz = "INSERT INTO admin_quizzes (quiz_name, quiz_id) VALUES (?, ?)";
$stmt = $conn->prepare($sqlInsertQuiz);
$stmt->bind_param("ss", $quizName, $quizId);
$stmt->execute();

}

if(!empty($_FILES['quiz_image']['name'])){
$file=$_FILES['quiz_image']['name'];
$fileT=$_FILES['quiz_image']['tmp_name'];
$folder="Images/".$file;
$sqlInsertimages="INSERT INTO image (quiz_id,image) values(?,?)";
$stmt=$conn->prepare($sqlInsertimages);
$stmt->bind_param("ss",$quizId,$file);
$stmt->execute();
move_uploaded_file($fileT,$folder);
}


$sqlInsertQuestion = "INSERT INTO admin_questions (question_text, quiz_id) VALUES (?, ?)";
$sqlInsertOption = "INSERT INTO admin_options (question_id, question_1, question_2, question_3, question_4, correct_choice) VALUES (?, ?, ?, ?, ?, ?)";



foreach ($_POST["question_text"] as $key => $value) {
  $questionText = $value;
  $correctChoice = $_POST["correct_choice"][$key];

  // Insert question
  $stmt = $conn->prepare($sqlInsertQuestion);
  $stmt->bind_param("ss", $questionText, $quizId);
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
