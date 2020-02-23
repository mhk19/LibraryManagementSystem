<?php
    include_once("config.php");
    $query = "select * from books";
    $result = $conn->query($query);
    if(!$result){
        die('Could not get data'.mysqli_error());
    }
    $enrollno = $_POST['enrollno'];
    $query1 = "select bookId from checkouts where EnrollNo='$enrollno' AND permission='1'";
    $result1 = $conn->query($query1);
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Client Page</title>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    </head>
<body>
    <table align="center" border="1px" style="width:300px; line-height:30px;">
        <tr>
            <th colspan="5"<h2>Book Record</h2></th>
        </tr>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Status</th>
            <th>User</th>
            <th>Checkout</th>
        </tr>
    <?php
        while($rows=$result->fetch_assoc())
        {
    ?>
        <tr>
            <td><?php echo $rows['id']?></td>
            <td><?php echo $rows['Name']?></td>
            <td><?php echo $rows['Status']?></td>
            <td><?php echo $rows['User']?></td>
            <?php
                if($rows['Status']=="Available"){
            ?>
            <td><button type="submit" onclick="sendId(<?php echo $rows['id']; ?>,<?php echo $enrollno; ?>)">Check-Out</button></td>
            <?php
                }
                ?>
        </tr>
    <?php
        }
    ?>
    </table><br><br><br>
    <table align="center" border="1px" style="width:300px; line-height:30px;">
    <tr>
            <th colspan="3"<h2>CheckedOut Books</h2></th>
        </tr>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Checkin</th>
        </tr>
    <?php
        
        
        if(!$result1){
            die('Could not get data'.mysqli_error());
        }
        while($rows2 = $result1->fetch_assoc()) {
            $query2 = "select * from books where id=".$rows2['bookId'];
            $result2 = $conn->query($query2);
            while($rows1=$result2->fetch_assoc()){
            ?>
            <tr>
            <td><?php echo $rows1['id']?></td>
            <td><?php echo $rows1['Name']?></td>
            <td><button type="submit" onclick="checkIn(<?php echo $rows1['id']; ?>,<?php echo $enrollno; ?>)">Check-In</button></td>
        </tr>
            <?php
            }
        }
        
    ?> 
    </table>
    <script>
        function sendId(id,enrollno){
            $.ajax({
                type: "post",
                url: "request.php",
                data: { id: id, enrollno: enrollno },
                success: function(response) {
                    // update ui
                    location.reload();
                }
            })
        }
        function checkIn(id,enrollno){
            $.ajax({
                type: "post",
                url: "delete.php",
                data: {id:id, enrollno: enrollno},
                success: function(response){
                    location.reload();    
                }
            })
        }
            
    </script>
    </body>
</html>