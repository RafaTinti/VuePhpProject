<?php
    class Customer{
        // DB properties
        private $conn;
        private $table = "customer";

        // customer properties
        public $ID;
        public $FirstName;
        public $LastName;
        public $DateOfBirth;
        public $Username;
        public $Password;

        // Constructor
        public function __construct($db) {
            $this->conn = $db;
        }


        // Get All Customers
        public function readAll(){
            $query = "SELECT * 
                    FROM {$this->table} 
                    ORDER BY ID DESC";

            $stmt = $this->conn->prepare($query);
            $stmt->execute();

            return $stmt;
        }

        // Get Single Customer
        public function read(){
            $query = "SELECT * 
                    FROM {$this->table} 
                    WHERE ID = :ID
                    LIMIT 0,1";
            
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam("ID", $this->ID);
            $stmt->execute();

            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            
            if($row){
                $this->FirstName = $row['FirstName'];
                $this->LastName = $row['LastName'];
                $this->DateOfBirth = $row['DateOfBirth'];
                $this->Username = $row['Username'];
                $this->Password = $row['Password'];
                return 0;
            }
            else{
                return "Customer not found";
            }
        }

        // Create
        public function create(){
            $query = "INSERT INTO {$this->table}
                SET 
                    FirstName = :FirstName,
                    LastName = :LastName,
                    DateOfBirth = :DateOfBirth,
                    Username = :Username,
                    Password = :Password";
            
            $stmt = $this->conn->prepare($query);

            // Sanitize data
            $this->FirstName = htmlspecialchars(strip_tags($this->FirstName));
            $this->LastName = htmlspecialchars(strip_tags($this->LastName));
            $this->DateOfBirth = htmlspecialchars(strip_tags($this->DateOfBirth));
            $this->Username = htmlspecialchars(strip_tags($this->Username));
            $this->Password = htmlspecialchars(strip_tags($this->Password));

            $stmt->bindParam(':FirstName', $this->FirstName);
            $stmt->bindParam(':LastName', $this->LastName);
            $stmt->bindParam(':DateOfBirth', $this->DateOfBirth);
            $stmt->bindParam(':Username', $this->Username);
            $stmt->bindParam(':Password', $this->Password);

            if($stmt->execute()){
                return false; //no errors
            }
            else{
                return $stmt->error;
            }
        }

        // Update
        public function update(){
            $query = "Update {$this->table}
                SET 
                    FirstName = :FirstName,
                    LastName = :LastName,
                    DateOfBirth = :DateOfBirth,
                    Username = :Username,
                    Password = :Password
                    WHERE ID = :ID";
            
            $stmt = $this->conn->prepare($query);

            // Sanitize data
            $this->FirstName = htmlspecialchars(strip_tags($this->FirstName));
            $this->LastName = htmlspecialchars(strip_tags($this->LastName));
            $this->DateOfBirth = htmlspecialchars(strip_tags($this->DateOfBirth));
            $this->Username = htmlspecialchars(strip_tags($this->Username));
            $this->Password = htmlspecialchars(strip_tags($this->Password));

            $stmt->bindParam(':FirstName', $this->FirstName);
            $stmt->bindParam(':LastName', $this->LastName);
            $stmt->bindParam(':DateOfBirth', $this->DateOfBirth);
            $stmt->bindParam(':Username', $this->Username);
            $stmt->bindParam(':Password', $this->Password);
            $stmt->bindParam(':ID', $this->ID);

            if($stmt->execute()){
                return false; //no errors
            }
            else{
                return $stmt->error;
            }
        }

        public function delete(){
            $query = "DELETE FROM {$this->table}
                      WHERE ID = :ID";

            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':ID', $this->ID);

            if($stmt->execute()){
                return false; //no errors
            }
            else{
                return $stmt->error;
            }
        }
    }