<?php
header('Content-Type: application/json'); 
require_once '../config/db_connection.php';
require_once '../Model/UserModel.php';

if($_SERVER['REQUEST_METHOD'] === 'POST'){

    $accountID = $_POST['accountId'];

    $userModel = new UserModel($conn);
    $deleteQuery = $userModel->deleteAccount($accountID);

    if($deleteQuery)
    {
        echo json_encode([
            'success' => true,
            'message' => 'Successfully Deleted.',
        ]);
    }
    else{
        echo json_encode([
            'success' => false,
            'message' => 'Failed to delete the account',
        ]);
    }

    exit();
}

echo json_encode([
    'success' => false,
    'message' => 'Invalid Request.'
]);

exit();

?>