<?php require_once('../../private/initialize.php'); ?>

<?php include_once(SHARED_PATH . '/health/bmi_form_handler.php'); ?>

<?php include_once(SHARED_PATH . '/main_header.php'); ?>

<div class="m-3">
    <p>You are here: <a href="<?php echo url_for('views/index.php') ?>">Main page</a></p>
</div>

<div class="shadow-sm p-3 mb-5 bg-white rounded">
    <nav class="navbar navbar-expand-lg navbar-light">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link weight-height header" id="weight-height">BMI calculator</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link water-intake" id="water-intake">Water Intake</a>
                </li>
            </ul>
        </div>
    </nav>

    <div class="content shadow p-3 mb-5 bg-white rounded">
        <div class="weight-height-content" id="weight-height-content">
            <div class="row">
                <div class="col-6">
                    <form action="" method="POST">
                        <div class="form-group">
                            <label for="add_height">
                                <h3>Height (cm)</h3>
                            </label>
                            <input type="number" class="form-control" name="add_height" id="add_height" placeholder="Enter height" value="<?php echo isset($getHeight) ? $getHeight : ''; ?>">
                            <p class="error">
                                <?php echo in_array("Invalid format.", $error) ? "<span>&#8594;</span> Invalid format." : ""; ?>
                            </p>
                        </div>

                        <div class="form-group">
                            <label for="add_weight">
                                <h3>Weight (cm)</h3>
                            </label>
                            <input type="number" class="form-control" name="add_weight" id="add_weight" placeholder="Enter weight" value="<?php echo isset($getWeight) ? $getWeight : ''; ?>">
                            <p class="error">
                                <?php echo in_array("Invalid format.", $error) ? "<span>&#8594;</span> Invalid format." : ""; ?>
                            </p>
                        </div>

                        <button type="submit" name="add_hw" class="btn btn-primary add_hw">Insert Info</button>
                    </form>

                    <div class="bmi-result-content">
                        <?php
                        if ($bmi) :
                            if ($bmi < 18.5) :
                                echo "<p class='bmi-result'>BMI: <span class='underweight'>$bmi</span></p>";
                                echo "<p class='bmi-result'>You are: <span class='underweight'>Underweight</span></p>";
                            elseif ($bmi >= 18.5 && $bmi < 24.9) :
                                echo "<p class='bmi-result'>BMI: <span class='normal'>$bmi</span></p>";
                                echo "<p class='bmi-result'>You are: <span class='normal'>Normal-Healthy</span></p>";
                            elseif ($bmi > 25.0 && $bmi <= 29.9) :
                                echo "<p class='bmi-result'>BMI: <span class='overweight'>$bmi</span></p>";
                                echo "<p class='bmi-result'>You are: <span class='overweight'>Overweight</span></p>";
                            else :
                                echo "<p class='bmi-result'>BMI: <span class='obese'>$bmi</span></p>";
                                echo "<p class='bmi-result'>You are: <span class='obese'>Obese</span></p>";
                            endif;
                        else :
                            echo "<p>First enter a height and a weight to see your BMI.</p>";
                        endif;
                        ?>
                    </div>
                </div>

                <div class="col-6">
                    <h3>BMI Calculator</h3>
                    <div class="bmi-info">
                        <p>Your BMI is calculated based on your Height and Weight.</p>
                        <small>BMI Formula (metric): bmi = weight / height<sup>2</sup></small>
                        <p><small>For male/female older than 18 yo.</small></p>

                        <div class="bmi-categories">
                            <h3>BMI Categories</h3>
                            <p class="underweight">Underweight (< 18.5)</p> <p class="normal">Normal (18.5 - 24.9)</p>
                            <p class="overweight">Overweight (25.0 - 29.9)</p>
                            <p class="obese">Obese (> 30)</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="water-intake-content" id="water-intake-content">
            <div class="row">
                <div class="col-6">
                    <h3>Water Intake</h3>
                    <div class="water-intake-info">
                        <?php
                        if ($bmi) :
                            echo "<p>Your weight (kg): <span>" . $getWeight . "</span></p>";
                            echo "<p>You should drink <span>" . number_format($getWeight / 30, 2, '.', ',') . "L</span> every day.</p>";
                            echo "<p>If you workout 30 minutes every day and eat 2 bananas right after, then you should drink <span>" . number_format($getWeight / 30 + 0.350 + 0.170, 2, '.', ',') . "L</span> every day.</p>";
                            echo "<small>Your total water intake depends of food eaten (some contain water, check right side for list) and/or workout.</small>";
                        else :
                            echo "<p>First go back to Weight & Height BMI Calculator and type your height and weight to see your water intake.</p>";
                        endif;
                        ?>
                    </div>
                </div>

                <div class="col-6">
                    <h3>Water Intake Calculator</h3>
                    <p>Your water intake is based on your weight (in kg) / 30.</p>

                    <div class="water-intake-info">
                        <p>Also if you exercise, you should add +350 ml of water for each 30 minutes of workout.</p>
                        <small>Remember, food has water too.</small>
                        <p><small>Your water intake should be based on your weight/workout/food.</small></p>
                        <p><small>Here is a list of some fruits that contain water, <a href="https://im.indiatimes.in/media/content/2016/Jan/water%20chart_1453716094.jpg" target="__blank">click</a> to open list.</small></p>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>


<?php include_once(SHARED_PATH . '/main_footer.php'); ?>