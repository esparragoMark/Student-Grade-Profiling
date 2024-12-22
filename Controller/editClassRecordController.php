<?php

header('Content-Type: application/json');
require_once '../config/db_connection.php';
require_once '../Model/TeacherModel.php';

if($_SERVER['REQUEST_METHOD'] === 'POST'){

    $quarter =  $_POST['quarter'];
    $id = $_POST['studentID'];
    $ww1 = $_POST['ww1'];
    $ww2 = $_POST['ww2'];
    $ww3 = $_POST['ww3'];
    $ww4 = $_POST['ww4'];
    $ww5 = $_POST['ww5'];
    $ww6 = $_POST['ww6'];
    $ww7 = $_POST['ww7'];
    $ww8 = $_POST['ww8'];
    $ww9 = $_POST['ww9'];
    $ww10  = $_POST['ww10'];
    $wwTotal = $_POST['wwTotal'];
    $pt1  = $_POST['pt1'];
    $pt2  = $_POST['pt2'];
    $pt3  = $_POST['pt3'];
    $pt4  = $_POST['pt4'];
    $pt5  = $_POST['pt5'];
    $pt6  = $_POST['pt6'];
    $pt7  = $_POST['pt7'];
    $pt8  = $_POST['pt8'];
    $pt9  = $_POST['pt9'];
    $pt10 = $_POST['pt10'];
    $ptTotal = $_POST['ptTotal'];
    $quarterly_assessment = $_POST['quarterly_assessment'];
    $quarterly_grade = $_POST['quarterly_grade'];

    // calculate the total written works and performance tasks
    $totalww = $ww1 + $ww2 + $ww3 + $ww4 + $ww5 + $ww6 + $ww7 + $ww8 + $ww9 + $ww10;
    $totalpt = $pt1 + $pt2 + $pt3 + $pt4 + $pt5 + $pt6 + $pt7 + $pt8 + $pt9 + $pt10;

    $teacherModel = new TeacherModel($conn);
    $issUpdated = $teacherModel->editClassRecord($quarter,$id, $ww1, $ww2, $ww3,$ww4,$ww5,$ww6,$ww7,$ww8,$ww9,$ww10,$totalww,$pt1,$pt2,$pt3,$pt4,$pt5,$pt6,$pt7,$pt8,$pt9,$pt10,$totalpt,$quarterly_assessment,$quarterly_grade);
    
    if(!$issUpdated){
        echo json_encode(['success' => false, 'message' => 'Failed to update the Record']);
        exit();
    }

    echo json_encode(['success' => true, 'message' => 'Successfully Updated']);
    exit();
}

echo json_encode(['success' => false, 'message' => 'Invalid Request']);
exit();
?>