<?php
session_start();
header('Content-Type: application/json'); 
require_once '../config/db_connection.php';
require_once '../Model/TeacherModel.php';

if(isset($_SESSION['user_id'])){

    $id = $_SESSION['user_id'] ;

    $teacherModel = new TeacherModel($conn);
    $data = $teacherModel->retrieveUserData($id);

    if($data) {
        echo json_encode([
            'success' => true, 
            'data' => $data
        ]);
    } else {
        echo json_encode([
            'success' => false, 
            'message' => 'Failed to retrieve the data!'
        ]);
    }

    exit();
}

echo json_encode(['success' => false, 'message' => 'Invalid request']);
exit();
?>
