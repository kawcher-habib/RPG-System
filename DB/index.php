<?php
    require_once __DIR__ . '/../vendor/autoload.php';

    use Dotenv\Dotenv;
    $dotenv = Dotenv::createImmutable(__DIR__ . '/../');
    $dotenv->load();

    $db_host = $_ENV['DB_HOST'];
    $db_user = $_ENV['DB_USERNAME'];
    $db_password = $_ENV['DB_PASSWORD'];
    $db_database = $_ENV['DB_DATABASE'];


    $connection = new mysqli($db_host, $db_user, $db_password, $db_database);

    if($connection->connect_error){
        /**
         * TODO: error handling properly both side 
         *  1. using log
         */

         die('Connection failed: '. $connection->connect_error);
    }else{
        // echo "DB connected";
    }





?>