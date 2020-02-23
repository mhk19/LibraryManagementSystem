<?php
include_once("config.php");
$query = "select * from books";
$result = $conn->query($query);
if(!$result){
    die('Could not get data'.mysqli_error());
}
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Admin Page</title>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    </head>
<body>
    <table align="center" border="1px" style="width:300px; line-height:30px;">
        <tr>
            <th colspan="4"<h2>Book Record</h2></th>
        </tr>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Status</th>
            <th>User</th>
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
        </tr>
    <?php
        }
    ?>
    </table><br><br><br>
    <div>
    <form method = 'POST' action='addbook.php'>
            <label for ='bname'>Book Name:</label><br>
            <input type='text' id='bname' name='bname'><br><br>
            <button type="submit" align="center">Add Book</button>
    </form>
    </div>
    <table align="center" border="1px" style="width:300px; line-height:30px;">
        <tr>
            <th colspan="4"<h2>Checkout Requests</h2></th>
        </tr>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>User</th>
            <th>Allow</th>
        </tr>
        <?php
        $query1 = "select bookId,EnrollNo from checkouts where permission='0'";
        $result1 = $conn->query($query1);
        
        if(!$result1){
            die('Could not get data'.mysqli_error());
        }
        while($rows2 = $result1->fetch_assoc()) {
            $query2 = "select * from books where id=".$rows2['bookId'];
            $result2 = $conn->query($query2);
            // echo $id;
            while($rows1=$result2->fetch_assoc()){
            ?>
            <tr>
            <td><?php echo $rows1['id']?></td>
            <td><?php echo $rows1['Name']?></td>
            <td><?php echo $rows2['EnrollNo']?></td>
            <td><button type="submit" onclick="sendId(<?php echo $rows1['id']; ?>,<?php echo $rows2['EnrollNo']; ?>)">Allow</button></td>
        </tr>
            <?php
            }
        }
        
    ?> 
    </table><br><br><br>
    <table align="center" border="1px" style="width:300px; line-height:30px;">
        <tr>
            <th colspan="4"<h2>Checkin Requests</h2></th>
        </tr>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>User</th>
            <th>Allow</th>
        </tr>
        <?php
        $query3 = "select bookId from checkouts where permission='2'";
        $result5 = $conn->query($query3);
        
        if(!$result5){
            die('Could not get data'.mysqli_error());
        }
        while($rows3 = $result5->fetch_assoc()) {
            $query4 = "select * from books where id=".$rows3['bookId'];
            $result6 = $conn->query($query4);
            while($rows4=$result6->fetch_assoc()){
            ?>
            <tr>
            <td><?php echo $rows4['id']?></td>
            <td><?php echo $rows4['Name']?></td>
            <td><?php echo $rows4['User']?></td>
            <td><button type="submit" onclick="checkIn(<?php echo $rows4['id']; ?>,<?php echo $rows4['User']; ?>)">Allow</button></td>
        </tr>
            <?php
            }
        }
        
    ?> 
    </table><br><br><br>
    <script src = "script.js"></script>
    <script>
        function sendId(id,enrollno){
            $.ajax({
                type: "post",
                url: "allow-checkout.php",
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
                url: "allow-checkin.php",
                data: {id:id, enrollno: enrollno},
                success: function(response){
                    location.reload();    
                }
            })
        }
            
    </script>
</body>
</html>
