<?php
require 'connection.php';
session_start();
header("Content-Type: JSON");


$user_id = $_SESSION['user_id'];
$response = array();
$i=0;

$query = "SELECT id, name FROM categories  WHERE user_id = ?";
$stmt = $connection->prepare($query);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

while($row = $result->fetch_assoc()){

    $response[$i]['category_id'] = $row['id'];
    $response[$i]['category_name'] = $row['name'];
    $i++;
}

echo json_encode($response, JSON_PRETTY_PRINT);


?>