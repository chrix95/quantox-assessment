<?php
require "../bootstrap.php";
use Src\Controller\StudentController;

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: OPTIONS,GET,POST,PUT,DELETE");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$uri = explode( '/', $uri );

// all of our endpoints start with /person
// everything else results in a 404 Not Found
if ($uri[1] !== 'students') {
    header("HTTP/1.1 404 Not Found");
    echo "Entry URL is '/students'";
    exit();
}

// retrieve the student id and must be a number:
$userId = null;
if (isset($uri[2])) {
    $userId = (int) $uri[2];
} else {
    echo "User id is required";
    exit();
}

$requestMethod = $_SERVER["REQUEST_METHOD"];

// pass the request method and user ID to the PersonController and process the HTTP request:
$controller = new StudentController($dbConnection, $requestMethod, $userId);
$controller->processRequest();