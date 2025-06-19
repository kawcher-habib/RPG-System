<?php
namespace Models\Auth;
require_once __DIR__ . '/../../DB/index.php';

class AuthModel
{

    private $dataTable = "user";
    private $conn;

    public function __construct()
    {
        global $connection;
        $this->conn = $connection;
    }

    /**
     * Summary of all
     * @return void
     */

    public function all()
    {
        $query = "Select * from users";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $result = $stmt->get_result();

        $users = [];
        while ($row = $result->fetch_assoc()) {
            $users[] = $row;
        }
        return $users;
    }


    /**
     * Summary of find
     * @param mixed $id
     * @return void
     */
    public function find($id)
    {
        $queryBody = "SELECT * FROM users WHERE email=?";
        $stmt = $this->conn->prepare($queryBody);

        if (!$stmt) {
            die("Query preparation failed: " . $this->conn->error);
        }

        $stmt->bind_param('s', $id);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result) {
            return $result->fetch_assoc();
        } else {

            return $stmt->error;

        }


    }


    /**
     * Summary of create
     * @param mixed $requestBody
     * @return void
     */
    public function create($requestBody)
    {


        $queryBody = "INSERT INTO users(fname, lname, email, password, role)values(?,?,?,?,?)";
        $stmt = $this->conn->prepare($queryBody);

        if (!$stmt) {
            die("Query preparation failed: " . $this->conn->error);
        }

        $stmt->bind_param(
            "sssss",
            $requestBody['fname'],
            $requestBody['lname'],
            $requestBody['email'],
            $requestBody['password'],
            $requestBody['role']
        );

        if ($stmt->execute()) {
            echo json_encode([
                "status" => "Success",
                "message" => "User registered successfully"
            ]);
        } else {
            echo json_encode([
                "status" => "Failed",
                "message" => "Error: " . $stmt->error
            ]);
        }


    }


    /**
     * Summary of update
     * @param mixed $requestBody
     * @param mixed $id
     * @return void
     */

    public function update($requestBody, $id)
    {

        $queryBody = "UPDATE users SET fname=?, lname=?, `role`=? WHERE email=?";
        $stmt = $this->conn->prepare($queryBody);

        if (!$stmt) {
            die("Query preparation failed: " . $this->conn->error);
        }

        $stmt->bind_param(
            'ssss',
            $requestBody['fname'],
            $requestBody['lname'],
            $requestBody['role'],
            $id
        );


        if ($stmt->execute()) {
            echo json_encode([
                "status" => "Success",
                "message" => "User updated successfully"
            ]);
        } else {
            echo json_encode([
                "status" => "Failed",
                "message" => "Error: " . $stmt->error
            ]);
        }

    }


    /**
     * Summary of delete
     * @param mixed $id
     * @return void
     */
    public function delete($id)
    {
        $queryBody = "DELETE FROM users WHERE email=?";
        $stmt = $this->conn->prepare($queryBody);

        if (!$stmt) {
            die("Query preparation failed: " . $this->conn->error);
        }

        $stmt->bind_param('s', $id);

        if ($stmt->execute()) {
            echo json_encode([
                "status" => "Success",
                "message" => "User delete successfully"
            ]);
        } else {
            echo json_encode([
                "status" => "Failed",
                "message" => "Error: " . $stmt->error
            ]);
        }



    }

    /**
     *  Summary of siExist
     * @param mixed $prefix
     * @return void
     */

    public function isExist($prefix)
    {
        $queryBody = "SELECT email FROM users WHERE email=?";
        $stmt = $this->conn->prepare($queryBody);

        if (!$stmt) {

        }
        $stmt->bind_param('s', $prefix);
        $stmt->execute();
        $result = $stmt->get_result();


        return $result->num_rows > 0 ? 0 : 1;
    }


}