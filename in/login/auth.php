<?php

    require_once '../../constants.php';
    require_once ___ABS_PATH___.'config.php';
    require_once ___ABS_PATH___.'functions.php';

    $username = isset($_POST['username']) ? test_input($_POST['username']) : '';
    $password = isset($_POST['password']) ? $_POST['password'] : '';
    $r = isset($_POST['r']) ? $_POST['r'] : '';

    $res = login($conn, $username, $password);

    if(@$res['status'] == 'success'){
        if($r!=''){
            header('location: '.$r);
        }
        header('location: ../create-short-url');
    } else {
        echo 'Incorrect Credentials. Please try again <a href="./">Go back</a>';
    }

?>