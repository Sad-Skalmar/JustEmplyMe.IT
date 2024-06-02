<?php
include 'database.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: sign_in.php");
    exit();
}

$user_id = $_SESSION['user_id'];

$stmt = $conn->prepare("SELECT `company_name`, `work`, `tin`, `mail`, `phone`, `description` FROM users WHERE id = ?");
if ($stmt === false) {
    die('Prepare failed: ' . htmlspecialchars($conn->error));
}
$stmt->bind_param("i", $user_id);
$stmt->execute();
$stmt->bind_result($name, $work, $birthDate, $email, $phoneNumber, $description);
$stmt->fetch();
$stmt->close();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['saveMainChanges'])) {
        $name = $_POST['name'] ?? '';
        $birth = $_POST['birthDate'] ?? '';
        $status = $_POST['work'] ?? '';

        $stmt = $conn->prepare("UPDATE users SET company_name = ?, work = ?, birthdate = ? WHERE id = ?");
        if ($stmt === false) {
            die('Prepare failed: ' . htmlspecialchars($conn->error));
        }
        $stmt->bind_param("sssi", $name, $status, $birth, $user_id);
        $stmt->execute();
        $stmt->close();
    } elseif (isset($_POST['saveContactChanges'])) {
        $mail = $_POST['mail'] ?? '';
        $phone = $_POST['phoneNumber'] ?? '';

        $stmt = $conn->prepare("UPDATE users SET mail = ?, phone = ? WHERE id = ?");
        if ($stmt === false) {
            die('Prepare failed: ' . htmlspecialchars($conn->error));
        }
        $stmt->bind_param("ssi", $mail, $phone, $user_id);
        $stmt->execute();
        $stmt->close();
    } elseif (isset($_POST['saveDescriptionChanges'])) {
        $aboutMe = $_POST['aboutMe'] ?? '';

        $stmt = $conn->prepare("UPDATE users SET description = ? WHERE id = ?");
        if ($stmt === false) {
            die('Prepare failed: ' . htmlspecialchars($conn->error));
        }
        $stmt->bind_param("si", $aboutMe, $user_id);
        $stmt->execute();
        $stmt->close();
    }
    header("Refresh:0");
}

$conn->close();
?>


<!DOCTYPE html>
<html lang="PL">
<head>
    <meta charset="UTF-8"/>
    <title>Job Market - Dashboard</title>
    <link rel="stylesheet" href="style_account.css">
    <link rel = "stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    <div id = "account">
    <div id = "nav">
            <ul>
                <a href = "my_company_profile.php"><li>My profile</li></a>
                <a href = "my_job_offers.php"><li>My Job offers</li></a>
                <a href = "settings_company.php"><li>Settings</li></a>
            </ul>
        </div>
        <div id = "main_info">
            <img id="myPhoto" src="images/myPhoto.png" onerror="this.onerror=null; this.src='images/error.jpg'" alt = "no photo">
            <button type = "button" id = "editMainInfoId" class = "editMainInfo" onClick = "editMainInfo()"><i class="fa-solid fa-pencil fa-xs"></i></button>
            <form method="POST" id = "mainInfo">
                <input type = "text" name = "name" id = "name" class = "input" value = "<?php echo $name?>" placeholder="Company name" disabled/>
                <input type = "text" name = "tin" id = "birthDate" class = "input" value = "<?php echo $birthDate?>" placeholder= "Tax Identification Numbers(TIN)" disabled/>
                <input type = "text" name = "work" id = "work" class = "input" value = "<?php echo $work?>" placeholder="Sector" disabled/></br>
                <button type = "submit" id = "saveMainChanges" name = "saveMainChanges">Save</button>
            </form>
        </div>

        <div id = "contact">
        <button type = "button" id = "editContactInfoId" class = "editContactInfo" onClick = "editContactInfo()"><i class="fa-solid fa-pencil fa-xs"></i></button>
            <form method="POST">
                <input type = "mail" name = "mail" id = "mail" class = "input" value = "<?php echo $email?>" placeholder="E-mail" disabled/>
                <input type="tel" name="phoneNumber" id="phoneNumber" class = "input" pattern="([0-9]{3} ?){2,4}[0-9]{3}" value = "<?php echo $phoneNumber?>" placeholder="Tel. number (xxx xxx xxx)" disabled/></br>
                <button type = "submit" id = "saveContactChanges" name = "saveContactChanges">Save</button>
            </form>
        </div>

        <div id = "description">
            <button type = "button" id = "editDescriptionInfoId" class = "editDescriptionInfo" onClick = "editDescriptionInfo()"><i class="fa-solid fa-pencil fa-xs"></i></button>
            <form method="POST">
                <textarea id = "aboutMe" class = "input" name = "aboutMe" placeholder = "Something about me..." disabled><?php echo $description?></textarea>
                <button type = "submit" id = "saveDescriptionChanges" name = "saveDescriptionChanges">Save</button>
            </form>
        </div>
    </div>
    <script src="script.js"></script>
</body>
</html>