<!DOCTYPE html>
<html lang="PL">
<head>
    <meta charset="UTF-8"/>
    <title>Job Market - My applications</title>
    <link rel="stylesheet" href="style_account.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <script src = "script.js"></script>
</head>
<body>
    <div id="account">
        <div id="nav">
            <ul>
                <a href="my_personal_profile.php"><li>My Profile</li></a>
                <a href="my_applications.php"><li>My Applications</li></a>
                <a href="settings_company.php"><li>Settings</li></a>
            </ul>
        </div>
        
        <div id="job_offers">
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
            $querySelectInfo = $conn -> prepare("SELECT offers.job_id, `name`, `min_salary`, `max_salary`, `company`, `location`, `workplace`, `date`, `type`, applications.status, applications.application_date FROM offers INNER JOIN applications ON offers.job_id = applications.job_id WHERE applications.user_id = ?");
            if ($querySelectInfo === false) {
                die('Prepare failed: '.$conn->error);
            }
            $querySelectInfo->bind_param("i", $user_id);
            $querySelectInfo->execute();
            $querySelectInfo->bind_result($job_id, $job_name, $min_salary, $max_salary, $company_name, $location, $workplace, $date, $type, $status, $applicationDate);
            $querySelectInfo->store_result();
            

            $numberOfRows = $querySelectInfo->num_rows;
            if($numberOfRows<1){
                echo('<div id="noOffers"><label>You don\'t have any applications</label></div>');
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

                echo'
                <div id="job_offer">
                    <form method="POST" id = "deleteForm">
                        <div id="deleteOfferBox_' . $job_id . '" class="deleteOfferBox">
                            <p class="deleteOfferQuestion">Are you sure you want to delete that application?</p>
                            <div class="buttonContainer">
                                <button type="submit" name="deleteApplicationButton_' . $job_id . '">Yes</button>
                                <button type="button" onclick="toggleDeleteOverlay(' . $job_id . ')">No</button>
                            </div>
                        </div>
                    </form>
                    <div class="deleteOfferButton" onclick="toggleDeleteOverlay(' . $job_id . ')"><i class="material-icons">close</i></div>
                    <a href="offer.php?id=' . $job_id . '">
                        <div class="job_name">' . htmlspecialchars($job_name, ENT_QUOTES, 'UTF-8') . '</div>
                        <div class="salary">' . htmlspecialchars($salary, ENT_QUOTES, 'UTF-8') . '</div>
                        <div class="company_name"><i class="material-icons">apartment</i>' . htmlspecialchars($company_name, ENT_QUOTES, 'UTF-8') . '</div>
                        <div class="job_location"><i class="material-icons">location_on</i>' . htmlspecialchars($location, ENT_QUOTES, 'UTF-8') . '</div>
                        <div class="workplace"><i class="material-icons">public</i>' . htmlspecialchars($workplace, ENT_QUOTES, 'UTF-8') . '</div>
                        <div class="date">' . $finalDate->format("%a days ago") . '</div>
                    </a>';

                    
                //deleting applications
                if (isset($_POST['deleteApplicationButton_' . $job_id])) {
                    echo $user_id.$job_id;
                    
                    $queryDeleteApplications = $conn->prepare("DELETE FROM applications WHERE user_id = ? and job_id = ?");
                    if ($queryDeleteApplications === false) {
                        die('Prepare failed: ' . htmlspecialchars($conn->error));
                    }
                    $queryDeleteApplications->bind_param("ii", $user_id, $job_id);
                    $queryDeleteApplications->execute();
                    $cvFilePath = "Resumes/Resumes_$job_id/CV_$user_id.pdf";
                    if (file_exists($cvFilePath)) {
                        unlink($cvFilePath);
                    }
                    if ($queryDeleteApplications->error) {
                        die('Execute failed: ' . htmlspecialchars($queryDeleteApplications->error));
                    }else{
                        header("Refresh: 0"); 
                    }
                        
                }
                


                $queryApplicantInfo = $conn->prepare("SELECT `name`, applications.application_id, applications.user_id, applications.status, applications.application_date FROM users INNER JOIN applications ON users.id = applications.user_id WHERE applications.user_id = ? AND applications.job_id = ?");
                if ($queryApplicantInfo === false) {
                    die('Prepare failed: ' . htmlspecialchars($conn->error));
                }
                $queryApplicantInfo->bind_param("ii", $user_id, $job_id);
                $queryApplicantInfo->execute();
                $queryApplicantInfo->bind_result($applicantName, $applicationId, $applicantId, $status, $applicationDate);
                $queryApplicantInfo->store_result();

                echo '
                    <div class="applicationInfoButton" onclick="toggleApplicationInfo('.$job_id.')">My application <i class="material-icons" id="toggleApplicationIcon_'.$job_id.'">arrow_drop_down</i></div>
                    </div>
                    <div id="applicationInfo_' . $job_id . '" class="applicationInfo" style="display: none;">';

                while ($queryApplicantInfo->fetch()) {
                    echo '
                    <div class="application">
                        <div class="applicationDate">Application date: <br>' .$applicationDate. '</div>
                        <div class="applicationStatusChange">Status: <p id="statusText_'.$applicationId.'" class="statusText">'.$status.'</p></div>
                    </div>
                    </div>';
                    }
                }

                echo '</div>'; // Close applicationInfo div
                $queryApplicantInfo->close();
            }
        

        $querySelectInfo->close();
        $conn->close();
        ?>
        </div>
    </div>
</body>
</html>
