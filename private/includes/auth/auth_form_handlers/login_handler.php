<?php

if (isset($_POST['login_submit']) && filter_has_var(INPUT_POST, 'login_submit')) {
    // sanitize email
    $login_email = filter_var($_POST['login_email'], FILTER_SANITIZE_EMAIL);

    // verify password
    $login_password = h(st($_POST['login_password']));

    // Initiate DB
    $user = new User($db);

    // get all user data based on email entered in form email field
    $user_query = $user->read_user($login_email);

    $fetch_user_data = $user_query->fetch(PDO::FETCH_ASSOC);
    // check if result exist
    if ($fetch_user_data) {
        // fetch row data
        $id = $fetch_user_data['id'];
        $username = $fetch_user_data['username'];
        $password = $fetch_user_data['password'];
        $email = $fetch_user_data['email'];
        $user_closed = $fetch_user_data['user_closed'];

        // check if password is valid
        if (password_verify($login_password, $password)) {
            // check if user account is closed
            if ($user_closed == 'yes') {
                // reopen account
                $uc = 'no';
                $reopen_account = $user->reopen_user($uc, $id);
            }

            // get the username searched and assign it to the session for usage after login
            $_SESSION['username'] = $username;

            // redirect to home page if everything went right
            redirect_to('../index.php');
        } else {
            // get the error if email was entered but the password was incorrect
            array_push($error, "Email or Password was incorrect.");
        }
    } else {
        // get the error if email doesnt exist in the DB
        array_push($error, "Sorry no user with your credentials exist in our DB.");
    }
}
