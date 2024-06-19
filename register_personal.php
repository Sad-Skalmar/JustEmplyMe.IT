<?php
include 'database.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $rePassword = $_POST['rePassword'];
    $mail = $_POST['mail'];
    $name = $_POST['name'];
    $phone = $_POST['phone'];

    if ($password !== $rePassword) {
        $error = "Passwords do not match.";
    } elseif(strlen($password) < 10){
        $error = "Password is too short.";
    }else {
        $hashed_password = password_hash($password, PASSWORD_BCRYPT);

        $usernamecheck = $conn->prepare("SELECT id FROM users WHERE username = ?");
        $usernamecheck->bind_param("s", $username);
        $usernamecheck->execute();
        $usernamecheck->store_result();

        $mailcheck = $conn->prepare("SELECT id FROM users WHERE mail = ?");
        $mailcheck->bind_param("s", $mail);
        $mailcheck->execute();
        $mailcheck->store_result();
        
        $phonecheck = $conn->prepare("SELECT id FROM users WHERE phone = ?");
        $phonecheck->bind_param("s", $phone);
        $phonecheck->execute();
        $phonecheck->store_result();
        
        if ($usernamecheck->num_rows > 0 || $mailcheck->num_rows > 0 || $phonecheck->num_rows > 0) {
            $error = "Username already exists.";
        } else {
            $usernamecheck = $conn->prepare("INSERT INTO users (`username`, `password`, `mail`, `name`, `phone`) VALUES (?, ?, ?, ?, ?)");
            $usernamecheck->bind_param("sssss", $username, $hashed_password, $mail, $name, $phone);
            if ($usernamecheck->execute()) {
                mkdir("Images/", "photos_user_".$conn->insert_id, 0655);
                header("Location: index.php");
                exit();
            } else {

                $error = "Registration failed. Please try again.";
            }
        }
        
        $usernamecheck->close();
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
</head>
<body>
    <div id="logInContainer">
        <form method="POST">
            <input type="text" name="username" placeholder="Username" required>
            <input type="text" name="name" placeholder="First and last name" required>
            <input type="email" name="mail" placeholder="E-mail" required>
            <input type="number" name = "phone" pattern="([0-9]{3} ?){2,4}[0-9]{3}" placeholder="Phone number (xxx xxx xxx)" required>
            <input type="password" name="password" placeholder="Password" required>
            <input type="password" name="rePassword" placeholder="Re-password" required>
            <div id="error" style="color: red;"><?php if (isset($error)) echo $error; ?></div>
            <button type="submit" name="sign_up_button">Sign up</button>
        </form>
    </div>
</body>
</html>
