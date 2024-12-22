<?php
session_start();
header('Content-Type: application/json'); 
require_once '../config/db_connection.php';
require_once '../Model/TeacherModel.php';

if (isset($_SESSION['user_id'])) {

    $id = $_SESSION['user_id'];

    $school_year = isset($_POST['school_year']) ? $_POST['school_year'] : null ;
    $grade_level = isset($_POST['grade_level']) ? $_POST['grade_level'] : null ;
    $section = isset($_POST['section']) ? $_POST['section'] : null ;
    $class_name = isset($_POST['class_name']) ? $_POST['class_name'] :null ; 

    $teacherModel = new TeacherModel($conn);
    $data = $teacherModel->getStudentProfile($id, $school_year, $grade_level , $section, $class_name );

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
