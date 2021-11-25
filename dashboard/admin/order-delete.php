<?php
// Initialize the session
session_start();

// Check if the user is logged in, if not then redirect him to login page
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: login.php");
    exit;
}

include_once "connection.php";

$id = $_GET['id'];
$sql="DELETE FROM orders where id=".$id;
mysqli_query($link,$sql);

header('Location:orders.php');


?>