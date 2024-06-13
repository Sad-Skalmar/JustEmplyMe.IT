<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    $destination = "slider.php";
} else {
    include 'database.php';
    
    $queryCheckingProfileType = $conn->prepare("SELECT `company_name` FROM users WHERE id = ?");
    $queryCheckingProfileType->bind_param("i", $_SESSION['user_id']);
    $queryCheckingProfileType->execute();
    $queryCheckingProfileType->store_result();
    $queryCheckingProfileType->bind_result($company_name);
    $queryCheckingProfileType->fetch();
    
    if (!empty($company_name)) {
        $destination = "slider_company.php";
    } else {
        $destination = "slider_personal.php";
    }
    
    $queryCheckingProfileType->close();
    $conn->close();
}
?>
<DOCTYPE html>
    <head>
        <title>Main Page</title>
        <meta charset="UTF-8"/>
        <script src = "script.js"></script>
        <link rel="stylesheet" href="style_main.css">
        <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    </head>
    <body> 
        <?php include($destination); ?>
    </body>
</html>