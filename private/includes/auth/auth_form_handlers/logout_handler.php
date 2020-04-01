<?php 

unset($_SESSION['username']);
session_destroy();
redirect_to('../auth/auth.php');

?>