<?php
header('Content-Type: application/json'); 
require_once '../config/db_connection.php';
require_once '../Model/TeacherModel.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {


    $id = $_POST['student_id'];
    
    $teacherModel = new TeacherModel($conn);
    $data = $teacherModel->getStudentDetailsById($id);

    if (!$data) {
        echo json_encode(['success' => false, 'message' => 'No data found']);
        exit();
    }
    echo json_encode(['success' => true, 'data' => $data]);
    exit();
}
echo json_encode(['success' => false, 'message' => 'Invalid request']);
exit();
?>