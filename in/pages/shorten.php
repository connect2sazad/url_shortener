<?php

session_start();

require_once "../../constants.php";
require_once ___ABS_PATH___.'config.php';
require_once ___ABS_PATH___.'functions.php';

$full_url = isset($_POST['full_url']) ? $_POST['full_url'] : '';
$validity = 180;

GetShortUrl($conn, $full_url, $validity);

function GetShortUrl($conn, $full_url, $validity)
{
    $ip = get_client_ip();

    // check if the full url already exists!
    $query = "SELECT * FROM `redirects` WHERE `redirects`.`full_url` = '$full_url'";
    $run_query = mysqli_query($conn, $query);

    // check if the full url exists in db
    if (mysqli_num_rows($run_query) > 0) {

        // return the previously created short code
        $ftold = mysqli_fetch_assoc($run_query);
        echo json_encode(array('status' => 1, 'short_code' => $ftold['short_url_code'], 'message' => 'Success'));
    } else {

        // generate new code if full url not exists in db

        // generate a random code
        $short_code = getRandomId(SHORT_CODE_LENGTH);

        // get the short code if it already exists in db
        $query = "SELECT * FROM `redirects` WHERE `redirects`.`short_url_code` = '$short_code'";
        $run_query = mysqli_query($conn, $query);

        // if short code exists in db create short code again
        if (mysqli_num_rows($run_query) > 0) {
            GetShortUrl($conn, $full_url, $validity);
        } else {

            $currentDateTime = new DateTime();

            // Add 180 days to the current date and time
            $currentDateTime->modify('+'.$validity.' days');

            // Format the modified date and time
            $valid_till = $currentDateTime->format('Y-m-d H:i:s');

            // if short code doesnot exist in db push it to new row
            $query = "INSERT INTO `redirects` (`full_url`, `short_url_code`, `hits`, `ip`, `validity`, `created_by`, `updated_by`, `valid_till`) VALUES ('$full_url', '$short_code', '0', '$ip', '$validity', '" . $_SESSION[USER_GLOBAL_VAR] . "', '" . $_SESSION[USER_GLOBAL_VAR] . "', '$valid_till');";
            $run_query = mysqli_query($conn, $query);

            if ($run_query) {
                $actual_link = (empty($_SERVER['HTTPS']) ? 'http' : 'https') . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
                $actual_link = strtok($actual_link, '?');
                $actual_link = removeFilename($actual_link);

                echo json_encode(array('status' => 1, 'short_code' => $short_code, 'message' => 'Success'));
            } else {
                echo json_encode(array('status' => 0, 'message' => 'Failed'));
            }
        }
    }
}
