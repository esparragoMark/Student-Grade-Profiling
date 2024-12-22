<?php
header('Content-Type: application/json'); 
require_once '../config/db_connection.php';
require_once '../Model/TeacherModel.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $edit_studentId = $_POST['studentID'];
    $edit_firstName = $_POST['edit_firstName'];
    $edit_lastName = $_POST['edit_lastName'];
    $edit_gender = $_POST['edit_gender'];
    $edit_LRN = $_POST['edit_LRN'];
    $edit_birthDate = $_POST['edit_birthDate'];
    $edit_contactNum = $_POST['edit_contactNum'];
    $edit_email = $_POST['edit_email'];
    $edit_subject = $_POST['edit_subject'];
    $edit_gradeLevel = $_POST['edit_gradeLevel'];
    $edit_section = $_POST['edit_section'];
    $edit_schoolYear = $_POST['edit_schoolYear'];
    
    $teacherModel = new TeacherModel($conn);
    $isEdited = $teacherModel->saveEditStdentInfo($edit_studentId, $edit_firstName, $edit_lastName, $edit_gender , $edit_LRN, $edit_birthDate , $edit_contactNum, $edit_email, $edit_subject, $edit_gradeLevel, $edit_section, $edit_schoolYear );

    if (!$isEdited) {
        echo json_encode(['success' => false, 'message' => 'Failed to Update!']);
        exit();
    }
    echo json_encode(['success' => true, 'message' => 'Successfully Updated. ']);
    exit();
}
echo json_encode(['success' => false, 'message' => 'Invalid request']);
exit();
?>