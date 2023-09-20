<?php
session_start();
require_once __DIR__.'/_.php';

try {

    //TODO: validate the user_name
    $db = _db(); //our connection to the db
    $query = $db->prepare('INSERT INTO 
                            users (user_id, user_name, user_last_name, user_phone_number) 
                            VALUES (null, :user_name, :user_last_name, :user_phone_number)');
                            
    //bind and prevent SQL injections
    $query->bindValue(':user_name', $_POST['user_name']);
    $query->bindValue(':user_last_name', $_POST['user_last_name']);
    $query->bindValue(':user_phone_number', $_POST['user_phone_number']);

    $query->execute(); //Same as saying go
    
    //Get the user's id
    $user_id = $db->lastInsertId();
    $_SESSION['user_id'] = $user_id;
    $_SESSION['user_phone_number'] = $user_phone_number;
    
    $data = [
        'user_api_key' => '777755a34b94256bb8aedcf1b575f287',
        'sms_to_phone' => '29172025',
        'sms_message' => 'Welcome to the system',
    ];
    
    $curl = curl_init('https://fiotext.com/send-sms');
    curl_setopt($curl, CURLOPT_POST, true);
    curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($data));
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($curl);
    curl_close($curl);
    echo $response;

    echo json_encode([
        'user_id' => (int)$user_id,
        'user_name' => $_POST['user_name'],
        'user_last_name' => $_POST['user_last_name'],
        'user_phone_number' => $_POST['user_phone_number']

    ]);
    
} catch (Exception $e) {
    http_response_code(400);
    echo json_encode(['info' => 'database error']);
}
