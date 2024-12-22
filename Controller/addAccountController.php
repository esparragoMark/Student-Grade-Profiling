<?php
header('Content-Type: application/json'); 
require_once '../config/db_connection.php';
require_once '../Model/UserModel.php';

if($_SERVER['REQUEST_METHOD'] === 'POST'){

    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $password = htmlspecialchars($_POST['password']);
    $role = htmlspecialchars($_POST['userRole']);

    // Generate and hash token
    $token = bin2hex(random_bytes(16));
    $token_hash = hash("sha256", $token);

    if(empty($name) || empty($email) || empty($password) || empty($role)) {
        echo json_encode([
            'success' => false,
            'message' => "Please fill all the input fields!"
        ]);
        exit();
    }

    $userModel = new UserModel($conn);
    $isAdded = $userModel->addAccount($name, $email, $password, $role, $token_hash);

    if($isAdded) {
        echo json_encode([
            'success' => true, 
            'message' => 'Successfully added the account.'
        ]);
    } else {
        echo json_encode([
            'success' => false, 
            'message' => 'Failed to add the account.'
        ]);
    }

    exit();
}

echo json_encode(['success' => false, 'message' => 'Invalid request']);
exit();
?>
