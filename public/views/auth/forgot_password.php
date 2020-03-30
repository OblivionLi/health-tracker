<?php require_once('../../../private/initialize.php'); ?>

<?php include_once(SHARED_PATH . '/auth/auth_form_handlers/forgot_password_handler.php'); ?>

<?php include_once(SHARED_PATH . '/auth/auth_header.php'); ?>

<div class="container form-wrapper">
    <div class="auth-header text-center">
        <h1>Password reset</h1>
    </div>

    <div class="reset-form shadow-sm p-3 mb-5 bg-white rounded" id="reset_form">
        <p class="error">
            <?php
            if (in_array("Email field is required.", $error)) echo "<span>&#8594;</span> Email field is required.";
            else if (in_array("Invalid format.", $error)) echo "<span>&#8594;</span> Invalid format.";
            else if (in_array("Sorry, no user exist associated with this email.", $error)) echo "<span>&#8594;</span> Sorry, no user exist associated with this email.";
            ?>
        </p>
        <form action="#" method="POST">
            <div class="form-group">
                <label for="reset_email">Email address</label>
                <input type="email" class="form-control" name="reset_email" id="reset_email" placeholder="Enter email">
            </div>
            <div class="form-actions text-center">
                <button type="submit" name="reset_submit" class="btn btn-primary reset_submit">Rest Password</button>
                <p>
                    <a href="<?php echo url_for('views/auth/auth.php'); ?>" id="signin" class="signin">Return to Login form.</a>
                </p>
            </div>
        </form>
    </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
</body>

</html>