<?php

$register_username = "";
$register_email = "";
$register_password = "";
$register_password2 = "";
$gender_options = "";
$error = [];

if (isset($_POST['register_submit']) && filter_has_var(INPUT_POST, 'register_submit')) {
    // Instantiate User object
    $user = new User($db);


    // Convert special characters and strip tags from register_username form value
    $register_username = h(st($_POST['register_username']));
    $register_username = str_replace(' ', '', $register_username);

    // Check if register_username value is between 2 and 25 characters
    if (strlen($register_username) > 25 || strlen($register_username) < 2) {
        array_push($error, "Your username must be between 2 and 25 characters.");
    }

    // Convert special characters and strip tags from register_email form value
    $register_email = h(st($_POST['register_email']));
    $register_email = str_replace(' ', '', $register_email);

    // Check if register_email valid
    if (filter_var($register_email, FILTER_VALIDATE_EMAIL)) {
        $register_email = filter_var($register_email, FILTER_VALIDATE_EMAIL);

        // check if email exist
        $email_check = $user->check_email_unique($register_email);

        // count email rows if there are any
        $num_rows = $email_check->fetchColumn();

        if ($num_rows > 0) {
            array_push($error, "Email already in use.");
        }
    } else {
        array_push($error,  "Invalid format.");
    }

    // Convert special characters and strip tags from register_email form value
    $register_password = h(st($_POST['register_password']));
    $register_password2 = h(st($_POST['register_password2']));

    // Check if register_password and register_password2 don't match or if they contain other characters than A-Z, 0-9
    if ($register_password != $register_password2) {
        array_push($error, "Your passwords do not match.");
    } else {
        if (preg_match('/[^A-Za-z0-9]/', $register_password)) {
            array_push($error, "Your password can only contain english characters or numbers.");
        }
    }

    // Check if register_password value is between 5 and 30 characters
    if (strlen($register_password) > 30 || strlen($register_password) < 5) {
        array_push($error, "Your password must be between 5 and 30 characters.");
    }

    // Get gender values
    $gender_options = h(st($_POST['optradio']));
    
    if (empty($gender_options)) {
        array_push($error, "You need to choose a gender.");
    }

    // Check if there are no errors, if there aren't any then do the DB logic and register new user
    if (empty($error)) {
        // assign register values to user object
        $user->username = $register_username;
        $user->email = $register_email;
        $user->password = $user->hash_password($register_password);

        // check if gender is male or female
        if ($gender_options == "male") {
            $user->gender = $gender_options;
        } else {
            $user->gender = $gender_options;
        }

        $user->user_closed = 'no';
        $user->created_at = date('Y-m-d');
        $user->updated_at = date('Y-m-d');

        if ($user->create()) {
            redirect_to('auth.php');
        }
    }
}
