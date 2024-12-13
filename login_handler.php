<?php
session_start();

header('Content-Type: application/json');

$static_username = "admin";
$static_password = "admin123";


$response = ['success' => false, 'message' => 'Invalid request'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = trim($_POST['password'] ?? '');

    if (empty($username) || empty($password)) {
        $response['message'] = 'All fields are required.';
    } elseif ($username === $static_username && $password === $static_password) {
        $_SESSION['logged_in'] = true;
        $_SESSION['username'] = $username;
        $response['success'] = true;
        $response['message'] = 'Login successful.';
    } else {
        $response['message'] = 'Invalid credentials.';
    }
}

echo json_encode($response);
