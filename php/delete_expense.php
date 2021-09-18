<?php

require 'connection.php';
$id = $_GET['id'];

$query = "DELETE FROM expenses WHERE id = ?";
$stmt = $connection->prepare($query);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

$response = array();
$response["id"] = $id;


$response_json = json_encode($response, JSON_PRETTY_PRINT);
echo $response_json;


?>