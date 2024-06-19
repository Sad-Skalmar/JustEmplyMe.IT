<?php
include 'database.php';
session_start();

/*Checking if user is logged in*/
if (!isset($_SESSION['user_id'])) {
    header("Location: sign_in.php");
    exit();
}

/*checking profile type, if wrong send to right adress*/
$queryCheckingProfileType = $conn->prepare("SELECT `company_name` FROM users WHERE id = ?");
$queryCheckingProfileType->bind_param("i", $_SESSION['user_id']);
$queryCheckingProfileType->execute();
$queryCheckingProfileType->store_result();
$queryCheckingProfileType->bind_result($company_name);
$queryCheckingProfileType->fetch();

if (!empty($company_name)) {
    header("location: my_company_profile.php");
}
$queryCheckingProfileType->close();

/*Getting logged user's id*/
$user_id = $_SESSION['user_id'];

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

/*Checking if forms are submitted*/
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['saveMainChanges'])) {
        $name = $_POST['name'] ?? '';
        $birth = $_POST['birthDate'] ?? '';
        $status = $_POST['work'] ?? '';

        $queryUpdateInfo = $conn->prepare("UPDATE users SET name = ?, work = ?, birthdate = ? WHERE id = ?");
        if ($queryUpdateInfo === false) {
            die('Prepare failed: ' . htmlspecialchars($conn->error));
        }
        $queryUpdateInfo->bind_param("sssi", $name, $status, $birth, $user_id);
        $queryUpdateInfo->execute();
        $queryUpdateInfo->close();
    } elseif (isset($_POST['saveContactChanges'])) {
        $mail = $_POST['mail'] ?? '';
        $phone = $_POST['phoneNumber'] ?? '';

        $queryUpdateInfo = $conn->prepare("UPDATE users SET mail = ?, phone = ? WHERE id = ?");
        if ($queryUpdateInfo === false) {
            die('Prepare failed: ' . htmlspecialchars($conn->error));
        }
        $queryUpdateInfo->bind_param("ssi", $mail, $phone, $user_id);
        $queryUpdateInfo->execute();
        $queryUpdateInfo->close();
    } elseif (isset($_POST['saveDescriptionChanges'])) {
        $aboutMe = $_POST['aboutMe'] ?? '';

        $queryUpdateInfo = $conn->prepare("UPDATE users SET description = ? WHERE id = ?");
        if ($queryUpdateInfo === false) {
            die('Prepare failed: ' . htmlspecialchars($conn->error));
        }
        $queryUpdateInfo->bind_param("si", $aboutMe, $user_id);
        $queryUpdateInfo->execute();
        $queryUpdateInfo->close();
    }
    /*Refreshing the site*/
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
    
</head>
<body>
    <div id="account">
        <div id="nav">
            <ul>
                <a href="my_personal_profile.php"><li>My profile</li></a>
                <a href="my_applications.php"><li>My applications</li></a>
                <a href="settings_personal.php"><li>Settings</li></a>
            </ul>
        </div>
        <div id="main_info">
        <form id="avatarForm" method="POST" enctype="multipart/form-data">
                <input type="file" id="avatar" name="avatar" accept="image/*" onchange="previewAndUploadImage(event)">
                <input type="hidden" id="userId" name="user_id" value="<?php echo $user_id; ?>">
        </form>
        <img id="myPhoto" src="Images/photos_user_<?php echo $user_id; ?>/profileImage.png" onerror="this.onerror=null; this.src='Images/error.png'" alt="no photo">
         <label><div id = "profileAvatarOverlay" onclick="document.getElementById('avatar').click()"><i class = "material-icons">add_circle</i></div></label>
            <button type="button" id="editMainInfoId" class="editMainInfo" onClick="editMainInfo()"><i class="material-icons editInfoIcon">edit</i></button>
            <form method="POST" id="mainInfo">
                <input type="text" name="name" id="name" class="input" value="<?php echo $name?>" placeholder="First and last name" disabled/>
                <input type="date" name="birthDate" id="birthDate" class="input" value="<?php echo $birthDate?>" placeholder="Date of birth" disabled/>
                <input type="text" name="work" id="work" class="input" value="<?php echo $work?>" placeholder="Current employment" disabled/></br>
                <button type="submit" id="saveMainChanges" name="saveMainChanges">Save</button>
            </form>
        </div>

        <div id="contact">
            <button type="button" id="editContactInfoId" class="editContactInfo" onClick="editContactInfo()"><i class="material-icons editInfoIcon">edit</i></button>
            <form method="POST">
                <input type="mail" name="mail" id="mail" class="input" value="<?php echo $email?>" placeholder="E-mail" disabled/>
                <input type="tel" name="phoneNumber" id="phoneNumber" class="input" pattern="([0-9]{3} ?){2,4}[0-9]{3}" value="<?php echo $phoneNumber?>" placeholder="Tel. number (xxx xxx xxx)" disabled/></br>
                <button type="submit" id="saveContactChanges" name="saveContactChanges">Save</button>
            </form>
        </div>

        <div id="description">
            <button type="button" id="editDescriptionInfoId" class="editDescriptionInfo" onClick="editDescriptionInfo()"><i class="material-icons editInfoIcon">edit</i></button>
            <form method="POST">
                <textarea id="aboutMe" class="input" name="aboutMe" placeholder="Something about me..." disabled><?php echo $description?></textarea>
                <button type="submit" id="saveDescriptionChanges" name="saveDescriptionChanges">Save</button>
            </form>
        </div>
    </div>
    <script src="script.js"></script>
</body>
</html>
