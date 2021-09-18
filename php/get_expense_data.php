<?php
require "connection.php";
$id = $_GET["id"];
$category_name = "";


$query = "SELECT * FROM expenses WHERE id = ?";
$stmt = $connection->prepare($query);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();


$query2 = "SELECT name From categories WHERE id = ?";
$stmt2 = $connection->prepare($query2);
$stmt2->bind_param("i", $row["category_id"]);
$stmt2->execute();
$result2 = $stmt2->get_result();
if($row2 = $result2->fetch_assoc()){
    $category_name = $row2["name"];
}


$expense_data = array();
$expense_data["id"] = $row["id"];
$expense_data["user_id"] = $row["user_id"];
$expense_data["category_id"] = $row["category_id"];
$expense_data["amount"] = $row["amount"];
$expense_data["date"] = $row["date"];
$expense_data["category"] = $category_name;

$expense_data_json = json_encode($expense_data, JSON_PRETTY_PRINT);
echo $expense_data_json;


?>