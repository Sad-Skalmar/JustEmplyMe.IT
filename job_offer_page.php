<?php 
    include('database.php');
    $id = $_GET['id'];
    if($id!=0){

    $queryId = mysqli_query($conn, "SELECT * from offers where job_id = $id");
    @$row_job_page = mysqli_fetch_assoc($queryId);
    if(@$row_job_page['max_salary'] == 0){
        @$salary = $row_job_page['min_salary']." PLN";
    }else{
        @$salary = $row_job_page['min_salary']." - ".$row_job_page['max_salary']." PLN";
    }
    
    $todayDate = date_create(date("Y-m-d"));
    $uploadDate = date_create($row_job_page['date']);
    $date = date_diff($todayDate, $uploadDate);
    echo ('
        <div id = "job_offer_page">
            <div id = "job_offer_header">
                <div class = "job_offer_page_name">'.@$row_job_page["name"].'</div>

                <div class = "job_offer_page_company">'.@$row_job_page["company"].'</div>

                <div class = "job_offer_page_date">'.$date->format("%a days ago").'</div>

                <div class = "job_offer_page_location">'.@$row_job_page["location"].'</div>
        </div>
        
        <div id = "job_offer_middle">
            <div id = "job_offer_page_salary"><h2 class = "job_page_salary_text">Salary:</h2>'.@$salary.'</div>

            <div id="job_offer_page_description"><textarea class="desc_text_area" disabled>'.$row_job_page["description"].'</textarea></div>
        </div>
        <div id = "job_offer_page_footer">
            <div class = "job_offer_page_footer_level">
                <h2 class = "footer_level_text">Experience:</h2>
                    <p class = "footer_level_subtext">'.@$row_job_page["experience"].'</p></div>
                
            <div class = "job_offer_page_footer_date">
                <h2 class = "footer_level_text">Upload Date:</h2>
                    <p class = "footer_level_subtext">'.@$row_job_page["date"].'</p></div>

            <div class = "job_offer_page_footer_time">
                <h2 class = "footer_level_text">Type of work:</h2>
                    <p class = "footer_level_subtext">'.@$row_job_page["type"].'</p></div>
            
            <div class = "job_offer_page_footer_workplace">
                <h2 class = "footer_level_text">Workplace:</h2>
                    <p class = "footer_level_subtext">'.@$row_job_page["workplace"].'</p></div>
        </div>
        <script src="scriptFixedPosition.js"></script>
    ');
}
?>
