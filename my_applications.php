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

            $queryCheckingProfileType = $conn->prepare("SELECT `company_name` FROM users WHERE id = ?");
            $queryCheckingProfileType->bind_param("i", $_SESSION['user_id']);
            $queryCheckingProfileType->execute();
            $queryCheckingProfileType->store_result();
            $queryCheckingProfileType->bind_result($company_name);
            $queryCheckingProfileType->fetch();
            
            if (!empty($company_name)) {
                header("location: my_job_offers.php");
            }
            $queryCheckingProfileType->close();


            $user_id = $_SESSION['user_id'];
            $querySelectInfo = $conn -> prepare("SELECT `name`, `min_salary`, `max_salary`, `company`, `location`, `workplace`, `date`, `description`, `experience`, `type` FROM offers INNER JOIN applications ON offers.job_id = applications.job_id WHERE applications.user_id = ?");
            if ($querySelectInfo === false) {
                die('Prepare failed: '.$conn->error);
            }
            $querySelectInfo->bind_param("i", $user_id);
            $querySelectInfo->execute();
            $querySelectInfo->bind_result($job_name, $min_salary, $max_salary, $company_name, $location, $workplace, $date, $description, $experience, $type);
            $querySelectInfo->store_result();
            

            $numberOfRows = $querySelectInfo->num_rows;
            if($numberOfRows<1){
                echo('<div id = "noOffers"><label>U dont have any applications</label></div>');
            }else{
                while ($querySelectInfo->fetch()) {
                if($max_salary == 0){
                    $salary = $min_salary." PLN";
                }else{
                    $salary = $min_salary." - ".$max_salary." PLN";
                }
                $todayDate = date_create(date("Y-m-d"));
                $uploadDate = date_create($date);
                $finalDate = date_diff($todayDate, $uploadDate);

                echo('
                <div id="job_offer">
                    <div id="job_name">'.$job_name.'</div>
                    <div id="company_name"><i class="fa-sharp fa-regular fa-building"></i>'.$company_name.'</div>
                    <div id="job_location"><i class="fa-solid fa-location-dot"></i>'.$location.'</div>
                    <div id="workplace"><i class="fa-solid fa-globe"></i>'.$workplace.'</div>
                    <div id="date">'.$finalDate->format("%a days ago").'</div>
                </div>
                ');
            }
        }

            $querySelectInfo->close();
            $conn->close();
            ?>
        </div>
    </div>