<?php

require_once __DIR__ . '/../controllers/auth/AuthController.php';

use controllers\auth\AuthController; // it doesn't work


/**
 *  User Management [API]
 * 
 */

$method = $_SERVER['REQUEST_METHOD'];
$prefix = $_GET['prefix']; /** TODO: if prefix is empty? */
$auth = new AuthController();

if ($method == 'GET' && $prefix == 'users') {
    $auth->index();
} else if ($method == 'GET' && $prefix == 'login') {

    echo json_encode(['message' => "$prefix"]); // Test

} else if ($method == 'POST' && $prefix = 'registration') {

    $requestBody = json_decode(file_get_contents('php://input'), true);

    $auth->registration($requestBody);

} else {
    http_response_code(404);
    echo json_encode(['error' => 'Invalid route']);
}