<?php
header('Content-Type: application/json');
require_once '../config/db_connection.php';
require_once '../Model/UserModel.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $username = $_POST['username'];
    $password = $_POST['password'];

    if (empty($username) || empty($password)) {
        
        echo json_encode(['success' => false, 'message' => 'Username and password are required']);
        exit();
    }   

    $userModel = new UserModel($conn);

    $user = $userModel->authenticateUser($username, $password);
    if ($user) {
        echo json_encode(['success' => true, 'message' => 'Login successful', 'token' => $user['token']]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Invalid username or password']);
    }
    exit();
}

echo json_encode(['success' => false, 'message' => 'Invalid request']);
exit();

?>
