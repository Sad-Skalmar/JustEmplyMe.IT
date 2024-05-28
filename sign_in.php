<?php
session_start();
include 'database.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = ($_POST['username']);
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT `id`, `password`, `company_name` FROM users WHERE username = ?");

    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($id, $hashed_password, $company_name);
    $stmt->fetch();

    if ($stmt->num_rows > 0 || password_verify($password, $hashed_password)) {
        $_SESSION['user_id'] = $id;
        if (!empty($company_name)) {
            header("Location: my_company_profile.php");
        } else {
            header("Location: my_personal_profile.php");
        }
        exit();
    } else {
            $error = "Invalid username or password.";
    }

    $stmt->close();
    $conn->close();
}
?>


<!DOCTYPE html>
<html lang="PL">
<head>
    <meta charset="UTF-8"/>
    <title>Job Market - Login</title>
    <link rel="stylesheet" href="style_account.css">
</head>
<body>
    <div id="container">
        <form method="POST">
            <input type="text" id="username" name="username" placeholder="Username" required>
            <input type="password" id="password" name="password" placeholder="Password" required>
            <div id="error" style="color: red;"><?php if (isset($error)) echo $error; ?></div>
            <button type="submit">Sign in</button>
        </form>
    </div>
</body>
</html>
