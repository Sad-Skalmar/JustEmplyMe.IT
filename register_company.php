<?php
include 'database.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $rePassword = $_POST['rePassword'];
    $mail = $_POST['mail'];
    $companyName = $_POST['companyName'];
    $tin = $_POST['tin'];

    if ($password !== $rePassword) {
        $error = "Passwords do not match.";
    } else if (strlen($password) < 10) {
        $error = "Password is too short.";
    } else {
        $hashed_password = password_hash($password, PASSWORD_BCRYPT);

        $usernamecheck = $conn->prepare("SELECT id FROM users WHERE username = ?");
        $usernamecheck->bind_param("s", $username);
        $usernamecheck->execute();
        $usernamecheck->store_result();
        
        if ($usernamecheck->num_rows > 0) {
            $error = "Username already exists.";
            $usernamecheck->close();
        } else {
            $usernamecheck->close();
            
            $mailcheck = $conn->prepare("SELECT id FROM users WHERE mail = ?");
            $mailcheck->bind_param("s", $mail);
            $mailcheck->execute();
            $mailcheck->store_result();
            
            if ($mailcheck->num_rows > 0) {
                $error = "Email already exists.";
                $mailcheck->close();
            } else {
                $mailcheck->close();
                
            $companycheck = $conn->prepare("SELECT id FROM users WHERE tin = ?");
            $companycheck->bind_param("s", $tin);
            $companycheck->execute();
            $companycheck->store_result();
            
            if ($companycheck->num_rows > 0) {
                $error = "Company account already exists.";
                $companycheck->close();
            } else {
                $companycheck->close();
              
                $insertstmt = $conn->prepare("INSERT INTO users (username, password, mail, company_name, tin) VALUES (?, ?, ?, ?, ?)");
                $insertstmt->bind_param("sssss", $username, $hashed_password, $mail, $companyName, $tin);
                 
                if ($insertstmt->execute()) {
                    header("Location: index.php");
                    exit();
                } else {
                    $error = "Registration failed. Please try again.";
                }
                    
                $insertstmt->close();
            }
        }
    }
}

    $conn->close();
}
?>



<!DOCTYPE html>
<html lang="PL">
<head>
    <meta charset="UTF-8"/>
    <title>Job Market - Register</title>
    <link rel="stylesheet" href="style_account.css">
    <link rel = "stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    <div id="logInContainer">
        <form method="POST" id="registrationForm">
            <input type="text" name="username" placeholder="Username" required>
            <input type = "email" name = "mail" placeholder = "E-mail" required>
            <input type = "text" name = "companyName" placeholder = "Company name" required>
            <input type = "number" name = "tin" placeholder = "Tax Identification Number(TIN)" required>
            <input type="password" class="password" name="password" placeholder="Password" required>
            <input type="password" class="password" name="rePassword" placeholder="Re-enter password" required>
            <div id="error" style="color: red;"><?php if (isset($error)) echo $error; ?></div>
            <button type="submit">Sign up</button>
        </form>

    </div>
</body>
</html>
