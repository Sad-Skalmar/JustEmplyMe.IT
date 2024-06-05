<?php
session_start();

if (!isset($_SESSION['user_id'])) {
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
<DOCTYPE html>
    <head>
        <title>Main Page</title>
        <meta charset="UTF-8"/>
        <script src = "script.js"></script>
        <link rel="stylesheet" href="style_main.css">
        <link rel = "stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    </head>
    <body> 
        <?php include($destination); ?>
    </body>
</html>