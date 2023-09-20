<?php
require_once __DIR__.'/_.php';

try {

    $db = _db(); //our connection to the db
    $query = $db->prepare('SELECT * FROM users');
    $query->execute(); //Same as saying go
    $users = $query->fetchAll();
    echo json_encode($users);
    
} catch (Exception $e) {
    http_response_code(400);
    echo json_encode(['info' => 'database error']);
}
