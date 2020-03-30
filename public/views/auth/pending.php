<?php require_once('../../../private/initialize.php'); ?>

<?php include_once(SHARED_PATH . '/auth/auth_header.php'); ?>

<div class="container form-wrapper">
    <p>We sent an email to <b><?php echo $_GET['email']; ?></b> to help you recover your account.</p>

    <p>Please login into your email account and click on the link we sent to reset your password</p>
</div>

<?php include_once(SHARED_PATH . '/auth/auth_footer.php'); ?>