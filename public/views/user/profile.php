<?php require_once('../../../private/initialize.php'); ?>

<?php include_once(SHARED_PATH . '/auth/auth_form_handlers/profile_handler.php'); ?>

<?php include_once(SHARED_PATH . '/main_header.php'); ?>

<div class="m-3">
    <p><a href="<?php echo url_for('views/index.php') ?>">Main page</a> <span>&#8594;</span> Profile Settings</p>
</div>

<div class="shadow-lg p-3 mb-5 mt-3 bg-white rounded">
    <div class="text-center">
        <h2>Profile Section</h2>
        <small>Update your settings bellow</small>
    </div>

    <div class="update-form shadow-sm p-3 mb-5 bg-white rounded" id="update_form">
        <form action="#" method="POST">
            <div class="form-group">
                <label for="update_email">
                    <h3>Email address</h3>
                </label>
                <input type="email" class="form-control" name="update_email" id="update_email" placeholder="Enter email" value="<?php echo isset($existing_email) ? $existing_email : ''; ?>">
                <p class="error">
                    <?php
                    if (in_array("Invalid format.", $error)) echo "<span>&#8594;</span> Invalid format.";
                    ?>
                </p>
            </div>
            <hr>
            <div class="form-group">
                <h3>Gender</h3>
                <div class="form-check">
                    <label class="form-check-label">
                        <input type="radio" class="form-check-input" name="optradio" value="male" <?php echo $existing_gender == 'male' ? 'checked' : ''; ?>>Male
                    </label>
                </div>
                <div class="form-check">
                    <label class="form-check-label">
                        <input type="radio" class="form-check-input" name="optradio" value="female" <?php echo $existing_gender == 'female' ? 'checked' : ''; ?>>Female
                    </label>
                </div>
                <p class="error">
                    <?php echo in_array("You need to choose a gender.", $error) ? "<span>&#8594;</span> You need to choose a gender." : ""; ?>
                </p>
            </div>
            <hr>
            <div class="new-password">
                <a id="change-pass">Change Password</a>
                <div class="change-password" id="change-password">
                    <div class="form-group">
                        <label for="update_password">New Password</label>
                        <input type="password" class="form-control" name="update_password" id="update_password" placeholder="Password">
                        <p class="error">
                            <?php
                            if (in_array("Your password can only contain english characters or numbers.", $error)) echo "<span>&#8594;</span> Your password can only contain english characters or numbers.";
                            else if (in_array("Your password must be between 5 and 30 characters.", $error)) echo "<span>&#8594;</span> Your password must be between 5 and 30 characters.";
                            ?>
                        </p>
                    </div>
                    <div class="form-group">
                        <label for="update_password2">Confirm New Password</label>
                        <input type="password" class="form-control" name="update_password2" id="update_password2" placeholder="Confirm Password">
                        <p class="error">
                            <?php echo in_array("Your passwords do not match.", $error) ? "<span>&#8594;</span> Your passwords do not match." : ""; ?>
                        </p>
                    </div>
                </div>
            </div>
            <hr>
            <div class="close-acc">
                <a id="close-acc">Close Account</a>
                <div class="close-account" id="close-account">
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" id="close-account" name="close">
                        <label class="form-check-label" for="close-account">By checking you agree closing your account</label>
                        <p><small class="close-acc-info">You can reactivate it by login again.</small></p>
                    </div>
                </div>
            </div>

            <hr>
            <div class="form-actions text-center">
                <button type="submit" name="update_submit" class="btn btn-primary update_submit">Update</button>
            </div>
        </form>
    </div>
</div>

<?php include_once(SHARED_PATH . '/main_footer.php'); ?>