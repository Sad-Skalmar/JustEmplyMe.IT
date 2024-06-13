
<div id = "slider">
        <div id = "filter"></div>
        <div id="container">
        <div id = "account">
            <div id = "show_account_list" onclick = "toggleAccountList()">Sign in <i class="material-icons" id = "toggleAccountIcon">arrow_drop_down</i></div>
                <ul id = "account_list">
                    <a href = 'sign_in.php'><li class = "list_element">Sign in</li></a>
                    <a href = 'register.php'><li class = "list_element">Register</li></a>
                </ul>
        </div>
        <div id = "sort_by">
            <div id = "show_sort_list" onclick = "toggleSortList()">Sort <i class="material-icons" id = "toggleSortIcon">arrow_drop_down</i></div>
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
                            <div class = "company_name"><i class="material-icons">apartment</i>'.$row_job_offer["company"].'</div>
                            <div class = "location"><i class="material-icons">location_on</i>'.$row_job_offer["location"].'</div>
                            <div class = "workplace"><i class="material-icons">public</i>'.$row_job_offer["workplace"].'</div>
                            <div class = "date">'.$date->format("%a days ago").'</div>
                    </div>
                </div>
                </a>
                ');
            }
        ?>
    </div>