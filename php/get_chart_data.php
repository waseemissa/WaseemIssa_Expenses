<?php
require 'connection.php';

$user_id = $_GET['id'];

$query = "SELECT c.name, SUM(e.amount) as total FROM expenses e, categories c WHERE c.user_id = e.user_id AND c.id = e.category_id AND e.user_id = ? GROUP BY c.id";
$stmt = $connection->prepare($query);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

$stats_array = [];
while($row = $result->fetch_assoc()){
    $stats_array[] = $row;
}

$stats_json = json_encode($stats_array, JSON_PRETTY_PRINT);
echo $stats_json;


?>