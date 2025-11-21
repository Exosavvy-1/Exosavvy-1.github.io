<?php
session_start();
require '../db.php';
require '../helpers.php';
$conn = db_connect();

if (!isset($_SESSION['user_id'])) json_response(false, 'Not logged in');

$stmt = $conn->prepare("SELECT filename FROM images WHERE uploaded_for = ?");
$stmt->bind_param("i", $_SESSION['user_id']);
$stmt->execute();
$result = $stmt->get_result();

$images = [];
while ($row = $result->fetch_assoc()) {
    $images[] = '/uploads/' . $row['filename'];
}

json_response(true, 'Images retrieved', $images);
?>