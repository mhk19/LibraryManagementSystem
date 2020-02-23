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
    $query2 = "DELETE FROM checkouts WHERE bookId='$id' AND EnrollNo='$enrollno'";
    $query4 = "UPDATE books SET Status='Available', User= null WHERE id='$id' ";
    $result1 = $conn->query($query2);
    $result2 = $conn->query($query4);
    if(!$result1){
        die('Could not send data'.mysqli_error());
    }
    if(!$result2){
        die('Could not send data'.mysqli_error());
    }
?>