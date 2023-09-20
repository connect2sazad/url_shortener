<?php

session_start();

require_once "constants.php";
require_once ___ABS_PATH___.'config.php';
require_once ___ABS_PATH___.'functions.php';

// if(!isset($_SESSION[USER_GLOBAL_VAR])){
//     header('Location: ./in/login/');
// }

$short_code = str_replace('/' . DIRNAME, '', $_SERVER['REQUEST_URI']);

$actual_link = (empty($_SERVER['HTTPS']) ? 'http' : 'https') . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";


if ($short_code != "") {
    $query = "SELECT * FROM `redirects` WHERE `redirects`.`short_url_code` = '$short_code'";
    $run_query = mysqli_query($conn, $query);
    if (mysqli_num_rows($run_query) > 0) {

        $fetch = mysqli_fetch_assoc($run_query);

        if ($fetch['is_active'] == 1 && !check_url_validity($conn, $short_code)) {
            $current_hits = $fetch['hits'];
            $current_hits++;
            $query = "UPDATE `redirects` SET `hits` = '$current_hits' WHERE `redirects`.`short_url_code` = '$short_code';";
            $run_query = mysqli_query($conn, $query);


            header("location: " . $fetch['full_url']);
        } else {
            include_once './suspended.php';
        }
        
    } else {
        $actual_link = (empty($_SERVER['HTTPS']) ? 'http' : 'https') . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
        $actual_link = strtok($actual_link, '?');
        header("location: " . $actual_link);
    }
} else {
    include_once './new_shortlink.php';
}
?>