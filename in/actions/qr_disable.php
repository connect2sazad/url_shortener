<?php

session_start();

    require_once '../../constants.php';
    require_once ___ABS_PATH___.'config.php';

    $id = isset($_POST['id']) ? $_POST['id'] : '';

    $updated_by = $_SESSION[USER_GLOBAL_VAR];

    $query = "UPDATE `qrcodes` SET `is_active` = '0', `updated_by` = '$updated_by' WHERE `qrcodes`.`id` = $id;";
    $run_query = mysqli_query($conn, $query);

    if($run_query){
        echo json_encode(array('status' => 1));
    } else {
        echo json_encode(array('status' => 0));
    }

?>