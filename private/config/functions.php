<?php 

// create function that uses WWW_ROOT global variable from initialize.php file
function url_for($string_path) {
    if ($string_path[0] != '/') {
        $string_path = '/' . $string_path;
    }

    return WWW_ROOT . $string_path;
}

// Shortcut for htmlspecialchars function
function h($string) {
    return htmlspecialchars($string);
}

// Shortcut for strip_tags function
function st($string) {
    return strip_tags($string);
}

// Check if form is post request
function is_post_request() {
    return $_SERVER['REQUEST_METHOD'] === "POST";
}

// Check if form is get request
function is_get_request() {
    return $_SERVER['REQUEST_METHOD'] === "GET";
}

// Shortcut for header redirect
function redirect_to($location) {
    header('Location: ' . $location);
}

// Check if $_SESSION['username'] is set
function is_logged() {
    if (isset($_SESSION['username'])) {
        return true;
    } else {
        redirect_to('/health-tracker/public/views/auth/auth.php');
    }
}