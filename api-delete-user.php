<?php

session_start();
require_once __DIR__.'/_.php';

try {

    $db = _db(); //our connection to the db
    $query = $db->prepare('DELETE FROM users 
                            WHERE user_id = :user_id');

    $query->bindValue(':user_id', $_SESSION['user_id']);
    $query->execute(); //Same as saying go

    $deleted_rows = $query->rowCount();

    http_response_code(204);
    // echo json_encode(['info' => 'user_deleted']);
    
} catch (Exception $e) {
    http_response_code(400);
    echo json_encode(['info' => 'database error']);
}
