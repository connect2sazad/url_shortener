<?php

    session_start();

    require_once '../../constants.php';
    require_once ___ABS_PATH___.'config.php';

    $id = isset($_POST['id']) ? $_POST['id'] : '';
    $validity = isset($_POST['validity']) ? $_POST['validity'] : '';

    $query0 = "SELECT * FROM `redirects` WHERE `redirects`.`id` = $id;";
    $run_query0 = mysqli_query($conn, $query0);
    $fetch0 = mysqli_fetch_assoc($run_query0);
    $valid_from = $fetch0['valid_from'];
    $timestamp = strtotime($valid_from);
    $valid_till = $timestamp + ($validity * 24 * 60 * 60);
    $valid_till = date('Y-m-d H:i:s', $valid_till);

    $updated_by = $_SESSION[USER_GLOBAL_VAR];

    // $query = "UPDATE `redirects` SET `validity` = $validity WHERE `redirects`.`id` = $id;";
    $query = "UPDATE `redirects` SET `validity` = '$validity', `valid_till` = '$valid_till', `updated_by` = '$updated_by' WHERE `redirects`.`id` = $id;";
    $run_query = mysqli_query($conn, $query);

    if($run_query){
        echo json_encode(array('status' => 1));
    } else {
        echo json_encode(array('status' => 0));
    }

?>