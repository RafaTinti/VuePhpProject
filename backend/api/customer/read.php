<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json");

    include_once "../../config/Database.php";
    include_once "../../models/Customer.php";

    $requestMethod = $_SERVER['REQUEST_METHOD'];
    if($requestMethod == "GET"){
         // Database
        $database = new Database();
        $db = $database->connect();

        $customer = new Customer($db);
        $customer->ID = isset($_GET['id']) ? $_GET['id'] : null;

        if($customer->ID == null){
            echo json_encode([
                "status" => "400",
                "message" => "No ID given",
            ]);
        }
        else{
            $err = $customer->read();

            if($err){
                echo json_encode([
                    "status" => "500",
                    "message" => $err,
                ]);
            }
            else{
                $resArr = array();
                $resArr['data'] = [
                    "ID" => $customer->ID,
                    "FirstName" => $customer->FirstName,
                    "LastName" => $customer->LastName,
                    "DateOfBirth" => $customer->DateOfBirth,
                    "Username" => $customer->Username,
                    "Password" => $customer->Password,
                ];
                $resArr['status'] = '200';
            
                echo json_encode($resArr);
            }
        }
    } else{
        header("HTTP/1.0 405 Method now allowed");
        echo json_encode([
            "status" => "405",
            'message' => $requestMethod. ' Method now allowed',
        ]);
    }
   
    