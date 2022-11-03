<?php
    
    //CONNECT TO MYSQL DATABASE USING MYSQLI
    $con = mysqli_connect("localhost","root","","scrum_board");

    if(!$con){
        die("Connection Error");
        }

?>