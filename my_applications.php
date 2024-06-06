<?php

?>

<!DOCTYPE html>
<html lang="PL">
<head>
    <meta charset="UTF-8"/>
    <title>Job Market - My applications</title>
    <link rel="stylesheet" href="style_account.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    <div id="account">
        <div id="nav">
            <ul>
                <a href="my_personal_profile.php"><li>My profile</li></a>
                <a href="my_applications.php"><li>My applications</li></a>
                <a href="settings_company.php"><li>Settings</li></a>
            </ul>
        </div>
        
        <div id = "job_offers">
            <?php 
            include 'database.php';
            session_start();
            
            if (!isset($_SESSION['user_id'])) {
                header("Location: sign_in.php");
                exit();
            }
            
            $user_id = $_SESSION['user_id'];
            $querySelectInfo = $conn -> prepare("SELECT `name`, `company`, `location`, `workplace`, `date` from offers, applications where applications.user_id = ?");
            if ($querySelectInfo === false) {
                die('Prepare failed: ' . htmlspecialchars($conn->error));
            }
            $querySelectInfo->bind_param("i", $user_id);
            $querySelectInfo->execute();
            $querySelectInfo->bind_result($name, $company, $location, $workplace, $date);
            $querySelectInfo->store_result();
            $querySelectInfo->fetch();

            $numberOfRows = $querySelectInfo->num_rows;
            if($numberOfRows<1){
                echo('<div id = "noOffers"><label>U dont have any applications</label></div>');
            }
            while ($querySelectInfo->fetch()) {
                $todayDate = date_create(date("Y-m-d"));
                $uploadDate = date_create($date);
                $dateDiff = date_diff($todayDate, $uploadDate);

                echo('
                <div id="job_offer">
                    <div id="job_name">'.$name.'</div>
                    <div id="company_name"><i class="fa-sharp fa-regular fa-building"></i>'.$company.'</div>
                    <div id="job_location"><i class="fa-solid fa-location-dot"></i>'.$location.'</div>
                    <div id="workplace"><i class="fa-solid fa-globe"></i>'.$workplace.'</div>
                    <div id="date">'.$dateDiff->format("%a days ago").'</div>
                </div>
                ');
            }

            $querySelectInfo->close();
            $conn->close();
            ?>
        </div>
    </div>