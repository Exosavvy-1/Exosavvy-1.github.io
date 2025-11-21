<?php
session_start();
require '../db.php';
require '../helpers.php';

require_admin($_SESSION);
$conn = db_connect();

$user_id = $_POST['user_id'];
$file = $_FILES['image'];

if (!isset($file)) json_response(false, 'Image required');

$ext = pathinfo($file['name'], PATHINFO_EXTENSION);
$filename = uniqid() . "." . $ext;
$path = '../uploads/' . $filename;

if (move_uploaded_file($file['tmp_name'], $path)) {
    $stmt = $conn->prepare("INSERT INTO images (filename, uploaded_for, uploaded_by) VALUES (?, ?, ?)");
    $stmt->bind_param("sii", $filename, $user_id, $_SESSION['user_id']);
    $stmt->execute();
    json_response(true, 'Image uploaded successfully');
}
json_response(false, 'Failed to save image');
?>