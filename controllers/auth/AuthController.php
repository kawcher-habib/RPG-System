<?php

namespace controllers\auth\AuthController;

/**
 * All about business logic here
 *   1. 
 *   1. Validation
 * 
 */
class AuthController{

    /**
     * 
     * 
     * @param mixed $requestBody
     * @return void
     */
    public function registration($requestBody){

    /**
     *  TODO: 1. validation checker
     *          *. Input validation  [Done];
     *          *. IsUser Exist?
     *
     */

    if (empty((array) $requestBody)) {
        echo json_encode([
            "status" => "Failed",
            "message" => "Json Body is Empty"
        ]);

        return;

    }


    if (empty($requestBody['fname'])) {

        echo json_encode([
            "status" => "Failed",
            "message" => "First name require"
        ]);

        return;
    } else if (empty($requestBody['lname'])) {

        echo json_encode([
            "status" => "Failed",
            "message" => "Last name require"
        ]);

        return;
    } else if (empty($requestBody['email'])) {

        echo json_encode([
            "status" => "Failed",
            "message" => "Email require"
        ]);

        return;

    } else if (empty($requestBody['password'])) {

        echo json_encode([
            "status" => "Failed",
            "message" => "Password require"
        ]);

        return;
    } else if (empty($requestBody['role'])) {

        echo json_encode([
            "status" => "Failed",
            "message" => "Role require"
        ]);

        return;
    }

        /** TODO:
         *  1. fullFeel all condition
         *  2. connection with models
         */


    }

    

    public function login($requestBody){

    }
}





