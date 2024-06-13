<?php
include 'database.php';
session_start();
$user_id = $_GET['id'];

/*Selecting info about user*/
$queryGetInfo = $conn->prepare("SELECT `name`, `work`, `birthdate`, `mail`, `phone`, `description` FROM users WHERE id = ?");
if ($queryGetInfo === false) {
    die('Prepare failed: ' . htmlspecialchars($conn->error));
}
/*Binding query results to variables*/
$queryGetInfo->bind_param("i", $user_id);
$queryGetInfo->execute();
$queryGetInfo->bind_result($name, $work, $birthDate, $email, $phoneNumber, $description);
$queryGetInfo->fetch();
$queryGetInfo->close();

$conn->close();
?>

<!DOCTYPE html>
<html lang="PL">
<head>
    <meta charset="UTF-8"/>
    <title>Job Market - Dashboard</title>
    <link rel="stylesheet" href="style_account.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    <div id="account">
        <div id="main_info">
            <img id="myPhoto" src="images/myPhoto.png" onerror="this.onerror=null; this.src='images/error.jpg'" alt="no photo">
            <form method="POST" id="mainInfo">
                <input type="text" name="name" id="name" class="input" value="<?php echo $name?>" placeholder="First and last name" disabled/>
                <input type="date" name="birthDate" id="birthDate" class="input" value="<?php echo $birthDate?>" placeholder="Date of birth" disabled/>
                <input type="text" name="work" id="work" class="input" value="<?php echo $work?>" placeholder="Current employment" disabled/></br>
            </form>
        </div>

        <div id="contact">
            <form method="POST">
                <input type="mail" name="mail" id="mail" class="input" value="<?php echo $email?>" placeholder="E-mail" disabled/>
                <input type="tel" name="phoneNumber" id="phoneNumber" class="input" pattern="([0-9]{3} ?){2,4}[0-9]{3}" value="<?php echo $phoneNumber?>" placeholder="Tel. number (xxx xxx xxx)" disabled/></br>
            </form>
        </div>

        <div id="description">
            <form method="POST">
                <textarea id="aboutMe" class="input" name="aboutMe" placeholder="Something about me..." disabled><?php echo $description?></textarea>
            </form>
        </div>
    </div>
</body>
</html>
