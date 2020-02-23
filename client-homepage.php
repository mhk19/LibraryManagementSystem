<?php
    include_once("config.php");
    echo 
    "<html>
        <title>Student Page</title>
        <body>
            <form method = 'POST' action = 'client.php'>
                <label for = 'enrollno'>Your Enrollment Number:</label><br>
                <input type = 'text' id = 'enrollno' name = 'enrollno'><br><br>
                <button type ='submit'  >Submit</button> 
            </form>   
        </body>
    </html>";