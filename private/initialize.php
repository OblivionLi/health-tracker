<?php 

// Start output buffering
ob_start();

// Start Sessions
session_start();

// Define variables that will help with authorization, separating private folder from public folder
// Ex: instead of required_once("../../example.php") the secure url will be required_once(SHARED_PATH . "example.php")
define('PRIVATE_PATH', dirname(__FILE__));
define('PROJECT_PATH', dirname(PRIVATE_PATH));
define('PUBLIC_PATH', PROJECT_PATH . '/public');
define('SHARED_PATH', PRIVATE_PATH . '/includes');

// Get url root to make it easier to link files
$public_end = strpos($_SERVER['SCRIPT_NAME'], '/public') + 7;
$doc_root = substr($_SERVER['SCRIPT_NAME'], 0, $public_end);
define('WWW_ROOT', $doc_root);

// Required files that can be used everywhere in the project
require_once ('config/functions.php');

// Require all class files to this file 'initialize.php' so that you don't need to link class files in every view pages
// you will only require to link this file to all view pages (all it does is autoload classes)
foreach (glob('models/*.php') as $file) {
    require_once ('$file');
}

// find all classes in the models folder and autoload it
function my_autoload($class) {
    if (preg_match('/\A\w+\Z/', $class)) {
        include ('models/' . $class . '.php');
    }
}

spl_autoload_register('my_autoload');

// Instantiate DB & connect
$database = new Database();
$db = $database->connect();

