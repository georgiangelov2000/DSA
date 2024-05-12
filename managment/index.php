<?php
declare(strict_types=1);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require 'vendor/autoload.php';

// Set header for JSON response
header('Content-Type: application/json');

$requestMethod = $_SERVER["REQUEST_METHOD"];
$requestUri = $_SERVER["REQUEST_URI"];

// Remove query string from URI
$uri = parse_url($requestUri, PHP_URL_PATH);

// Define routes
$routes = [
    '/patients' => ['GET', 'App\Controllers\API\PatientController@index'],
    '/patients/create' => ['POST', 'App\Controllers\API\PatientController@create'],
    '/patients/calories' => ['GET', 'App\Controllers\API\PatientController@getCalories'],
    '/food_items/create' => ['POST', 'App\Controllers\API\FoodItemController@create'],
    '/food_items/delete' => ['POST', 'App\Controllers\API\FoodItemController@delete'],
    '/food_logs/create' => ['POST', 'App\Controllers\API\FoodLogController@create'],
    '/food_logs/delete' => ['POST', 'App\Controllers\API\FoodLogController@delete'],
    '/food_logs/update' => ['POST', 'App\Controllers\API\FoodLogController@update'],
    // Add more routes as needed
];

// Match the request method and URI to a route
$routeFound = false;
foreach ($routes as $route => $handler) {
    list($method, $callback) = $handler;
    if ($uri === $route && $requestMethod === $method) {
        $routeFound = true;
        list($controllerName, $method) = explode('@', $callback);
        $controller = new $controllerName();
        $controller->$method();
        break;
    }
}

// If no route found, return 404
if (!$routeFound) {
    http_response_code(404);
    echo json_encode(['error' => 'Not Found']);
}
?>
