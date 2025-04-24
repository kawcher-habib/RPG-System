<?php



/**
 *  User Management [API]
 * 
 */

$method = $_SERVER['REQUEST_METHOD'];
$prefix = $_GET['prefix']; /** TODO: if prefix is empty? */

if ($method == 'GET' && $prefix == 'login') {

    echo json_encode(['message' => "$prefix"]); // Test

} else if ($method == 'POST' && $prefix = 'registration') {
    /**
     *  TODO: 1. validation checker
     *          *. Input validation  [Done];
     *          *. IsUser Exist?
     *
     */

    $data = json_decode(file_get_contents('php://input'), true);

    if (empty((array) $data)) {
        echo json_encode([
            "status" => "Failed",
            "message" => "Json Body is Empty"
        ]);

        return;

    }

    if (empty($data->fname)) {

        echo json_encode([
            "status" => "Failed",
            "message" => "First name require"
        ]);

        return;
    } else if (empty($data->lname)) {

        echo json_encode([
            "status" => "Failed",
            "message" => "Last name require"
        ]);

        return;
    } else if (empty($data->email)) {

        echo json_encode([
            "status" => "Failed",
            "message" => "Email require"
        ]);

        return;

    } else if (empty($data->password)) {

        echo json_encode([
            "status" => "Failed",
            "message" => "Password require"
        ]);

        return;
    } else if (empty($data->role)) {

        echo json_encode([
            "status" => "Failed",
            "message" => "Role require"
        ]);

        return;
    }

    print_r($data);

}