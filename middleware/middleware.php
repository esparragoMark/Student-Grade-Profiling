<?php
require_once '../config/db_connection.php';
session_start();    

// Get token from the URL
if(isset($_GET['token'])){
        
    $getToken = $_GET['token'];


    $query = "SELECT * FROM users WHERE token = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('s', $getToken);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {

        $user = $result->fetch_assoc();
        
        $_SESSION['user_id'] = $user['user_id'];
        $_SESSION['user_name'] = $user['username'];
        $_SESSION['user_role'] = $user['role'];
        $_SESSION['user_token'] = $user['token'];

        header('Location: ../View/dashboard.php');

        exit();
    } else {
        header('Location: ../View/index.php');
        exit();
    }
}
?>