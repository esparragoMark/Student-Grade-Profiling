<?php
header('Content-Type: application/json');
require_once '../config/db_connection.php';

session_start();
if (!isset($_SESSION['user_id'])) {
    echo json_encode(['success' => false, 'message' => 'User not logged in']);
    exit();
}

$user_id = $_SESSION['user_id'];

if (isset($_FILES['image']) && $_FILES['image']['error'] === 0) {
    
    $file = $_FILES['image'];


    $uploadDirectory = '../assets/image/';
    $uploadPath = $uploadDirectory . basename($file['name']);
    
    // Move the uploaded file to the server
    if (move_uploaded_file($file['tmp_name'], $uploadPath)) {
        // Update image path in the database
        $query = "UPDATE users SET image = ? WHERE user_id = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("si", $uploadPath, $user_id);

        if ($stmt->execute()) {
            echo json_encode([
                'success' => true,
                'message' => 'Successfully Updated.',
                'data' => ['image' => $uploadPath]
            ]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Failed to update database']);
        }

        $stmt->close();
    } else {
        echo json_encode(['success' => false, 'message' => 'Failed to upload image']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'No image uploaded']);
}
?>
