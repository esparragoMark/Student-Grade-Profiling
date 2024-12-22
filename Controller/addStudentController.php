<?php
session_start();
header('Content-Type: application/json'); 
require_once '../config/db_connection.php';
require_once '../Model/TeacherModel.php';

if(isset($_SESSION['user_id'])){

    $fname = htmlspecialchars($_POST['fname']);
    $lname = htmlspecialchars($_POST['lname']);
    $gender = htmlspecialchars($_POST['gender']);
    $lrn = htmlspecialchars($_POST['lrn']);
    $email = $_POST['email'];
    $birthdate = $_POST['birthdate'];
    $contactNo = htmlspecialchars($_POST['contactNo']);
    $className = htmlspecialchars($_POST['className']);
    $gradeLevel = $_POST['gradeLevel'];
    $section = htmlspecialchars($_POST['section']);
    $schoolyear = $_POST['schoolyear'];
    $userId = $_SESSION['user_id'];


    $teacherModel = new TeacherModel($conn);
    $isAdded = $teacherModel->addStudent($fname, $lname, $gender, $lrn, $birthdate, $contactNo, $email, $className, $gradeLevel, $section, $schoolyear, $userId);

    if($isAdded) {
        echo json_encode([
            'success' => true, 
            'message' => 'Successfully added the student.'
        ]);
    } else {
        echo json_encode([
            'success' => false, 
            'message' => 'Failed to add the student.'
        ]);
    }

    exit();
}

echo json_encode(['success' => false, 'message' => 'Invalid request']);
exit();
?>
