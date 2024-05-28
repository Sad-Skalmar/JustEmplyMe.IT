<!DOCTYPE html>
<html lang="PL">
<head>
    <meta charset="UTF-8"/>
    <title>Job Market - Register</title>
    <link rel="stylesheet" href="style_account.css">
    <link rel = "stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    <div id="container">
        <p class = "main_text"><label>Choose your account's type</label></p>
        <a href = "register_personal.php">
            <div id = "personal">
                <i class="fa-solid fa-person"></i><br>
                <p class = "account_name"><label class ="pointingLabel">Personal Account</label></p><span class="personalTipText">Personal accounts are excellent for job hunting.</span>
            </div>
        </a>
        <a href = "register_company.php">
            <div id = "company">
                <i class="fa-solid fa-building"></i>
                <p class="account_name"><label class ="pointingLabel">Company Account</label></p><span class="companyTipText">Company accounts are better for posting job offers.</span>
            </div>
        </a>
    </div>
</body>
</html>
