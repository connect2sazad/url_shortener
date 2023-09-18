<?php

require_once '../../constants.php';
require_once ___ABS_PATH___.'config.php';
require_once ___ABS_PATH___.'functions.php';
    
    $name = isset($_POST['name']) ? $_POST['name'] : '';
    $username = isset($_POST['username']) ? $_POST['username'] : '';
    $phone = isset($_POST['phone']) ? $_POST['phone'] : '';
    $phone = isset($_POST['phone']) ? $_POST['phone'] : '';
    $password = isset($_POST['password']) ? $_POST['password'] : '';

    $query = "INSERT INTO `users` (`full_name`, `username`, `password`, `email`, `phone`) VALUES ('$name', '$username', '".password_hash($password, PASSWORD_DEFAULT)."', '$email', '$phone');";
    $run_query = mysqli_query($conn, $query);

    if($run_query){
        session_start();
        $_SESSION[USER_GLOBAL_VAR] = $username;
        header('Location: ../');
    } else {
        echo "Unable to sign up";
    }
