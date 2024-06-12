<?php
// Database connection settings
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "RegistrationDB";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Function to sanitize input data
function sanitizeInput($data) {
    return htmlspecialchars(stripslashes(trim($data)));
}

// Function to validate email
function isValidEmail($email) {
    return filter_var($email, FILTER_VALIDATE_EMAIL);
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Personal Information
    $fullName = sanitizeInput($_POST['fullName']);
    $dob = sanitizeInput($_POST['dob']);
    $gender = sanitizeInput($_POST['gender']);

    // Contact Information
    $email = sanitizeInput($_POST['email']);
    $phone = sanitizeInput($_POST['phone']);

    // Account Details
    $username = sanitizeInput($_POST['username']);
    $password = password_hash(sanitizeInput($_POST['password']), PASSWORD_BCRYPT);
    $securityQuestion = sanitizeInput($_POST['securityQuestion']);
    $securityAnswer = sanitizeInput($_POST['securityAnswer']);

    // Educational Information
    $educationLevel = sanitizeInput($_POST['educationLevel']);
    $fieldOfInterest = sanitizeInput($_POST['fieldOfInterest']);

    // Payment Information
    $cardNumber = sanitizeInput($_POST['cardNumber']);
    $expiryDate = sanitizeInput($_POST['expiryDate']);
    $cvv = sanitizeInput($_POST['cvv']);
    $billingAddress = sanitizeInput($_POST['billingAddress']);

    // Professional Information
    $jobTitle = sanitizeInput($_POST['jobTitle']);
    $company = sanitizeInput($_POST['company']);

    // Profile Information
    $profilePicture = addslashes(file_get_contents($_FILES['profilePicture']['tmp_name']));
    $bio = sanitizeInput($_POST['bio']);

    // Location Information
    $country = sanitizeInput($_POST['country']);

    // Preferences
    $courseRecommendations = sanitizeInput($_POST['courseRecommendations']);
    $communicationPreferences = sanitizeInput($_POST['communicationPreferences']);

    // Additional Information
    $referral = sanitizeInput($_POST['referral']);
    $goals = sanitizeInput($_POST['goals']);

    // Validate email
    if (isValidEmail($email)) {
        // Start transaction
        $conn->begin_transaction();

        try {
            // Insert data into Users table
            $stmt = $conn->prepare("INSERT INTO Users (fullName, dob, gender, email, phone, username, password, securityQuestion, securityAnswer) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("sssssssss", $fullName, $dob, $gender, $email, $phone, $username, $password, $securityQuestion, $securityAnswer);
            $stmt->execute();
            $userID = $stmt->insert_id;

            // Insert data into EducationalInformation table
            $stmt = $conn->prepare("INSERT INTO EducationalInformation (userID, educationLevel, fieldOfInterest) VALUES (?, ?, ?)");
            $stmt->bind_param("iss", $userID, $educationLevel, $fieldOfInterest);
            $stmt->execute();

            // Insert data into PaymentInformation table
            $stmt = $conn->prepare("INSERT INTO PaymentInformation (userID, cardNumber, expiryDate, cvv, billingAddress) VALUES (?, ?, ?, ?, ?)");
            $stmt->bind_param("issss", $userID, $cardNumber, $expiryDate, $cvv, $billingAddress);
            $stmt->execute();

            // Insert data into ProfessionalInformation table
            $stmt = $conn->prepare("INSERT INTO ProfessionalInformation (userID, jobTitle, company) VALUES (?, ?, ?)");
            $stmt->bind_param("iss", $userID, $jobTitle, $company);
            $stmt->execute();

            // Insert data into ProfileInformation table
            $stmt = $conn->prepare("INSERT INTO ProfileInformation (userID, profilePicture, bio) VALUES (?, ?, ?)");
            $stmt->bind_param("iss", $userID, $profilePicture, $bio);
            $stmt->execute();

            // Insert data into LocationInformation table
            $stmt = $conn->prepare("INSERT INTO LocationInformation (userID, country) VALUES (?, ?)");
            $stmt->bind_param("is", $userID, $country);
            $stmt->execute();

            // Insert data into Preferences table
            $stmt = $conn->prepare("INSERT INTO Preferences (userID, courseRecommendations, communicationPreferences) VALUES (?, ?, ?)");
            $stmt->bind_param("iss", $userID, $courseRecommendations, $communicationPreferences);
            $stmt->execute();

            // Insert data into AdditionalInformation table
            $stmt = $conn->prepare("INSERT INTO AdditionalInformation (userID, referral, goals) VALUES (?, ?, ?)");
            $stmt->bind_param("iss", $userID, $referral, $goals);
            $stmt->execute();

            // Commit transaction
            $conn->commit();

            echo "Registration successful!";
        } catch (Exception $e) {
            // Rollback transaction if an error occurs
            $conn->rollback();
            echo "Registration failed: " . $e->getMessage();
        }

        // Close statement
        $stmt->close();
    } else {
        echo "Invalid email address.";
    }
}

// Close connection
$conn->close();
?>
