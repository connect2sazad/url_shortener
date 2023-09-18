<?php

    require_once '../../constants.php';
    require_once ___ABS_PATH___.'config.php';

    $id = isset($_POST['id']) ? $_POST['id'] : '';

    $query = "DELETE FROM `redirects` WHERE `redirects`.`id` = $id;";
    $run_query = mysqli_query($conn, $query);

    if($run_query){
        echo json_encode(array('status' => 1));
    } else {
        echo json_encode(array('status' => 0));
    }

?>