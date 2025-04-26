<?php
namespace Models\Auth;
require_once __DIR__ . '/../../DB/index.php';

class AuthModel
{

    private $dataTable = "user";
    private $conn;

    public function __construct(){
        global $connection;
        $this->conn = $connection;
    }

    /**
     * Summary of all
     * @return void
     */

    public function all()
    {
        $query = "Select * from user";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $result = $stmt->get_result();

       $users = [];
        while($row = $result->fetch_assoc()){
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

        if(!$stmt){
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

        if($stmt->execute()){
            echo json_encode([
                "status"=>"Success",
                "message"=> "User registered successfully"
            ]);
        }else{
            echo json_encode([
                "status"=>"Failed",
                "message" => "Error: ". $stmt->error
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

    }


    /**
     * Summary of delete
     * @param mixed $id
     * @return void
     */
    public function delete($id)
    {

    }

    /**
     *  Summary of siExist
     * @param mixed $prefix
     * @return void
     */

    public function isExist($prefix)
    {

    }
}