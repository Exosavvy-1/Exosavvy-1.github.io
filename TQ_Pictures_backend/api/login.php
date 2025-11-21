<?php
session_start();
require '../db.php';
require '../helpers.php';

$conn = db_connect();
$username = $_POST['username'];
$password = $_POST['password'];

$stmt = $conn->prepare("SELECT id, password, role FROM users WHERE username = ?");
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 1) {
    $row = $result->fetch_assoc();
    if (password_verify($password, $row['password'])) {
        $_SESSION['user_id'] = $row['id'];
        $_SESSION['role'] = $row['role'];
        json_response(true, 'Login successful', ['role'=>$row['role']]);
    }
}
json_response(false, 'Invalid login');
?>