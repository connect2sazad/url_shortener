<?php

if (!defined('___ABS_PATH___')) {
    define('___ABS_PATH___', __DIR__ . '/');
}

if (!defined('SITE_NAME')) {
    define('SITE_NAME', 'URL Shortener');
}

if (!defined('SHORT_CODE_LENGTH')) {
    define("SHORT_CODE_LENGTH", 5);
}

if(!defined('USER_GLOBAL_VAR')){
    define('USER_GLOBAL_VAR', 'url_shortener_user');
}

define('DIRNAME', 'url_shortener/');