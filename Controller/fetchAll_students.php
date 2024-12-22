<?php
header('Content-Type: application/json'); 
require_once '../config/db_connection.php';
require_once '../Model/UserModel.php';

// Check if the request method is GET
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $userModel = new UserModel($conn);

    $data = $userModel->getAllStudent();

    if ($data) {
        echo json_encode([
            'success' => true, 
            'data' => $data
        ]);
        exit();
    } else {
        echo json_encode([
            'success' => false, 
            'message' => 'Failed to fetch students.'
        ]);
    }

    exit();
}

// Return an error response for invalid requests
echo json_encode([
    'success' => false, 
    'message' => 'Invalid request method.'
]);
exit();
?>