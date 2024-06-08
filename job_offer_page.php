<?php 
    include('database.php');
    $job_id = $_GET['id'];
    @$user_id = $_SESSION['user_id'];
    if($job_id!=0){

    if (!isset($user_id)) {
        echo 
        '<script>
                document.addEventListener("DOMContentLoaded", function() {
                document.getElementById("applyButton").style.display = "none";
                });
        </script>';
    } else {
        
        $SelectCompanyNameQuery = $conn->prepare("SELECT `company_name` FROM users WHERE id = ?");
        $SelectCompanyNameQuery->bind_param("i", $user_id);
        $SelectCompanyNameQuery->execute();
        $SelectCompanyNameQuery->store_result();
        $SelectCompanyNameQuery->bind_result($company_name);
        $SelectCompanyNameQuery->fetch();
        
        if (!empty($company_name)) {
            echo 
            '<script>
                document.addEventListener("DOMContentLoaded", function() {
                document.getElementById("applyButton").style.display = "none";
                });
            </script>';
        } else {
            echo '<script>
                document.addEventListener("DOMContentLoaded", function() {
                document.getElementById("applyButton").style.display = "block";
                });
            </script>';
        }
        $SelectCompanyNameQuery->close();
        
        
    }    
    $SelectJobInfoQuery = $conn->prepare("SELECT name, min_salary, max_salary, company, location, workplace, date, description, experience, type FROM offers WHERE job_id = ?");
    $SelectJobInfoQuery->bind_param("i", $job_id);
    $SelectJobInfoQuery->execute();
    $SelectJobInfoQuery->bind_result($job_name, $min_salary, $max_salary, $company_name, $location, $workplace, $date, $description, $experience, $type);
    $SelectJobInfoQuery->fetch();
    $SelectJobInfoQuery->close();

    if(@$max_salary == 0){
        @$salary = $min_salary." PLN";
    }else{
        @$salary = $min_salary." - ".$max_salary." PLN";
    }
    
    $todayDate = date_create(date("Y-m-d"));
    $uploadDate = date_create($date);
    $finalDate = date_diff($todayDate, $uploadDate);
    echo ('
        <div id = "job_offer_page">
            <div id = "job_offer_header">
                <div class = "job_offer_page_name">'.$job_name.'</div>

                <div class = "job_offer_page_company">'.$company_name.'</div>

                <div class = "job_offer_page_date">'.$finalDate->format("%a days ago").'</div>

                <div class = "job_offer_page_location">'.$location.'</div>
        </div>
        
        <div id = "job_offer_middle">
            <div id = "job_offer_page_salary"><h2 class = "job_page_salary_text">Salary:</h2>'.$salary.'</div>

            <div id="job_offer_page_description"><textarea class="desc_text_area" disabled>'.$description.'</textarea></div>
        </div>
        <div id = "job_offer_page_footer">
            <div class = "job_offer_page_footer_level">
                <h2 class = "footer_level_text">Experience:</h2>
                    <p class = "footer_level_subtext">'.@$experience.'</p></div>
                
            <div class = "job_offer_page_footer_date">
                <h2 class = "footer_level_text">Upload Date:</h2>
                    <p class = "footer_level_subtext">'.@$date.'</p></div>

            <div class = "job_offer_page_footer_time">
                <h2 class = "footer_level_text">Type of work:</h2>
                    <p class = "footer_level_subtext">'.@$type.'</p></div>
            
            <div class = "job_offer_page_footer_workplace">
                <h2 class = "footer_level_text">Workplace:</h2>
                    <p class = "footer_level_subtext">'.@$workplace.'</p></div>
            </div>
            <form method = "POST">
            <button id = "applyButton" name = "applyButton">Apply for job!</button>
            </form>
        <script>fixedPosition()</script>
    ');
    
    if (isset($_POST['applyButton'])) {
        if($user_id != NULL){
        $applicationDate = date("Y-m-d");
        $status = 'Pending';
        $checkingIfApplied = $conn->prepare("SELECT application_id from applications where user_id = ? and job_id = ?");
        $checkingIfApplied->bind_param("ii", $user_id, $job_id);
        $checkingIfApplied->execute();
        $checkingIfApplied->bind_result($application_id);
        $checkingIfApplied->store_result();
        $checkingIfApplied->fetch();

        if($checkingIfApplied->num_rows > 0){
            $applyresalut = "You already applied for this job!";
            $checkingIfApplied->close();
        }else{
        $insertApplicationInfo = $conn->prepare("INSERT INTO applications (user_id, job_id, application_date, status) VALUES (?, ?, ?, ?)");
        $insertApplicationInfo->bind_param("iiss", $user_id, $job_id, $applicationDate, $status);
        $insertApplicationInfo->execute();
        $insertApplicationInfo->close();
        $applyresalut = "Application submitted successfully!";
    }
    }
    echo '<div class = "applyresault">'.@$applyresalut.'</div>';
}
}
?>
