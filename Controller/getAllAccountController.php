<?php
header('Content-Type: application/json');
require_once '../config/db_connection.php';
require_once '../Model/UserModel.php';

$userModel = new UserModel($conn);
$accounts = $userModel->getAllAccount();

echo json_encode(['data' => $accounts]);

