<?php
header('Content-Type: application/json'); 
require_once '../config/db_connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET') {

    $query = "SELECT COUNT(*) AS totalStudent FROM students";

    $result = mysqli_query($conn, $query);

    if ($result) {
     
        $data = mysqli_fetch_assoc($result);
        echo json_encode([
            'success' => true,
            'data' => $data
        ]);
    } else {
    
        echo json_encode([
            'success' => false,
            'message' => 'Failed to fetch the data!'
        ]);
    }

    exit();
}

echo json_encode(['success' => false, 'message' => 'Invalid request']);
exit();
?>
