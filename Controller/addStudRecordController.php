<?php
header('Content-Type: application/json');
require_once '../config/db_connection.php';
require_once '../Model/TeacherModel.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    $quarter = $_POST['quarter'];
    $studentId = $_POST['studentId'];

    
    $teacherModel = new TeacherModel($conn);
    $isAdded = $teacherModel->addStudentRecord($studentId, $quarter);

    if (!$isAdded) {
        echo json_encode(['success' => false, 'message' => 'Failed to add a Student!']);
        exit();
    }

    echo json_encode(['success' => true, 'message' => 'Successfully Added']);
    exit();
}

echo json_encode(['success' => false, 'message' => 'Invalid Request']);
?>
