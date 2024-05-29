<head>
        <meta charset = "UTF-8"/>
        <title>Add offer</title>
        <link rel = "stylesheet" href="style_add.css">
        <link href="https://fonts.googleapis.com/css2?family=Nunito:ital,wght@0,200..1000;1,200..1000&display=swap" rel="stylesheet">
</head>
<body>
    <div id = "form_background">
        <div id = "stage">
            <label><p class = "stage">1</p></label><hr/>
            <label><p class = "stage checked">2</p></label><hr/>
            <label><p class = "stage">3</p></label>
        </div>
        <button onclick="window.history.back()" class = "button_back">Back</button>
        <form action = "add_offer_3.php" method = "POST" id = "form" >
        <button type = "submit" class = "button_next">Next</button><br><br>
            <div class = "min_salary">
                <label class = "label_text">Miniumum Salary (PLN)</label><br>
                <input type = "number" class = "form_text_box min" name = "min_salary" required></input>
            </div>

            <div class = "max_salary">
                <label class = "label_text">Maximum Salary (PLN)</label><br>
                <input type = "number" class = "form_text_box max" name = "max_salary" required></input>
            </div>

            <div class = "description">
                <label class = "label_text">Description</label></br>
                <textarea class = "form_text_box desc" name = "description" required></textarea>
            </div>
            <input type="hidden" name="job_name" value="<?php echo @$_POST['job_name']; ?>">
            <input type="hidden" name="company_name" value="<?php echo @$_POST['company_name']; ?>">
            <input type="hidden" name="experience" value="<?php echo @$_POST['radio_exp']; ?>">
            <input type="hidden" name="type" value="<?php echo @$_POST['radio_type']; ?>">
            <input type="hidden" name="workplace" value="<?php echo @$_POST['radio_workplace']; ?>">
            <input type="hidden" name="localization" value="<?php echo @$_POST['localization']; ?>">
        </form>
    </div>
</body>