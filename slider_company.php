
<div id = "slider">
        <div id = "filter"></div>
        <div id="container">
        <div id = "account">
            <div id = "show_account_list" onclick = "toggleAccountList()">My account <i class="material-icons" id = "toggleAccountIcon">arrow_drop_down</i></div>
                <ul id = "account_list">
                    <a href = 'my_company_profile.php'><li class = "list_element">My Account</li></a>
                    <a href = 'my_job_offers.php'><li class = "list_element">My Job Offers</li></a>
                    <a href = 'logout.php'><li class = "list_element">Log Off</li></a>
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
            include("database.php");
            @$order = $_GET['sort'];
            if($order == NULL){
               $order = 'job_id';
            }
            $queryAll = mysqli_query($conn, "SELECT * from offers order by $order");
            $queryGetJobInfo = $conn->prepare("SELECT `job_id`, `name`, `min_salary`, `max_salary`, `company`, `location`, `workplace`, `date`, `job_owner_id` from offers order by ?");
            if ($queryGetJobInfo === false) {
                die('Prepare failed: ' . htmlspecialchars($conn->error));
            }
            /*Binding query results to variables*/
            $queryGetJobInfo->bind_param("s", $order);
            $queryGetJobInfo->execute();
            $queryGetJobInfo->bind_result($job_id, $job_name, $min_salary, $max_salary, $company_name, $location, $workplace, $uploadDate, $job_owner_id);
            $queryGetJobInfo->store_result();
            $NumberOfRows = $queryGetJobInfo->num_rows;
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
                    <img class = "logo" src = "Images/photos_user_'.$job_owner_id.'/profileImage.png" onerror="this.onerror=null; this.src=\'Images/error.png\'">
                    <div class = "higher_container">
                        <div class = "job_name">
                            <h2 class = "job_name_text">'.$job_name.'</h2>
                        </div>
                        <div class = "salary">
                            <h2 class = "job_salary_text">'.$salary.'</h2>
                        </div>
                        </div>
                        <div class = "lower_container"> 
                            <div class = "company_name"><i class="material-icons">apartment</i>'.$company_name.'</div>
                            <div class = "location"><i class="material-icons">location_on</i>'.$location.'</div>
                            <div class = "workplace"><i class="material-icons">public</i>'.$workplace.'</div>
                            <div class = "date">'.$date->format("%a days ago").'</div>
                    </div>
                </div>
                </a>
                ');
            }
        }else {
                echo '<p>No job offers found.</p>';
            }
        ?>
        <a href = "add_offer.php"><div id = "add_offer">
            <div class = "add_offer_button"><i class="material-icons">add</i></div>
            <div class = "add_offer_text">Add your own offer!</div>
        </div>
        </a>
    </div>