<?php

$reset_email = "";
$error = [];

if (isset($_POST['reset_submit']) && filter_has_var(INPUT_POST, 'reset_submit')) {
    // Instantiate User object
    $user = new User($db);

    // Convert special characters and strip tags from reset_email form value
    $reset_email = h(st($_POST['reset_email']));
    $reset_email = str_replace(' ', '', $reset_email);

    // check if reset_email field is empty
    if (empty($reset_email)) {
        array_push($error, "Email field is required.");
    }

    // Check if reset_email valid
    if (filter_var($reset_email, FILTER_SANITIZE_EMAIL)) {
        $reset_email = filter_var($reset_email, FILTER_SANITIZE_EMAIL);
    } else {
        array_push($error,  "Invalid format.");
    }

    // check if email exist in the database
    $user_query = $user->read_user($reset_email);

    $fetch_user_data = $user_query->fetch(PDO::FETCH_ASSOC);

    // check if result exist
    if ($fetch_user_data) {
        // fetch row data
        $email = $fetch_user_data['email'];
    } else {
        // get the error if email doesnt exist in the DB
        array_push($error, "Sorry, no user exist associated with this email.");
    }

    // create unique random token of length 100
    $token = bin2hex(random_bytes(50));

    // Check if there are no errors, if there aren't any then do the DB logic and register new user
    if (empty($error)) {
        // add password entry to database
        $user->create_password_reset($reset_email, $token);

        // send email to use with the token in a link they can click on
        $to = $email;
        $subject = "Reset your password on health-tracker.com";
        $msg = '<html><body>';
        $msg .= 'Hi there, click on this';
        $msg .= "<a href='http://localhost/health-tracker/public/views/auth/reset_password.php?token=" . urlencode($token) ."'> Click to reset password </a>";
        $msg .= "to reset your password";
        $msg .= '</body></html>';
        $msg = wordwrap($msg, 70);
        $headers = "From: info@health-tracker.com\r\n";
        $headers .= "Content-type:text/html; charset=UTF-8\r\n";

        mail($to, $subject, $msg, $headers);

        redirect_to('pending.php?email=' . $email);
    }
}
