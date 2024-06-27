<?php
include 'database.php';
session_start();

/* Checking if user is logged in */
if (!isset($_SESSION['user_id'])) {
    header("Location: sign_in.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$job_id = $_GET['id'];
$applicationDate = date("Y-m-d");
$status = "Pending";

/* Checking profile type, if wrong send to right address */
$queryCheckingProfileType = $conn->prepare("SELECT `company_name` FROM users WHERE id = ?");
$queryCheckingProfileType->bind_param("i", $user_id);
$queryCheckingProfileType->execute();
$queryCheckingProfileType->store_result();
$queryCheckingProfileType->bind_result($company_name);
$queryCheckingProfileType->fetch();

if (!empty($company_name)) {
    header("location: slider_company.php");
}
$queryCheckingProfileType->close();
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['applyButton'])) {

    // Directory where CVs will be stored
    $targetDir = "Resumes/Resumes_" . $job_id;

    // Ensure the directory exists or create it
    if (!file_exists($targetDir)) {
        mkdir($targetDir, 0755, true); // 0755 permissions for directory
    }

    // File details
    $fileName = "CV_" . $user_id . ".pdf";
    $targetFile = $targetDir . '/' . $fileName;

    // Move uploaded file to the designated directory
    if (move_uploaded_file($_FILES['file']['tmp_name'], $targetFile)) {
        // Insert application data into the database
        $queryInsert = $conn->prepare("INSERT INTO applications (`user_id`, `job_id`, `application_date`, `status`) VALUES (?, ?, ?, ?)");
        $queryInsert->bind_param("iiss", $user_id, $job_id, $applicationDate, $status);

        if ($queryInsert->execute()) {
            echo "<script>open('index.php', '_self')</script>";
        } else {
            echo "Error: " . $conn->error;
        }
        $queryInsert->close();
    } else {
        echo "Error uploading file!";
    }
}
?>

<!DOCTYPE html>
<html lang="PL">
<head>
    <meta charset="UTF-8"/>
    <title>Job Market - Application</title>
    <link rel="stylesheet" href="style_account.css">
</head>
<body>
    <div id="logInContainer">
        <form method="POST" enctype="multipart/form-data">
            <label for="file">Choose Resume:</label>
            <input type="file" name="file" id="file" accept="application/pdf" required>
            <button type="submit" name="applyButton" class = "applyButton">Apply</button>
        </form>
    </div>
</body>
</html>
