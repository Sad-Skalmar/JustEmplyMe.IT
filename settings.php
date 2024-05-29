<?php
include 'database.php';
session_start();

/* Checking if user is logged in */
if (!isset($_SESSION['user_id'])) {
    header("Location: sign_in.php");
    exit();
}

/* Getting logged user's id */
$user_id = $_SESSION['user_id'];

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['changePasswordButton'])) {
    $currentPassword = $_POST['currentPassword'];
    $newPassword = $_POST['newPassword'];
    $rePassword = $_POST['rePassword'];

    $queryCheckPassword = $conn->prepare("SELECT `password` FROM users WHERE id = ?");
    $queryCheckPassword->bind_param("i", $user_id);
    $queryCheckPassword->execute();
    $queryCheckPassword->store_result();
    $queryCheckPassword->bind_result($hashed_password);
    $queryCheckPassword->fetch();

    if ($queryCheckPassword->num_rows > 0 && password_verify($currentPassword, $hashed_password)) {
        if ($newPassword !== $rePassword) {
            $error = "Passwords do not match.";
        } elseif (strlen($newPassword) < 10) {
            $error = "Password is too short.";
        } else {
            $newHashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
            $queryUpdatePassword = $conn->prepare("UPDATE users SET password = ? WHERE id = ?");
            if ($queryUpdatePassword === false) {
                die('Prepare failed: ' . htmlspecialchars($conn->error));
            }
            $queryUpdatePassword->bind_param("si", $newHashedPassword, $user_id);
            $queryUpdatePassword->execute();
            $queryUpdatePassword->close();
            $success = "Password changed successfully.";
            header("Refresh:0");
        }
    } else {
        $error = "Invalid current password.";
    }

    $queryCheckPassword->close();
    $conn->close();
}

if (isset($_POST['deleteAccountButtonYes'])) {
    $queryDeleteAccount = $conn->prepare("DELETE FROM users WHERE id = ?;");
    if ($queryDeleteAccount === false) {
        die('Prepare failed: ' . htmlspecialchars($conn->error));
    }
    $queryDeleteAccount->bind_param("i", $user_id);
    $queryDeleteAccount->execute();
    $queryDeleteAccount->close();
    header("Location: index.php");
    session_destroy();
    exit();
}
?>

<!DOCTYPE html>
<html lang="PL">
<head>
    <meta charset="UTF-8"/>
    <title>Job Market - Settings</title>
    <link rel="stylesheet" href="style_account.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        .hidden {
            display: none;
        }
    </style>
</head>
<body>
    <div id="account">
        <div id="nav">
            <ul>
                <a href="my_personal_profile.php"><li>My profile</li></a>
                <a href="my_applications.php"><li>My applications</li></a>
                <a href="settings.php"><li>Settings</li></a>
            </ul>
        </div>
        <div id="settings">
            <div id="changePassword">
                <span class="changePasswordMainText"><label>Change password</label></span>
                <button id="changePasswordShow" onclick="toggleChangePasswordVisibility()">Change</button><br>
                <span class="changePasswordSubtext"><label>Want to change your password?</label></span>
            </div>
            <form id="changePasswordForm" class="changePasswordForm hidden" method="POST">
                <input type="password" class="inputPasswordChange" name="currentPassword" placeholder="Current password" required/>
                <input type="password" class="inputPasswordChange" name="newPassword" placeholder="New password - At least 10 characters" required/>
                <input type="password" class="inputPasswordChange" name="rePassword" placeholder="Re-write new password" required/><br>
                <div id="error" style="color: red;"><?php if (isset($error)) echo $error; ?></div>
                <div id="success" style="color: green;"><?php if (isset($success)) echo $success; ?></div>
                <button type="submit" class="changePasswordButton" name="changePasswordButton">Change your password</button>
            </form>

            <div id="deleteAccount">
                <span class="deleteAccountMainText"><label>Delete Account</label></span>
                <button id="deleteAccountShow" onclick="toggleDeleteAccountVisibility()">Delete</button><br>
                <span class="deleteAccountSubtext"><label>We are sorry to hear that you are going :(</label></span><br>
            </div>
            <form id="deleteAccountForm" class="deleteAccountForm hidden" method="POST">
                <span class = "deleteAccountQuestion"><label>Are you sure?</label><br></span>
                <button type="submit" class="deleteAccountButton" name="deleteAccountButtonYes">Yes</button>
                <button type="button" class="deleteAccountButton" name="deleteAccountButtonNo">No</button>
            </form>
        </div>
    </div>

    <script>
        function toggleChangePasswordVisibility() {
            const button = document.getElementById('changePasswordShow');
            const form = document.getElementById('changePasswordForm');
            const changePasswordDiv = document.getElementById('changePassword');
            if (form.classList.contains('hidden')) {
                form.classList.remove('hidden');
                button.innerHTML = "Collapse";
                changePasswordDiv.style.borderBottom = "none";
                form.style.borderBottom = "0.1px solid #A9A9A9";
            } else {
                form.classList.add('hidden');
                button.innerHTML = "Change";
                changePasswordDiv.style.borderBottom = "0.1px solid #A9A9A9";
                form.style.borderBottom = "none";
            }
        }

        function toggleDeleteAccountVisibility() {
            const button = document.getElementById('deleteAccountShow');
            const form = document.getElementById('deleteAccountForm');
            const deleteAccountDiv = document.getElementById('deleteAccount');
            if (form.classList.contains('hidden')) {
                form.classList.remove('hidden');
                button.innerHTML = "Collapse";
                deleteAccountDiv.style.borderBottom = "none";
                form.style.borderBottom = "0.1px solid #A9A9A9";
            } else {
                form.classList.add('hidden');
                button.innerHTML = "Delete";
                deleteAccountDiv.style.borderBottom = "0.1px solid #A9A9A9";
                form.style.borderBottom = "none";
            }
        }
    </script>
</body>
</html>
