<?php

include "connection.php"; // Using database connection file here

$id = $_GET['id']; // get id through query string

$del = mysqli_query($link, "delete from user where id = '$id'"); // delete query

if ($del) {
    mysqli_close($link); // Close connection
    header("location:users-index.php"); // redirects to all records page
    exit;
} else {
    echo "Error deleting deal"; // display error message if not delete
}
