
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
            $queryGetJobInfo = $conn->prepare("SELECT `job_id`, `name`, `min_salary`, `max_salary`, `company`, `location`, `workplace`, `date`, `job_owner_id` from offers order by $order");
            if ($queryGetJobInfo === false) {
                die('Prepare failed: ' . htmlspecialchars($conn->error));
            }
            /*Binding query results to variables*/
            $queryGetJobInfo->bind_result($job_id, $name, $min_salary, $max_salary, $companyName, $location, $workplace, $uploadDate, $job_owner_id);
            $queryGetJobInfo->fetch();
            $NumberOfRows = $queryGetJobInfo->num_rows;
            echo $NumberOfRows;
            if ($NumberOfRows > 0) {
                while ($queryGetJobInfo->fetch()) {
                if($max_salary == 0){
                    $salary = $min_salary." PLN";
                }else{
                    $salary = $min_salary." - ".$max_salary." PLN";
                }
                $todayDate = date_create(date("Y-m-d"));
                $uploadDate = date_create($uploadDate);
                $date = date_diff($todayDate, $uploadDate);
                echo ('
                <a href = "offer.php?id='.$job_id.'&sort='.$order.'">
                <div id = "job_offer">
                    <div class = "logo"><img src = "Images/photos_user_'.$job_owner_id.'/profileImage.png"</div>
                    <div class = "higher_container">
                        <div class = "job_name">
                            <h2 class = "job_name_text">'.$name.'</h2>
                        </div>
                        <div class = "salary">
                            <h2 class = "job_salary_text">'.$salary.'</h2>
                        </div>
                        </div>
                        <div class = "lower_container"> 
                            <div class = "company_name"><i class="material-icons">apartment</i>'.$companyName.'</div>
                            <div class = "location"><i class="material-icons">location_on</i>'.$location.'</div>
                            <div class = "workplace"><i class="material-icons">public</i>'.$workplacee.'</div>
                            <div class = "date">'.$date->format("%a days ago").'</div>
                    </div>
                </div>
                </a>
                ');
                }
            }else {
                echo '<p>No job offers found.</p>';
            }

            $queryGetJobInfo->close();
            $conn->close();
        
        ?>
    </div>