<?php

    require_once '../../constants.php';
    require_once ___ABS_PATH___.'config.php';
    require_once ___ABS_PATH___.'functions.php';


    $id = isset($_POST['id']) ? $_POST['id'] : '';
    $full_name = isset($_POST['full_name']) ? $_POST['full_name'] : '';
    $phone = isset($_POST['phone']) ? $_POST['phone'] : '';
    $address = isset($_POST['address']) ? $_POST['address'] : '';
    $city = isset($_POST['city']) ? $_POST['city'] : '';
    $state = isset($_POST['state']) ? $_POST['state'] : '';
    $pin = isset($_POST['pin']) ? $_POST['pin'] : '';

    $query0 = "SELECT * FROM `users` WHERE `users`.`id` = $id;";
    $run_query0 = mysqli_query($conn, $query0);

    if(mysqli_num_rows($run_query0) > 0){

        $query = "UPDATE `users` SET `full_name` = '$full_name', `phone` = '$phone', `address` = '$address', `city` = '$city', `state` = '$state', `pin` = '$pin' WHERE `users`.`id` = $id;";

        $run_query = mysqli_query($conn, $query);

        if($run_query){
            echo json_encode(array(
                'status' => 1,
                'message' => 'Profile Updated!'
            ));
        } else {
            echo json_encode(array(
                'status' => 0,
                'message' => 'Profile Update Failed!'
            ));
        }

    } else {
        echo json_encode(array(
            'status' => 0,
            'message' => 'No such User Found!'
        ));
    }

?>