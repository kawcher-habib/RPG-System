<?php

namespace controllers\auth;
include_once __DIR__ . '/../../models/auth/AuthModel.php';

use Models\Auth\AuthModel;

/**
 * All about business logic here
 * 
 *   1. Validation
 *      1. input
 *      2. user exist 
 *      3. 
 * 
 */
class AuthController
{

    public $authModel;

    public function __construct()
    {
        $this->authModel = new AuthModel();
    }

    /**
     * Summary of index
     * @return void
     */
    public function index()
    {

        $usersData = $this->authModel->all();

        echo json_encode($usersData);
    }


    /**
     * 
     * 
     * @param mixed $requestBody
     * @return void
     */
    public function registration($requestBody)
    {

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

        $isUserExist = $this->authModel->isExist($requestBody['email']);


        if ($isUserExist != 0) {
            $this->authModel->create($requestBody);
        } else {
            echo json_encode([
                "status" => "error",
                "message" => "Email already exist"
            ]);
        }




    }


    /**
     * Summary of login
     * @param mixed $requestBody
     * @return void
     */
    public function login($requestBody)
    {
        /**
         *  Validation
         */

        if (empty($requestBody['email'])) {

            echo json_encode(['status' => "error", "message" => "Email required"]);
            return;

        } elseif (empty($requestBody['password'])) {

            echo json_encode(['status' => "error", "message" => "password required"]);
            return;
        }

        $data = $this->authModel->find($requestBody['email']);

        if ($data == null) {
            echo json_encode([
                "status" => "error",
                "message" => "User doesn't exist"
            ]);
            return;

        } else if ($data['password'] == $requestBody['password']) {

            session_start();

            $_SESSION['user_data'] = [
                $data['fname'],
                $data['lname'],
                $data['email'],
                $data['role']
            ];

            echo json_encode([
                "status" => "Success",
                "message" => "Login successful"
            ]);

        }


    }


    /**
     * Summary of logout
     * @return void
     */

    public function logout()
    {
        session_start();

        session_unset();

        session_destroy();

        echo json_encode([
            "status" => "Success",
            "message" => "Logout"
        ]);
    }


    /**
     * Summary of update
     * @param mixed $requestBody
     * @return void
     */
    public function update($requestBody)
    {

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
        } else if (empty($requestBody['role'])) {

            echo json_encode([
                "status" => "Failed",
                "message" => "Role require"
            ]);

            return;
        } else if (empty($requestBody['email'])) {

            echo json_encode([
                "status" => "Failed",
                "message" => "Email require"
            ]);

            return;

        }

        $mail = $requestBody['email'];

        $isUserExist = $this->authModel->isExist($mail);

        if ($isUserExist == 0) {

            $this->authModel->update($requestBody, $mail);

        } else {
            echo json_encode([
                "status" => "error",
                "message" => "User doesn't exist"
            ]);
        }


    }


}





