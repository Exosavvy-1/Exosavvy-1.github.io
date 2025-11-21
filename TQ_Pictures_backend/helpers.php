<?php
function json_response($status, $message, $data = null) {
    echo json_encode(['status'=>$status,'message'=>$message,'data'=>$data]);
    exit;
}
function require_admin($session) {
    if (!isset($session['role']) || $session['role'] !== 'admin') {
        json_response(false, 'Access denied: admin only');
    }
}
?>