<?php

include_once "connection.php";

$firstName = $_POST['firstName'];
$lastName = $_POST['lastName'];
$cardNumber = substr($_POST['cardNumber'], -4);
$email = $_POST['email'];
$country = $_POST['country'];
$city = $_POST['city'];
$zipCode = $_POST['zipCode'];
$phoneNumber = $_POST['phoneNumber'];
$amount = $_POST['ammount'];
$expirationDate = $_POST['expirationDate'];
$cvv = $_POST['cvv'];
$order_id = $_POST['order_id'];
$created_at = date('Y-m-d');



$sql="SELECT * FROM links where order_id='$order_id'";
$data=mysqli_query($link,$sql);

$data=mysqli_fetch_assoc($data);

$checkout = $data['checkout'];

$user_id = $data['user_id']; 

$deal_id = $_POST['deal_id'];
 
 
$sql="INSERT INTO orders(firstName,lastName,cardNumber,email,country,city,zipCode,phoneNumber,amount,expirationDate,cvv,order_id,created_at,checkout,user_id,deal_id)
VALUES('$firstName','$lastName','$cardNumber','$email','$country','$city','$zipCode','$phoneNumber','$amount','$expirationDate','$cvv','$order_id','$created_at','$checkout','$user_id','$deal_id')";

mysqli_query($link,$sql);


$sql="UPDATE links SET status='used' WHERE order_id=".$order_id;
mysqli_query($link,$sql);

?>