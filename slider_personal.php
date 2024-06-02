<div id = "slider">
        <div id = "filter"></div>
        <div id="container">
        <div id = "account">
            <button id = "show_account_list" onclick = "showAccountList()">My account <i class="fa-solid fa-arrow-down"></i></button>
            <button id = "hide_account_list" onclick = "hideAccountList()">My account <i class="fa-solid fa-arrow-up"></i></button>
                <ul id = "account_list">
                    <a href = 'my_personal_profile.php'><li class = "list_element">My Account</li></a>
                    <a href = 'my_applications.php'><li class = "list_element">My Applications</li></a>
                    <a href = 'logout.php'><li class = "list_element">Log Off</li></a>
                </ul>
        </div>
        <div id = "sort_by">
            <button id = "show_sort_list" onclick = "showSortList()">Sort <i class="fa-solid fa-arrow-down"></i></button>
            <button id = "hide_sort_list" onclick = "hideSortList()">Sort <i class="fa-solid fa-arrow-up"></i></button>
                <ul id = "sort_list">
                    <a href = 'offer.php?id=<?php if(isset($_GET['id'])) {echo $_GET['id'];}else{echo 0;}?>&sort=date DESC'><li class = "list_element">Latest</li></a>
                    <a href = 'offer.php?id=<?php if(isset($_GET['id'])) {echo $_GET['id'];}else{echo 0;}?>&sort= min_salary DESC'><li class = "list_element">Highest Salary</li></a>
                    <a href = 'offer.php?id=<?php if(isset($_GET['id'])) {echo $_GET['id'];}else{echo 0;}?>&sort= min_salary ASC'><li class = "list_element">Lowest Salary</li></a>
                </ul>
        </div>
        </div>
        <?php 
            @$order = $_GET['sort'];
            if($order == NULL){
               $order = 'job_id';
            }
            include("database.php");
            $queryAll = mysqli_query($conn, "SELECT * from offers order by $order");
            $Number_Of_Rows = mysqli_num_rows($queryAll);
            for ($y = 1; $y <= $Number_Of_Rows; $y++) {
                $row_job_offer = mysqli_fetch_assoc($queryAll);
                if($row_job_offer['max_salary'] == 0){
                    $salary = $row_job_offer['min_salary']." PLN";
                }else{
                    $salary = $row_job_offer['min_salary']." - ".$row_job_offer['max_salary']." PLN";
                }
                $todayDate = date_create(date("Y-m-d"));
                $uploadDate = date_create($row_job_offer['date']);
                $date = date_diff($todayDate, $uploadDate);
                echo ('
                <a href = "offer.php?id='.$row_job_offer["job_id"].'&sort='.$order.'">
                <div id = "job_offer">
                    <div class = "logo"></div>
                    <div class = "higher_container">
                        <div class = "job_name">
                            <h2 class = "job_name_text">'.$row_job_offer["name"].'</h2>
                        </div>
                        <div class = "salary">
                            <h2 class = "job_salary_text">'.$salary.'</h2>
                        </div>
                        </div>
                        <div class = "lower_container"> 
                            <div class = "company_name">
                            <h2 class = "company_name_text"><i class="fa-sharp fa-regular fa-building"></i>'.$row_job_offer["company"].'</h2>
                        </div>
                        <div class = "location">
                            <h2 class = "location_text"><i class="fa-solid fa-location-dot"></i></i>'.$row_job_offer["location"].'</h2>
                        </div>
                        <div class = "workplace">
                            <h2 class = "workplace_text"><i class="fa-solid fa-globe"></i>'.$row_job_offer["workplace"].'</h2>
                        </div>
                        <div class = "date">
                            <h2 class = "date_text">'.$date->format("%a days ago").'</h2>
                        </div>
                    </div>
                </div>
                </a>
                ');
            }
        ?>
    </div>