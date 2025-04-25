<?php

 use controllers\auth\AuthController\AuthController; // it doesn't work
include_once('../controllers/auth/AuthController.php');

/**
 *  User Management [API]
 * 
 */

$method = $_SERVER['REQUEST_METHOD'];
$prefix = $_GET['prefix']; /** TODO: if prefix is empty? */
$auth = new AuthController();

if ($method == 'GET' && $prefix == 'login') {

    echo json_encode(['message' => "$prefix"]); // Test

} else if ($method == 'POST' && $prefix = 'registration') {

    $requestBody = json_decode(file_get_contents('php://input'), true);

    $auth->registration($requestBody);

}