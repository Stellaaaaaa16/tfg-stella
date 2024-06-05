<?php
session_start();

$data = json_decode(file_get_contents('php://input'), true);
$response = ['success' => false];

if (isset($_SESSION['user_id'])) {
    $userId = $_SESSION['user_id'];
    $response['success'] = true;
} else {
    $response['success'] = false;
}

echo json_encode($response);

