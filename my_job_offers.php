<?php

?>

<!DOCTYPE html>
<html lang="PL">
<head>
    <meta charset="UTF-8"/>
    <title>Job Market - My job offers</title>
    <link rel="stylesheet" href="style_account.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <script src = "script.js"></script>
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
            $querySelectInfo = $conn->prepare("SELECT DISTINCT offers.job_id, `name`, `min_salary`, `max_salary`, `company`, `location`, `workplace`, `date`, `type` FROM offers WHERE offers.job_owner_id = ?");
            if ($querySelectInfo === false) {
                die('Prepare failed: ' . htmlspecialchars($conn->error));
            }

            $querySelectInfo->bind_param("i", $user_id);
            $querySelectInfo->execute();
            $querySelectInfo->bind_result($job_id, $job_name, $min_salary, $max_salary, $company_name, $location, $workplace, $date, $type);
            $querySelectInfo->store_result();
            
            $numberOfRows = $querySelectInfo->num_rows;
            echo('
            ');
            if($numberOfRows < 1){
                echo('<div id="noOffers"><label>You don\'t have any job offers posted</label></div>');
            } else {
                while ($querySelectInfo->fetch()) {
                    if ($max_salary == 0) {
                        $salary = $min_salary . " PLN";
                    } else {
                        $salary = $min_salary . " - " . $max_salary . " PLN";
                    }
                    $todayDate = date_create(date("Y-m-d"));
                    $uploadDate = date_create($date);
                    $finalDate = date_diff($todayDate, $uploadDate);
    
                    echo('
                        <div id="job_offer">
                            <form method = "POST">
                                <div id = "deleteOfferBox_'.$job_id.'" class = "deleteOfferBox">
                                    <p class = "deleteOfferQuestion">Are you sure you want to delete that offer?</p>
                                    <button type = "submit" name = "deleteOfferButton_'.$job_id.'">Yes</button>
                                    <button type = "submit" onclick = "toggleDeleteOverlay('.$job_id.')">No</button>
                                </div>
                            </form>
                            <div class = "deleteOfferButton" onclick = "toggleDeleteOverlay('.$job_id.')"><i class = "material-icons">close</i></div>
                            <a href="offer.php?id='.$job_id.'">
                            <div class="job_name">'.$job_name.'</div>
                            <div class="salary">'.$salary.'</div>
                            <div class="company_name"><i class="material-icons">apartment</i>'.$company_name.'</div>
                            <div class="job_location"><i class="material-icons">location_on</i>'.$location.'</div>
                            <div class="workplace"><i class="material-icons">public</i>'.$workplace.'</div>
                            <div class="date">'.$finalDate->format("%a days ago").'</div>
                        </a>
                            <div class="applicationInfoButton" onclick="toggleApplicationInfo('.$job_id.')">Applicant list <i class="material-icons" id="toggleIcon_'.$job_id.'">arrow_drop_down</i></div>
                        </div>
                    <div id="applicationInfo_'.$job_id.'" class="applicationInfo" style="display: none;">
                    ');

                    if(isset($_POST['deleteOfferYes_'.$job_id])){
                        echo 'chuj'.' '.$job_id;
                    }

                    $queryApplicantInfo = $conn->prepare("SELECT `name`,applications.application_id, applications.user_id, applications.status, applications.application_date FROM users INNER JOIN applications ON users.id = applications.user_id WHERE applications.job_id = ?");
                    if ($queryApplicantInfo === false) {
                        die('Prepare failed: ' . htmlspecialchars($conn->error));
                    }
                    $queryApplicantInfo->bind_param("i", $job_id);
                    $queryApplicantInfo->execute();
                    $queryApplicantInfo->bind_result($applicantName, $applicationId, $applicantId, $status, $applicationDate);
                    $queryApplicantInfo->store_result();
                    if($queryApplicantInfo->num_rows < 1){
                        echo '<div class="noApplicants">No one has applied for this job yet.</div>';
                    }else{
                    while ($queryApplicantInfo->fetch()) {
                        echo('
                        <div class="applicationDate">Application date: <br>'.$applicationDate.'</div>
                        <div class="applicationName">Applicant Name: <a href = "profile.php?id='.$applicantId.'" target = "_blank"><br>'.$applicantName.'</div></a>
                        <div class="applicationCV"><a target = "_blank" href = "Konrad Hościło - CV PL.pdf"?forcedownload=1>Download Applicant Resume</a></div>
                        <div class="applicationStatusChange">Status: <p id="statusText_'.$job_id.'" class = "statusText">'.$status.'</p></div>
                        ');
                    }
                }

                    echo('</div>');
                    $queryApplicantInfo->close();
                }
            }
            
            $querySelectInfo->close();
            $conn->close();
            ?>
        </div>
    </div>