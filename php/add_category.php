<?php
require 'connection.php';

$user_id = $_POST['user_id'];
$category_name = $_POST['name'];

$query = "INSERT INTO categories (name, user_id) VALUES (?,?)";
$stmt = $connection->prepare($query);
$stmt->bind_param("si", $category_name, $user_id);
$stmt->execute();
$id = $stmt->insert_id;

$category = array();
$category["id"] = $id;
$category["name"] = $category_name;

$category_json = json_encode($category, JSON_PRETTY_PRINT);

echo $category_json;


?>