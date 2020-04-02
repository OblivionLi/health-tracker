<?php require_once('../../../private/initialize.php'); ?>

<?php include_once(SHARED_PATH . '/auth/auth_form_handlers/register_handler.php'); ?>
<?php include_once(SHARED_PATH . '/auth/auth_form_handlers/login_handler.php'); ?>

<?php include_once(SHARED_PATH . '/auth/auth_header.php'); ?>

<div class="container form-wrapper">
    <div class="auth-header text-center">
        <h1>Health Tracker</h1>
        <small>Login or SignUp below!</small>
    </div>

    <div class="login-form shadow-sm p-3 mb-5 bg-white rounded" id="login_form">
        <p class="success" id="success">
            <?php echo isset($_SESSION['pass-reset']) ? $_SESSION['pass-reset'] : ''; ?>
        </p>
        <p class="error">
            <?php echo in_array("Email or Password was incorrect.", $error) ? "<span>&#8594;</span> Email or Password was incorrect." : ""; ?>
        </p>
        <p class="error">
            <?php echo in_array("Sorry no user with your credentials exist in our DB.", $error) ? "<span>&#8594;</span> Sorry no user with your credentials exist in our database." : ""; ?>
        </p>
        <form action="#" method="POST">
            <div class="form-group">
                <label for="login_email">Email address</label>
                <input type="email" class="form-control" name="login_email" id="login_email" placeholder="Enter email">
            </div>
            <div class="form-group">
                <label for="login_password">Password</label>
                <input type="password" class="form-control" name="login_password" id="login_password" placeholder="Password">
            </div>
            <div class="form-actions text-center">
                <button type="submit" name="login_submit" class="btn btn-primary login_submit">Login</button>
                <p>
                    <a href="<?php echo url_for('views/auth/forgot_password.php'); ?>" id="forgot_password" class="forgot-password">Forgot your Password?</a>
                </p>
                <p>
                    <a href="#" id="signup" class="signup">Need an account? Register here!</a>
                </p>
            </div>
        </form>
    </div>

    <div class="register-form shadow-sm p-3 mb-5 bg-white rounded" id="register_form">
        <form action="#" method="POST">
            <div class="form-group">
                <label for="register_username">Username</label>
                <input type="text" class="form-control" name="register_username" id="register_username" placeholder="Enter username" value="<?php echo isset($_POST['register_username']) ? $_POST['register_username'] : ''; ?>">
                <p class="error">
                    <?php echo in_array("Your username must be between 2 and 25 characters.", $error) ? "<span>&#8594;</span> Your username must be between 2 and 25 characters." : ""; ?>
                </p>
            </div>
            <div class="form-group">
                <label for="register_email">Email address</label>
                <input type="email" class="form-control" name="register_email" id="register_email" aria-describedby="emailHelp" placeholder="Enter email" value="<?php echo isset($_POST['register_email']) ? $_POST['register_email'] : ''; ?>">
                <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                <p class="error">
                    <?php
                    if (in_array("Email already in use.", $error)) echo "<span>&#8594;</span> Email already in use.";
                    else if (in_array("Invalid format.", $error)) echo "<span>&#8594;</span> Invalid format.";
                    ?>
                </p>
            </div>
            <div class="form-group">
                <label for="register_password">Password</label>
                <input type="password" class="form-control" name="register_password" id="register_password" placeholder="Password">
                <p class="error">
                    <?php
                    if (in_array("Your password can only contain english characters or numbers.", $error)) echo "<span>&#8594;</span> Your password can only contain english characters or numbers.";
                    else if (in_array("Your password must be between 5 and 30 characters.", $error)) echo "<span>&#8594;</span> Your password must be between 5 and 30 characters.";
                    ?>
                </p>
            </div>
            <div class="form-group">
                <label for="register_password2">Confirm Password</label>
                <input type="password" class="form-control" name="register_password2" id="register_password2" placeholder="Confirm Password">
                <p class="error">
                    <?php echo in_array("Your passwords do not match.", $error) ? "<span>&#8594;</span> Your passwords do not match." : ""; ?>
                </p>
            </div>

            <div class="form-group">
                <p>Gender</p>
                <div class="form-check">
                    <label class="form-check-label">
                        <input type="radio" class="form-check-input" name="optradio" checked value="male">Male
                    </label>
                </div>
                <div class="form-check">
                    <label class="form-check-label">
                        <input type="radio" class="form-check-input" name="optradio" value="female">Female
                    </label>
                </div>
                <p class="error">
                    <?php echo in_array("You need to choose a gender.", $error) ? "<span>&#8594;</span> You need to choose a gender." : ""; ?>
                </p>
            </div>
            <hr>
            <div class="form-actions text-center">
                <button type="submit" name="register_submit" class="btn btn-primary register_submit">Register</button>
                <p>
                    <a href="#" id="signin" class="signin">Already have an account? Login Here!</a>
                </p>
            </div>
        </form>
    </div>
</div>

<?php include_once(SHARED_PATH . '/auth/auth_footer.php'); ?>