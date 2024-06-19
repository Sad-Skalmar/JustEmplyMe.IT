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
                <a href="my_personal_profile.php"><li>My profile</li></a>
                <a href="my_applications.php"><li>My applications</li></a>
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
                <a href = "offer.php?id='.$job_id.'">
                <div id="job_offer">
                    <form method="POST">
                        <div id="deleteOfferBox_' . $job_id . '" class="deleteOfferBox">
                            <p class="deleteOfferQuestion">Are you sure you want to delete your application?</p>
                            <button type="submit" name="deleteOfferButton_' . $job_id . '">Yes</button>
                            <button type="button" onclick="toggleDeleteOverlay(' . $job_id . ')">No</button>
                        </div>
                    </form>
                    <div class="deleteOfferButton" onclick="toggleDeleteOverlay(' . $job_id . ')"><i class="material-icons">close</i></div>
                    <a href="offer.php?id=' . $job_id . '">
                    <div class="job_name">'.$job_name.'</div>
                    <div class="salary">'.$salary.'</div>
                    <div class="company_name"><i class="material-icons">apartment</i>'.$company_name.'</div>
                    <div class="job_location"><i class="material-icons">location_on</i>'.$location.'</div>
                    <div class="workplace"><i class="material-icons">public</i>'.$workplace.'</div>
                    <div class="date">'.$finalDate->format("%a days ago").'</div>
                </a>
                    <div class = "applicationInfoButton" onclick="toggleApplicationInfo('.$job_id.')">Application info <i class="material-icons" id="toggleIcon_'.$job_id.'">arrow_drop_down</i></div>
                </div>
                <div id="applicationInfo_'.$job_id.'" class="applicationInfo">
                    <div class="applicationDate">Application date: <br>'.$applicationDate.'</div>
                    <div class="applicationStatus">Status: <p id="statusText_'.$job_id.'" class = "statusText">'.$status.'</p></div>
                </div>
                </a>';
            }
        }

            $querySelectInfo->close();
            $conn->close();
            ?>
        </div>
    </div>
</body>
</html>
