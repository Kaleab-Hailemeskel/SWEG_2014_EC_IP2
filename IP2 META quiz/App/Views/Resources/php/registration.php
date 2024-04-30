<?php
// Database connection details
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "quiz_db";

// Create connection that will handle checks for existing registrations
$conn = new mysqli($servername, $username, $password, $dbname);

// Create a second connection that will enter the registrant into the database. Technically one connection is enough to handle this, but avoiding
// a commands out of sync error due to the use of two queries takes more effort than simply using a new connection
$conn2 = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Escape user input (consider prepared statements for better security)
$name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
$email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
$regusername = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);

// Hash password securely (avoid logging the actual query)
$hashed_password = password_hash(filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING), PASSWORD_DEFAULT);

// Check for existing username or email using prepared statements
$sql = "SELECT COUNT(*) FROM users WHERE username = ? OR email = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ss", $regusername, $email);
$stmt->execute();
$stmt->bind_result($count);
$stmt->fetch();

if ($count > 0) {
  echo "<script>alert('Username or email already exists.');</script>";
} else {
  // Insert user data into database with prepared statement
  $sql = "INSERT INTO users(username, password, email) VALUES (?, ?, ?)";
  $stmt = $conn2->prepare($sql);
  $stmt->bind_param("sss", $regusername, $hashed_password, $email);
  if ($stmt->execute()) {
    echo "<script>alert('Registration completed successfully!');</script>";
  } else {
    echo "<script>alert('Error registering user: An internal error occurred.');</script>";
  }
}

$stmt->close();
$conn->close();
$conn2->close();

?>
