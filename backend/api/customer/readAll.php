<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json");
    header("Access-Control-Allow-Methods: POST, PUT, PATCH, GET, DELETE, OPTIONS");

    include_once "../../config/Database.php";
    include_once "../../models/Customer.php";

    $requestMethod = $_SERVER['REQUEST_METHOD'];
    if($requestMethod == "GET"){
        // Database
        $database = new Database();
        $db = $database->connect();

        $customer = new Customer($db);
        $result = $customer->readAll();
        $rowCount = $result->RowCount();

        if($rowCount > 0){
            $resArr = array();
            $resArr['data'] = array();
            $resArr['status'] = '200';
            $resArr["rowCount"] = $rowCount;

            // formats the response 
            while($row = $result->fetch(PDO::FETCH_OBJ)){
                $customer_item = [
                    "ID" => $row->ID,
                    "FirstName" => $row->FirstName,
                    "LastName" => $row->LastName,
                    "DateOfBirth" => $row->DateOfBirth,
                    "Username" => $row->Username,
                    "Password" => $row->Password,
                ];

                array_push($resArr['data'], $customer_item);
            }

            echo json_encode($resArr);
            
        } else{ 
            // no data found
            http_response_code(404);
            echo json_encode([
                "status" => "404",
                "message" => "No customers found",
            ]);

        }
    } else{
        header("HTTP/1.0 405 Method now allowed");
        http_response_code(405);
        echo json_encode([
            "status" => "405",
            'message' => $requestMethod. ' Method now allowed',
        ]);
    }
    