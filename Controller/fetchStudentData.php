<?php
session_start();
header('Content-Type: application/json'); 
require_once '../config/db_connection.php';
require_once '../Model/TeacherModel.php';

if (isset($_SESSION['user_id'])){

    $user_id = $_SESSION['user_id'];
    $school_year = $_POST['school_year'];
    $grade_level = $_POST['grade_level'];
    $section = $_POST['section'];
    $class_name = $_POST['subject'];
    $quarter = $_POST['quarter'];
    


    $teacherModel = new TeacherModel($conn);

    $data = $teacherModel->fetchStudentData($user_id,$school_year,$grade_level,$section,$class_name,$quarter);

    if (!$data) {
        echo json_encode(['success' => false, 'message' => 'No Student Data!']);
        exit();
    }

    echo json_encode(['success' => true, 'message' => 'Retrieving Data', 'data' => $data]);
    exit();
}

echo json_encode(['success' => false, 'message' => 'Invalid request']);
exit();

?>
