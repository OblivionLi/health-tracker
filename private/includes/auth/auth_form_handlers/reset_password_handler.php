<?php

$reset_password = "";
$reset_password2 = "";
$error = [];

// grab token
$token = h(st($_GET['token']));

// check if token doesn't exist redirect back to login, else continue
if (empty($token)) {
    redirect_to('auth.php');
} else {
    if (isset($_POST['reset_current_pass']) && filter_has_var(INPUT_POST, 'reset_current_pass')) {
        // Instantiate User object
        $user = new User($db);

        // Convert special characters and strip tags from reset_password form value
        $reset_password = h(st($_POST['reset_password']));
        $reset_password2 = h(st($_POST['reset_password2']));

        // Check if reset_password and reset_password2 don't match or if they contain other characters than A-Z, 0-9
        if ($reset_password != $reset_password2) {
            array_push($error, "Your passwords do not match.");
        } else {
            if (preg_match('/[^A-Za-z0-9]/', $reset_password)) {
                array_push($error, "Your password can only contain english characters or numbers.");
            }
        }

        // Check if reset_password value is between 5 and 30 characters
        if (strlen($reset_password) > 30 || strlen($reset_password) < 5) {
            array_push($error, "Your password must be between 5 and 30 characters.");
        }

        // Check if there are no errors, if there aren't any then do the DB logic and register new user
        if (empty($error)) {
            // get email based on the token
            $email_query = $user->read_password_reset($token);
            $email = $email_query->fetch(PDO::FETCH_ASSOC);

            if ($email) {
                // hash the password typed in the field and assign values
                $password = $user->hash_password($reset_password);
                $email = $email['email'];
                $updated_at = date('Y-m-d');

                // update and redirect
                if ($user->update_user($email, $password, $updated_at)) {
                    $user->delete_password_reset($email);
                    $_SESSION['pass-reset'] = "Password has been reset.";
                    redirect_to('auth.php');
                }
            } else {
                redirect_to('auth.php');
            }
        }
    }
}
