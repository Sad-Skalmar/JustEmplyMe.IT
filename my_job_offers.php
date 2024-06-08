<?php

?>

<!DOCTYPE html>
<html lang="PL">
<head>
    <meta charset="UTF-8"/>
    <title>Job Market - My job offers</title>
    <link rel="stylesheet" href="style_account.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    <div id="account">
        <div id="nav">
            <ul>
                <a href="my_company_profile.php"><li>My profile</li></a>
                <a href="my_job_offers.php"><li>My Job offers</li></a>
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

            $queryCheckingProfileType = $conn->prepare("SELECT `company_name` FROM users WHERE id = ?");
            $queryCheckingProfileType->bind_param("i", $_SESSION['user_id']);
            $queryCheckingProfileType->execute();
            $queryCheckingProfileType->store_result();
            $queryCheckingProfileType->bind_result($company_name);
            $queryCheckingProfileType->fetch();
            if (empty($company_name)) {
                header("location: my_applications.php");
            }
            $queryCheckingProfileType->close();
            
            $user_id = $_SESSION['user_id'];
            $querySelectInfo = $conn -> prepare("SELECT `name`, `company`, `location`, `workplace`, `date` from offers where job_owner_id = ?");
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
                echo('<div id = "noOffers"><label>U dont have any job offers posted</label></div>');
            }else{
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
        }
            $querySelectInfo->close();
            $conn->close();
            ?>
        </div>
    </div>