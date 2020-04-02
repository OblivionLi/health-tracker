<?php

// define vars
$update_email = '';
$gender_options = '';
$update_password = '';
$update_password2 = '';
$update_user_closed = '';
$error = [];

// Get username from session
$username = $_SESSION['username'];

// Initiate DB
$user = new User($db);

// get all users
$user_query = $user->read_user_by_username($username);

$fetch_user_data = $user_query->fetch(PDO::FETCH_ASSOC);

// check if result exist
if ($fetch_user_data) {
    $existing_email = $fetch_user_data['email'];
    $existing_password = $fetch_user_data['password'];
    $existing_gender = $fetch_user_data['gender'];
    $existing_user_closed = $fetch_user_data['user_closed'];
}

if (isset($_POST['update_submit']) && filter_has_var(INPUT_POST, 'update_submit')) {
    // Convert special characters and strip tags from update_email form value
    $update_email = h(st($_POST['update_email']));
    $update_email = str_replace(' ', '', $update_email);

    // Check if update_email valid
    if (filter_var($update_email, FILTER_VALIDATE_EMAIL)) {
        $update_email = filter_var($update_email, FILTER_VALIDATE_EMAIL);

        // check if email exist
        if ($update_email === $existing_email) {
            $update_email = $existing_email;
        }
    } else {
        array_push($error,  "Invalid format.");
    }

    // Get gender values
    $gender_options = h(st($_POST['optradio']));

    // check if no gender option is selected
    if (empty($gender_options)) {
        array_push($error, "You need to choose a gender.");
    }

    // Convert special characters and strip tags from update_password form value
    $update_password = h(st($_POST['update_password']));
    $update_password2 = h(st($_POST['update_password2']));

    // if passwords field empty, do not change
    if (empty($update_password) && empty($update_password2)) {
        $update_password = $existing_password;
    } else {
        // Check if update_password and update_password2 don't match or if they contain other characters than A-Z, 0-9
        if ($update_password != $update_password2) {
            array_push($error, "Your passwords do not match.");
        } else {
            if (preg_match('/[^A-Za-z0-9]/', $update_password)) {
                array_push($error, "Your password can only contain english characters or numbers.");
            }
        }

        // Check if update_password value is between 5 and 30 characters
        if (strlen($update_password) > 30 || strlen($update_password) < 5) {
            array_push($error, "Your password must be between 5 and 30 characters.");
        }
    }

    // Check if there are no errors, if there aren't any then do the DB logic and register new user
    if (empty($error)) {
        // assign update values to user object
        $user->email = $update_email;
        $user->password = $user->hash_password($update_password);

        // check if gender is male or female and assign the value to user object
        if ($gender_options == "male") {
            $user->gender = $gender_options;
        } else {
            $user->gender = $gender_options;
        }

        $user->updated_at = date('Y-m-d');

        $user->update($username);
        redirect_to(url_for('views/user/profile.php'));
    }
}
