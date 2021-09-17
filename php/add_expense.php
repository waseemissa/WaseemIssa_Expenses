<?php
session_start();
require 'connection.php';

//$user_id = $_SESSION['user_id'];
$response = array();



 $amount = $_POST['amount'];

 $date = $_POST['date'];
 $date1=new DateTime($date);
 $final_date = $date1->format('Y-m-d');

 $user_id = $_POST['user_id'];
 $category_id = $_POST['id'];


 $query = "INSERT INTO expenses (user_id, category_id, amount, date) VALUES (?,?,?,?)";
 $stmt = $connection->prepare($query);
 $stmt->bind_param("iids", $user_id, $category_id, $amount, $final_date);
 $stmt->execute();
 $result = $stmt->get_result();

 if($result){
    $response["success"] = [
        "code" => 200,
        "message" => "Success"
    ];
}
 else{
    $response["error"] = [
        "code" => 400,
        "message" => "Fail"
    ];
 }

 echo json_encode($response, JSON_PRETTY_PRINT);


?>