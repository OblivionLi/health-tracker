<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
<script src="<?php echo url_for('/assets/js/register.js'); ?>"></script>

<?php

if (isset($_POST['register_submit'])) {
    echo '
            <script>
                $(document).ready(function() {
                    $("#login_form").hide();
                    $("#register_form").show();
                });
            </script>
        ';
}

?>
</body>
</html>