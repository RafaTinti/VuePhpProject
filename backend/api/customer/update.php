<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json");
    header("Access-Control-Allow-Methods: PUT");
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

    include_once "../../config/Database.php";
    include_once "../../models/Customer.php";

    $requestMethod = $_SERVER['REQUEST_METHOD'];
    if($requestMethod == "PUT"){
        // Database
        $database = new Database();
        $db = $database->connect();

        $customer = new Customer($db);

        // get data from request
        $data = json_decode(file_get_contents("php://input"));

        // Validation

        $customer->ID = $data->ID;
        $customer->FirstName = $data->FirstName;
        $customer->LastName = $data->LastName;
        $customer->DateOfBirth = $data->DateOfBirth;
        $customer->Username = $data->Username;
        $customer->Password = $data->Password;

        $err = $customer->update();
        if($err){
            // error
            echo json_encode([
                "status" => "500",
                "message" => $err,
            ]);
        }
        else{
            // ok
            echo json_encode([
                "status" => "200",
                "message" => "Data updated",
            ]);
        }
    } else{
        header("HTTP/1.0 405 Method now allowed");
        echo json_encode([
            "status" => "405",
            'message' => $requestMethod. ' Method now allowed',
        ]);
    }
    
