<?php
require 'connection.php';

$id = $_POST['id'];
$user_id = $_POST['user_id'];
$category_id = $_POST['category_id'];
$amount = $_POST['amount'];
$date = $_POST['date'];
$date1=new DateTime($date);
$final_date = $date1->format('Y-m-d');
$category_name = "";


$query = "UPDATE expenses SET category_id = ?, amount = ?, date = ? WHERE id = ? AND user_id = ?";
$stmt = $connection->prepare($query);
$stmt->bind_param("idsii", $category_id, $amount, $final_date, $id, $user_id);
$stmt->execute();
$result = $stmt->get_result();

$query2 = "SELECT name from categories WHERE id = ?";
$stmt2 = $connection->prepare($query2);
$stmt2->bind_param("i", $category_id);
$stmt2->execute();
$result2 = $stmt2->get_result();
if($row = $result2->fetch_assoc()){
    $category_name = $row["name"];
};


$updated_expense = array();
$updated_expense["id"] = $id;
$updated_expense["user_id"] = $user_id;
$updated_expense["category_id"]= $category_id;
$updated_expense["category_name"]= $category_name;
$updated_expense["amount"] = $amount;
$updated_expense["date"] = $final_date;

$updated_expense_json = json_encode($updated_expense, JSON_PRETTY_PRINT);
echo $updated_expense_json;





?>