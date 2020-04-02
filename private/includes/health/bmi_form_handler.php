<?php

// define vars
$user_id = '';
$height = '';
$weight = '';
$created_at = '';
$bmi = '';
$error = [];

// Get username from session
$username = $_SESSION['username'];

// Initiate DB
$user = new User($db);
$health = new Health($db);

// get all health DB data
$health_data = $health->read();

// fetch health data
$fetch_health_data = $health_data->fetch(PDO::FETCH_ASSOC);

// check if result exist
if ($fetch_health_data) {
    $getWeight = $fetch_health_data['weight'];
    $getHeight = $fetch_health_data['height'];
    $bmi = $health->calculate_bmi($getWeight, $getHeight);
}

// get all user's data based on the username
$user_query = $user->read_user_by_username($username);

// fetch user data
$fetch_user_data = $user_query->fetch(PDO::FETCH_ASSOC);

// check if result exist
if ($fetch_user_data) {
    $user_id = $fetch_user_data['id'];
}

if (isset($_POST['add_hw']) && filter_has_var(INPUT_POST, 'add_hw')) {
    // Convert special characters and strip tags from add_height and add_weight form value
    $height = h(st($_POST['add_height']));
    $height = str_replace(' ', '', $height);

    $weight = h(st($_POST['add_weight']));
    $weight = str_replace(' ', '', $weight);

    // Check if height valid
    if (filter_var($height, FILTER_VALIDATE_INT)) {
        $height = filter_var($height, FILTER_VALIDATE_INT);
    } else {
        array_push($error, "Invalid format.");
    }

    // Check if weight valid
    if (filter_var($weight, FILTER_VALIDATE_INT)) {
        $weight = filter_var($weight, FILTER_VALIDATE_INT);
    } else {
        array_push($error, "Invalid format.");
    }

    // Check if there are no errors, if there aren't any then do the DB logic and register new health data
    if (empty($error)) {
        // created_at date now
        $created_at = date('Y-m-d');

        // assign update values to health object
        $health->setUserId($user_id);
        $health->setWeight($weight);
        $health->setHeight($height);
        $health->setCreatedAt($created_at);

        $health_user_id = $health->check_user_info($user_id);

        // count user_id rows if there are any
        $num_rows = $health_user_id->fetchColumn();

        // check if there is already an user_id with weight/height set
        if ($num_rows > 0) {
            // if it is then just update the values
            if ($health->update($user_id)) {
                return true;
            }
        } else {
            // else add values to the table
            if ($health->create()) {
                return true;
            }
            redirect_to(url_for('views/index.php'));
        }
    }
}
