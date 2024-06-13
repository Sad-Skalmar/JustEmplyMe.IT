<!DOCTYPE html>
<html lang="PL">
<head>
    <meta charset="UTF-8"/>
    <title>Job Market - Register</title>
    <link rel="stylesheet" href="style_account.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
</head>
<body>
    <div id="logInContainer">
        <p class = "main_text"><label>Choose your account's type</label></p>
        <a href = "register_personal.php">
            <div id = "personalAccount">
                <i class="material-icons">person</i><br>
                <p class = "account_name"><label class ="chooseAccountLabel">Personal Account</label></p><span class="personalTipText">Personal accounts are excellent for job hunting.</span>
            </div>
        </a>
        <a href = "register_company.php">
            <div id = "companyAccount">
                <i class="material-icons">apartment</i>
                <p class="account_name"><label class ="chooseAccountLabel">Company Account</label></p><span class="companyTipText">Company accounts are better for posting job offers.</span>
            </div>
        </a>
    </div>
</body>
</html>
