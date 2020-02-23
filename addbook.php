<?php
include_once("config.php");
$query = "select * from books";
$result = $conn->query($query);
if(!$result){
    die('Could not get data'.mysqli_error());
}
$bookName = $_POST['bname'];
$bookStatus = "Available";
$query1 = "INSERT INTO books"."( Name, Status)". "VALUES ('$bookName','$bookStatus')";
$result1 = $conn->query($query1);
if(!$result1){
    die('Could not send data'.mysqli_error());
}
header("location:admin.php");
?>
