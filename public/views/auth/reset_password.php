<?php require_once('../../../private/initialize.php'); ?>

<?php include_once(SHARED_PATH . '/auth/auth_form_handlers/reset_password_handler.php'); ?>

<?php include_once(SHARED_PATH . '/auth/auth_header.php'); ?>

<div class="container form-wrapper">
    <div class="auth-header text-center">
        <h1>Password reset</h1>
    </div>

    <div class="reset-form shadow-sm p-3 mb-5 bg-white rounded" id="reset_form">
        <form action="#" method="POST">
            <div class="form-group">
                <label for="reset_password">New Password</label>
                <input type="password" class="form-control" name="reset_password" id="reset_password" placeholder="Password">
                <p class="error">
                    <?php
                    if (in_array("Your password can only contain english characters or numbers.", $error)) echo "<span>&#8594;</span> Your password can only contain english characters or numbers.";
                    else if (in_array("Your password must be between 5 and 30 characters.", $error)) echo "<span>&#8594;</span> Your password must be between 5 and 30 characters.";
                    ?>
                </p>
            </div>
            <div class="form-group">
                <label for="reset_password2">Confirm New Password</label>
                <input type="password" class="form-control" name="reset_password2" id="reset_password2" placeholder="Confirm Password">
                <p class="error">
                    <?php echo in_array("Your passwords do not match.", $error) ? "<span>&#8594;</span> Your passwords do not match." : ""; ?>
                </p>
            </div>
            <div class="form-actions text-center">
                <button type="submit" name="reset_current_pass" class="btn btn-primary reset_current_pass">Change Password</button>
                <p>
                    <a href="<?php echo url_for('views/auth/auth.php'); ?>" id="signup" class="signup">Return to Login form.</a>
                </p>
            </div>
        </form>
    </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
</body>

</html>