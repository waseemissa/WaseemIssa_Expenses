<?php

require 'connection.php';

 $amount = $_POST['amount'];

 $date = $_POST['date'];
 $date1=new DateTime($date);
 $final_date = $date1->format('Y-m-d');

 $user_id = $_POST['user_id'];
 $category_id = $_POST['id'];
 $category_name = "";


 $query = "INSERT INTO expenses (user_id, category_id, amount, date) VALUES (?,?,?,?)";
 $stmt = $connection->prepare($query);
 $stmt->bind_param("iids", $user_id, $category_id, $amount, $final_date);
 $stmt->execute();
 $id = $stmt->insert_id;

 $query2 = "SELECT name From categories WHERE id = ?";
 $stmt2 = $connection->prepare($query2);
 $stmt2->bind_param("i", $category_id);
 $stmt2->execute();
 $result = $stmt2->get_result();
 if($row = $result->fetch_assoc()){
     $category_name = $row["name"];
 }




 $added_expense = array();
 $added_expense["id"] = $id;
 $added_expense["category"] = $category_name;
 $added_expense["amount"] = $amount;
 $added_expense["date"] = $final_date;

 $added_expense_json = json_encode($added_expense, JSON_PRETTY_PRINT);

 echo $added_expense_json;


?>