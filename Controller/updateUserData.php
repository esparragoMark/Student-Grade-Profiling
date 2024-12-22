<?php
header('Content-Type: application/json');
require_once '../config/db_connection.php';

// Check if user is logged in
session_start();
if (!isset($_SESSION['user_id'])) {
    echo json_encode(['success' => false, 'message' => 'User not logged in']);
    exit();
}

// Get the user ID from session
$user_id = $_SESSION['user_id'];

// Get the updated data from the POST request
$name = isset($_POST['name']) ? $_POST['name'] : '';
$email = isset($_POST['email']) ? $_POST['email'] : '';
$password = isset($_POST['password']) ? $_POST['password'] : '';

// Simple validation
if (empty($name) || empty($email) || empty($password)) {
    echo json_encode(['success' => false, 'message' => 'All fields are required']);
    exit();
}

// Update user data in the database (no password hashing)
$query = "UPDATE users SET name = ?, username = ?, password = ? WHERE user_id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("sssi", $name, $email, $password, $user_id);

if ($stmt->execute()) {
    echo json_encode(['success' => true, 'message' => 'User data updated successfully']);
} else {
    echo json_encode(['success' => false, 'message' => 'Failed to update user data']);
}
?>
