<?php
    session_start();

    if (!isset($_SESSION['user_id'])) {
        // Użytkownik nie jest zalogowany
        $destination = "slider.php";
    } else {
        include 'database.php';
        
        $stmt = $conn->prepare("SELECT `company_name` FROM users WHERE id = ?");
        $stmt->bind_param("i", $_SESSION['user_id']);
        $stmt->execute();
        $stmt->store_result();
        $stmt->bind_result($company_name);
        $stmt->fetch();
        
        if (!empty($company_name)) {
            $destination = "slider_company.php";
        } else {
            $destination = "slider_personal.php";
        }
        
        $stmt->close();
        $conn->close();
    }
?>
<html lang = "PL">
    <head>
        <meta charset = "UTF-8"/>
        <title>Job Market</title>
        <link rel = "stylesheet" href="style_main.css">
        <link rel = "stylesheet" href="style_job_page.css">
        <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
        <link href="https://fonts.googleapis.com/css2?family=Nunito:ital,wght@0,200..1000;1,200..1000&display=swap" rel="stylesheet">
        <script type="text/javascript" src="script.js"></script>
    </head>
    <body>
        <?php 
        include($destination);
        include("job_offer_page.php");
        ?>

    </body>