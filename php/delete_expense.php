<?php

require 'connection.php';
$id = $_GET['id'];
$response = array();
header("Content-Type: JSON");

$query = "DELETE FROM expenses WHERE id = ?";
$stmt = $connection->prepare($query);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

if($result){
    $response = [
        "code" => 200,
        "message" => "Success"
    ];
}
else{
    $response = [
        "code" => 400,
        "message" => "Fail"
    ];
}

echo json_encode($response, JSON_PRETTY_PRINT);





?>