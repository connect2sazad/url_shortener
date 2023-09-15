<?php

require_once "config.php";

$full_url = isset($_POST['full_url']) ? $_POST['full_url'] : '';
GetShortUrl($conn, $full_url);


function GetShortUrl($conn, $full_url)
{
    $short_code = getRandomId(6);
    $query = "SELECT * FROM `redirects` WHERE `redirects`.`short_url_code` = '$short_code'";
    $run_query = mysqli_query($conn, $query);
    if (mysqli_num_rows($run_query) > 0) {
        GetShortUrl($conn, $full_url);
    } else {
        $query = "INSERT INTO `redirects` (`full_url`, `short_url_code`, `hits`) VALUES ('$full_url', '$short_code', '0');";
        $run_query = mysqli_query($conn, $query);
        if ($run_query) {
            $actual_link = (empty($_SERVER['HTTPS']) ? 'http' : 'https') . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
            $actual_link = strtok($actual_link, '?');
            $actual_link = removeFilename($actual_link);
            echo $actual_link . $short_code;
        } else {
            echo "Failed!";
        }
    }
}

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