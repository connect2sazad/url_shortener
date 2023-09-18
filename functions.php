<?php

/****************************************GENRAL FUNCTIONS START**********************************************************/

function getRandomId($length, $type = 'alpha_numeric')
{
    switch ($type) {
        case 'alpha_numeric':
            $str = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
            break;
        case 'alpha':
            $str = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
            break;
        case 'alpha_uppercase':
            $str = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
            break;
        case 'alpha_uppercase_numeric':
            $str = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
            break;
        case 'alpha_lowercase':
            $str = 'abcdefghijklmnopqrstuvwxyz';
            break;
        case 'alpha_lowercase_numeric':
            $str = '0123456789abcdefghijklmnopqrstuvwxyz';
            break;
        case 'numeric':
            $str = '0123456789';
            break;
        default:
            break;
    }
    return substr(str_shuffle($str), 0, $length);
}

function removeFilename($url)
{
    $file_info = pathinfo($url);
    return isset($file_info['extension'])
        ? str_replace($file_info['filename'] . "." . $file_info['extension'], "", $url)
        : $url;
}

function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

function get_client_ip()
{
    $ipaddress = '';
    if (getenv('HTTP_CLIENT_IP'))
        $ipaddress = getenv('HTTP_CLIENT_IP');
    else if (getenv('HTTP_X_FORWARDED_FOR'))
        $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
    else if (getenv('HTTP_X_FORWARDED'))
        $ipaddress = getenv('HTTP_X_FORWARDED');
    else if (getenv('HTTP_FORWARDED_FOR'))
        $ipaddress = getenv('HTTP_FORWARDED_FOR');
    else if (getenv('HTTP_FORWARDED'))
        $ipaddress = getenv('HTTP_FORWARDED');
    else if (getenv('REMOTE_ADDR'))
        $ipaddress = getenv('REMOTE_ADDR');
    else
        $ipaddress = 'UNKNOWN';
    return $ipaddress;
}
function date_diff_till_today($dateString)
{
    $providedDate = new DateTime($dateString);

    // Create a DateTime object for today's date
    $currentDate = new DateTime();

    // Calculate the difference between the two dates
    $interval = $providedDate->diff($currentDate);

    // Calculate the total number of days in the interval
    $totalDays = $interval->days;

    // Check if the difference is more than 180 days
    return $totalDays;
}

function site_url()
{
    // Check if the request uses HTTPS
    $isHttps = !empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off';

    // Get the protocol (HTTP or HTTPS)
    $protocol = $isHttps ? 'https://' : 'http://';

    // Get the server name (domain)
    $domain = $_SERVER['SERVER_NAME'];

    // Combine the components to create the complete URL
    $currentUrl = $protocol . $domain;

    return $currentUrl;
}
/****************************************GENRAL FUNCTIONS END**********************************************************/




/****************************************ADMIN & USER FUNCTIONS START**********************************************************/
function login($conn, $username, $password)
{
    $query = "SELECT * FROM `users` WHERE `users`.`username` = '$username'";
    $run_query = mysqli_query($conn, $query);

    if (mysqli_num_rows($run_query) > 0) {
        $fetch = mysqli_fetch_assoc($run_query);

        if (password_verify($password, $fetch['password']) == 1) {
            $response['status'] = 'success';
            $response['message'] = "Login Successfull!";
            session_start();
            $_SESSION[USER_GLOBAL_VAR] = $fetch['username'];
        } else {
            $response['status'] = 'failed';
            $response['message'] = "Incorrect Credentials!";
        }
        return $response;
    }
}

function getAllURLs($conn, $service_type)
{
    switch ($service_type) {
        case 'paid':
            $query = "SELECT * FROM `redirects` WHERE `redirects`.`is_paid` = 1 ORDER BY `redirects`.`id` DESC;";
            break;
        case 'free':
            $query = "SELECT * FROM `redirects` WHERE `redirects`.`is_paid` = 0 ORDER BY `redirects`.`id` DESC;";
            break;
        default:
            $query = "SELECT * FROM `redirects` ORDER BY `redirects`.`id` DESC;";
    }

    $run_query = mysqli_query($conn, $query);
    return $run_query;
}

function check_url_validity($conn, $short_code)
{
    $query = "SELECT * FROM `redirects` WHERE `redirects`.`short_url_code` = '$short_code'";
    $run_query = mysqli_query($conn, $query);
    if(mysqli_num_rows($run_query)){
        $fetch = mysqli_fetch_assoc($run_query);
        $valid_till = $fetch['valid_till'];
        $valid_till = new DateTime($valid_till);
        $todayDate = new DateTime();
        if($todayDate > $valid_till){
            return true;
        } else {
            return false;
        }
    }
}
function get_user_type($conn, $username)
{
    $query = "SELECT * FROM `users` WHERE `users`.`username` = '$username'";
    $run_query = mysqli_query($conn, $query);
    $fetch = mysqli_fetch_assoc($run_query);

    $usertype = $fetch['user_type'];

    $query2 = "SELECT * FROM `user_types` WHERE `user_types`.`id` = '$usertype'";
    $run_query2 = mysqli_query($conn, $query2);
    $fetch2 = mysqli_fetch_assoc($run_query2);

    return $fetch2;
}

function is_admin($conn, $username){
    $user_type = get_user_type($conn, $_SESSION[USER_GLOBAL_VAR]);
    $user_type = $user_type['type_name'];
    if($user_type == 'admin')
        return true;
    else
        return false;
}

function getAllURLsByUsers($conn, $service_type, $user){
    switch ($service_type) {
        case 'paid':
            $query = "SELECT * FROM `redirects` WHERE `redirects`.`created_by` = '$user' AND `redirects`.`is_paid` = 1 ORDER BY `redirects`.`id` DESC;";
            break;
        case 'free':
            $query = "SELECT * FROM `redirects` WHERE `redirects`.`created_by` = '$user' AND `redirects`.`is_paid` = 0 ORDER BY `redirects`.`id` DESC;";
            break;
            break;
        default:
            $query = "SELECT * FROM `redirects` WHERE `redirects`.`created_by` = '$user' ORDER BY `redirects`.`id` DESC;";
    }

    $run_query = mysqli_query($conn, $query);
    return $run_query;
}
/****************************************ADMIN & USER FUNCTIONS END**********************************************************/
