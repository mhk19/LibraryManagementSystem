<?php
    include_once("config.php");
    $query = "select * from books";
    $query1 = "select * from checkouts";
    $result = $conn->query($query);
    if(!$result){
        die('Could not get data'.mysqli_error());
    }
    $id= $_POST['id'];
    $enrollno= $_POST['enrollno'];
    $query2 = "INSERT INTO checkouts"."(bookId , EnrollNo)"."VALUES('$id', '$enrollno')";
    $result1 = $conn->query($query2);
    if(!$result1){
        die('Could not send data'.mysqli_error());
    }
?>