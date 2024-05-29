<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $password = $_POST['password'];
    $hashed_password = password_hash($password, PASSWORD_BCRYPT);
    $passwordCheck = $_POST['passwordCheck'];

        if (password_verify($passwordCheck, $hashed_password)) {
            echo "git";
            exit();
        } else {
            echo "nie";
        }
    }
?>


<body>
    <form method = "POST">
        <input type = "password" id = "pass" name = "password" placeholder = "hasło - ustaw"/>
        <input type = "password" id = "pass" name = "passwordCheck" placeholder = "hasło - sprawdz"/>
        <button type = "submit">sprawdz</button>
    </form>
</body>