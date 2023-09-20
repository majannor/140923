<?php

session_start();
echo $_SESSION['user_id'];
exit();

require_once __DIR__.'/_.php';

try {
    $db = _db(); //connection to the db
    $query = $db->prepare(
        'UPDATE users
         SET user_name = :user_name, user_last_name = :user_last_name
         WHERE user_id = :user_id'
    );

    $query->bindValue(':user_name', $_POST['user_name']);
    $query->bindValue(':user_last_name', $_POST['user_last_name']);
    $query->bindValue(':user_id', $_SESSION['user_id']);
    $query->execute(); //Same as saying go
    $counter = $query->rowCount();

    echo json_encode(['info'=>'user updated']);
   
} catch (Exception $e) {
    http_response_code(400);
    echo json_encode(['info' => 'database error']);
}
