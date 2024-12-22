<?php

header('Content-Type: application/json'); 
require_once '../config/db_connection.php';
require_once '../Model/TeacherModel.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (isset($_POST['studId'])) {

        $studentId = $_POST['studId'];

      
        $teacherModel = new TeacherModel($conn);

        $isdeleted = $teacherModel->deleteStudent($studentId);

        if ($isdeleted) {
            echo json_encode([
                'success' => true,
                'message' => "Successfully Deleted."
            ]);

            exit();
        } else {
            echo json_encode([
                'success' => false,
                'message' => 'Failed to delete, try Again!'
            ]);

            exit();
        }
    } else {
        echo json_encode([
            'success' => false,
            'message' => 'Missing student_id parameter.'
        ]);

        exit();
    }
}
echo json_encode(['success' => false, 'message' => 'Invalid Request']);
exit();
?>