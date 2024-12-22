<?php

header('Content-Type: application/json'); 
require_once '../config/db_connection.php';
require_once '../Model/TeacherModel.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (isset($_POST['student_id'])) {
        $studentId = $_POST['student_id'];

      
        $teacherModel = new TeacherModel($conn);

        $analyticsData = $teacherModel->getStudentAnalytics($studentId);

        if ($analyticsData) {
            echo json_encode([
                'success' => true,
                'data' => $analyticsData
            ]);
        } else {
            echo json_encode([
                'success' => false,
                'message' => 'No data found for the selected student.'
            ]);
        }
    } else {
        echo json_encode([
            'success' => false,
            'message' => 'Missing student_id parameter.'
        ]);
    }
}

?>
