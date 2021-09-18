<?php
require 'connection.php';
session_start();
header("Content-Type: JSON");


$user_id = $_GET['id'];
$response = array();
$i=0;

$query = "SELECT e.id AS id, e.user_id AS user_id, e.category_id AS category_id, e.amount AS amount, e.date AS date, c.name AS name FROM expenses e, categories c WHERE e.user_id = ? AND e.category_id = c.id AND e.user_id = c.user_id";
$stmt = $connection->prepare($query);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

while($row = $result->fetch_assoc()){

    $response[$i]['id'] = $row['id'];
    $response[$i]['user_id'] = $row['user_id'];
    $response[$i]['category'] = $row['name'];
    $response[$i]['amount'] = $row['amount'];
    $response[$i]['date'] = $row['date'];
    $i++;
}

echo json_encode($response, JSON_PRETTY_PRINT);


?>