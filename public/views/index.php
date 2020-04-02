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
                    <a class="nav-link weight-height header" id="weight-height">Weight & Height BMI calculator</a>
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
                                <h3>Height</h3>
                            </label>
                            <input type="number" class="form-control" name="add_height" id="add_height" placeholder="Enter height">
                        </div>

                        <div class="form-group">
                            <label for="add_weight">
                                <h3>Weight</h3>
                            </label>
                            <input type="number" class="form-control" name="add_weight" id="add_weight" placeholder="Enter weight">
                        </div>

                        <button type="submit" name="add_hw" class="btn btn-primary add_hw">Add Info</button>
                    </form>
                </div>

                <div class="col-6">
                    <h3>BMI Calculator</h3>
                    <div class="bmi-info">
                        <p>Your BMI is calculated based on your Height and Weight.</p>
                        <p><small>BMI Formula (metric): bmi = weight / height<sup>2</sup></small></p>
                        <!-- <p>Overweight = 25.0 to 29.9</p>
                        <p>Normal weight = 18.5 to 24.9</p>
                        <p>Underweight = under 18.5</p> -->
                    </div>
                </div>
            </div>
        </div>

        <div class="water-intake-content" id="water-intake-content">
            <p>water-intake</p>
        </div>
    </div>
</div>


<?php include_once(SHARED_PATH . '/main_footer.php'); ?>