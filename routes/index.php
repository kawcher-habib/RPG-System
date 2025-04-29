<?php

require_once __DIR__ . '/../controllers/auth/AuthController.php';

use controllers\auth\AuthController; // it doesn't work


/**
 *  User Management [API]
 * 
 */

$method = $_SERVER['REQUEST_METHOD'];
$prefix = $_GET['prefix']; /** TODO: if prefix is empty? */
$authController = new AuthController();

if ($method == 'GET' && $prefix == 'users') {
    $authController->index();

} else if ($method == 'GET' && $prefix == 'logout') {
    $authController->logout();

} else if ($method == 'POST' && $prefix == 'login') {

    $requestBody = json_decode(
        file_get_contents('php://input'),
        true
    );

    $authController->login($requestBody);


} else if ($method == 'POST' && $prefix == 'registration') {

    $requestBody = json_decode(
        file_get_contents('php://input'),
        true
    );

    $authController->registration($requestBody);

} else if ($method == 'POST' && $prefix == 'edit') {
    $requestBody = json_decode(file_get_contents('php://input'), true);

    $authController->update($requestBody);

} else if($method == 'POST' && $prefix == 'delete'){
    $data = json_decode(file_get_contents('php://input'), true);
    $authController->destroy($data['email']);
} 
else {
    http_response_code(404);
    echo json_encode(['error' => 'Invalid route']);
}