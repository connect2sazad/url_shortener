<?php

    require_once "./db.php";

    if($conn = mysqli_connect(HOST, USER, PASSWORD)){
        if(!mysqli_select_db($conn, DB)){
            echo 'Error connecting to database!';
        }
    } else {
        echo "Error connecting to MySQL";
    }

?>