<?php

class UserModel {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function authenticateUser($username, $password) {
        $query = "SELECT token FROM users WHERE username = ? AND password = ? LIMIT 1";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param('ss', $username, $password);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows === 1) {
            $user = $result->fetch_assoc();
            return ['token' => $user['token']];
        }
        return false;
    }

    public function addAccount($name, $email, $password, $role, $token){
        $query = "INSERT INTO users (name, username, password, role, token) 
                  VALUES (?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($query);
        if ($stmt === false) {
            return false;
        }
        $stmt->bind_param('sssss', $name, $email, $password, $role, $token);
    
        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    public function getAllAccount(){
        $account = "SELECT * FROM users";
        $stmt = $this->conn->query($account);
        $result = $stmt->fetch_all(MYSQLI_ASSOC);
        return $result;
    }

    public function deleteAccount($accountId){
        $deleteQuery = "DELETE FROM users WHERE user_id = '$accountId'";
        $stmt = $this->conn->query($deleteQuery);
        return $this->conn->affected_rows > 0;
    }
 
    public function getAllStudent() {
        $getAll = "SELECT * FROM students"; // Query to fetch all students
    
        $result = $this->conn->query($getAll);

        if ($result) {
            $data = $result->fetch_all(MYSQLI_ASSOC); 
            return $data;
        } else {
            return [];
        }
    }
    
}

?>
