<?php
include_once("config.php");
$query = "select * from users";
$result = $conn->query($query);
if(!$result){
    die('could not get data'.mysqli_error());
}
echo "<!DOCTYPE html>
<html>
    <head>
        <title>Login</title>
        <script src='https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js'></script>
   </head>
   <body>
        <form method ='post' action='register.php'>
            <label for='username'>Username</label>
            <input type='text' id='username' name='username'><br>
            <label for='password'>Password</label>
            <input type='password' id='password' name='password'><br>
            <label for='enrollno'>Enrollment Number</label>
            <input type='text' id='enrollno' name='enrollno'><br><br>
            <button type='submit' align='center'>Register</button>
        </form>
        <h3>Already registered?</h3>
        <form method ='get' action='login.php'>
            <button type='submit' >Login</button>
        </form>
    </body>
</html>";
$username = $_POST['username'];
$password = $_POST['password'];
$enrollno = $_POST['enrollno'];
if($username && $password){
    $query2 = "select * from users where username='$username' and password= '$password'";
    $result2 = $conn->query($query2);
    $count = mysqli_num_rows($result2);
    if($count==1){
        $error = "User already exists";
    }
else{
     $query1 = "INSERT INTO users"."( username, password, enrollno)". "VALUES ('$username','$password','$enrollno')";
     $result1 = $conn->query($query1);
     header("location:client-homepage.php");
}
echo $error;
}
else

echo "Enter valid username and password";
}