<?php

session_start();

// Check if the user is logged in, if not then redirect him to login page
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: login.php");
    exit;
}

include_once "connection.php";

$order_id = rand(1000000,9999999);
$tkn = md5(time());
$amount=$_GET['amount'];
$status="unused";
$checkout = $_GET['checkout'];

$user_id = $_SESSION['id'];
$deal_id = $_GET['deal_id'];

$sql="INSERT INTO links(order_id,tkn,amount,status,checkout,user_id,deal_id) VALUES('$order_id','$tkn','$amount','$status','$checkout','$user_id','$deal_id')";

mysqli_query($link,$sql);

echo json_encode(["order_id"=>$order_id,"tkn"=>$tkn,"amount"=>$amount,"status"=>$status]);


?>