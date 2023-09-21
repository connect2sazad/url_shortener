<?php

session_start();

require_once "../../constants.php";
require_once ___ABS_PATH___.'config.php';
require_once ___ABS_PATH___.'functions.php';

$full_url = isset($_POST['full_url']) ? $_POST['full_url'] : '';

$ip = get_client_ip();

$query = "INSERT INTO `qrcodes` (`full_url`, `ip`, `created_by`, `updated_by`) VALUES ('$full_url', '$ip', '" . $_SESSION[USER_GLOBAL_VAR] . "', '" . $_SESSION[USER_GLOBAL_VAR] . "');";
$run_query = mysqli_query($conn, $query);

if($run_query){
    echo json_encode(array('status' => 1, 'message' => 'Success'));
} else {
    echo json_encode(array('status' => 0, 'message' => 'Failed'));
}