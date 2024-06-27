<!DOCTYPE html>
<html lang="PL">
<head>
    <meta charset="UTF-8"/>
    <title>Job Market - My Job Offers</title>
    <link rel="stylesheet" href="style_account.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <script src="script.js"></script>
</head>
<body>
    <div id="account">
        <div id="nav">
            <ul>
                <a href="my_company_profile.php"><li>My Profile</li></a>
                <a href="my_job_offers.php"><li>My Job Offers</li></a>
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
        if ($numberOfRows < 1) {
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

                echo '
                    <div id="job_offer">
                        <form method="POST" id = "deleteForm">
                            <div id="deleteOfferBox_' . $job_id . '" class="deleteOfferBox">
                                <p class="deleteOfferQuestion">Are you sure you want to delete that offer?</p>
                                <div class="buttonContainer">
                                    <button type="submit" name="deleteOfferButton_' . $job_id . '">Yes</button>
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

                //deleting applications and offer
                if (isset($_POST['deleteOfferButton_' . $job_id])) {
                    $queryDeleteApplications = $conn->prepare("DELETE FROM applications WHERE job_id = ?");
                    if ($queryDeleteApplications === false) {
                        die('Prepare failed: ' . htmlspecialchars($conn->error));
                    }
                    $queryDeleteApplications->bind_param("i", $job_id);
                    $queryDeleteApplications->execute();
                    if ($queryDeleteApplications->error) {
                        die('Execute failed: ' . htmlspecialchars($queryDeleteApplications->error));
                    }
                
                    $queryDeleteOffer = $conn->prepare("DELETE FROM offers WHERE job_id = ?");
                    if ($queryDeleteOffer === false) {
                        die('Prepare failed: ' . htmlspecialchars($conn->error));
                    }
                    $queryDeleteOffer->bind_param("i", $job_id);
                    $queryDeleteOffer->execute();
                    if ($queryDeleteOffer->error) {
                        die('Execute failed: ' . htmlspecialchars($queryDeleteOffer->error));
                    } else {
                        header("Refresh: 0");
                    }
                }
                


                $queryApplicantInfo = $conn->prepare("SELECT `name`, applications.application_id, applications.user_id, applications.status, applications.application_date FROM users INNER JOIN applications ON users.id = applications.user_id WHERE applications.job_id = ?");
                if ($queryApplicantInfo === false) {
                    die('Prepare failed: ' . htmlspecialchars($conn->error));
                }
                $queryApplicantInfo->bind_param("i", $job_id);
                $queryApplicantInfo->execute();
                $queryApplicantInfo->bind_result($applicantName, $applicationId, $applicantId, $status, $applicationDate);
                $queryApplicantInfo->store_result();

                echo '
                    <div class="applicationInfoButton" onclick="toggleApplicationInfo('.$job_id.')">Applicant list <i class="material-icons" id="toggleApplicationIcon_'.$job_id.'">arrow_drop_down</i></div>
                    </div>
                    <div id="applicationInfo_' . $job_id . '" class="applicationInfo" style="display: none;">';

                if ($queryApplicantInfo->num_rows < 1) {
                    echo '<div class="noApplicants">No one has applied for this job yet.</div>';
                } else {
                    while ($queryApplicantInfo->fetch()) {
                        echo '
                        <div class="application">
                            <div class="applicationDate">Application date: <br>' .$applicationDate. '</div>
                            <div class="applicationName">Applicant Name: <a href="profile.php?id='.$applicantId.'" target="_blank"><br>'.$applicantName.'</a></div>
                            <div class="applicationCV"><a target="_blank" href="Resumes/Resumes_'.$job_id.'/CV_'.$applicantId.'.pdf"?forcedownload=1>Download Applicant Resume</a></div>
                            <div class="applicationStatusChange">Status: <p id="statusText_'.$applicationId.'" class="statusText" onclick="toggleStatusInfo('.$applicationId.')">'.$status.'<i class="material-icons" id="toggleStatusIcon_'.$applicationId.'">arrow_drop_down</i></p>
                                <ul id = "statusList_'.$applicationId.'" class = "statusList">
                                <form method="POST">
                                    <button class = "list_element" name = "accept_'.$applicationId.'">Accept</button>
                                    <button class = "list_element" name = "pending_'.$applicationId.'">Pending</button>
                                    <button class = "list_element" name = "decline_'.$applicationId.'">Decline</button>
                                </form>
                                </ul>
                            </div>
                        </div>';

                        if(isset($_POST['accept_'.$applicationId])){
                            $queryChangeApplicationStatus = $conn->prepare("UPDATE `applications` SET `status` = 'Accepted' WHERE application_id = ?");
                            if ($queryChangeApplicationStatus === false) {
                                die('Prepare failed: ' . htmlspecialchars($conn->error));
                            }
                            $queryChangeApplicationStatus->bind_param("i", $applicationId);
                            $queryChangeApplicationStatus->execute();
                            if ($queryChangeApplicationStatus->error) {
                                die('Execute failed: ' . htmlspecialchars($queryChangeApplicationStatus->error));
                            }else{
                                header("Refresh:0");
                            }
                        }else if(isset($_POST['pending_'.$applicationId])){
                            $queryChangeApplicationStatus = $conn->prepare("UPDATE `applications` SET `status` = 'Pending' WHERE application_id = ?");
                            if ($queryChangeApplicationStatus === false) {
                                die('Prepare failed: ' . htmlspecialchars($conn->error));
                            }
                            $queryChangeApplicationStatus->bind_param("i", $applicationId);
                            $queryChangeApplicationStatus->execute();
                            if ($queryChangeApplicationStatus->error) {
                                die('Execute failed: ' . htmlspecialchars($queryChangeApplicationStatus->error));
                            }else{
                                header("Refresh:0");
                            }
                        }else if(isset($_POST['decline_'.$applicationId])){
                            $queryChangeApplicationStatus = $conn->prepare("UPDATE `applications` SET `status` = 'Declined' WHERE application_id = ?");
                            if ($queryChangeApplicationStatus === false) {
                                die('Prepare failed: ' . htmlspecialchars($conn->error));
                            }
                            $queryChangeApplicationStatus->bind_param("i", $applicationId);
                            $queryChangeApplicationStatus->execute();
                            if ($queryChangeApplicationStatus->error) {
                                die('Execute failed: ' . htmlspecialchars($queryChangeApplicationStatus->error));
                            }else{
                                header("Refresh:0");
                            }
                        }

                        
                    }
                }

                echo '</div>'; // Close applicationInfo div
                $queryApplicantInfo->close();
            }
        }

        $querySelectInfo->close();
        $conn->close();
        ?>
        </div>
    </div>
</body>
</html>
