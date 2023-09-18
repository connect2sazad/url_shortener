<?php

    require_once "../../constants.php";

    session_start();

    if(isset($_SESSION[USER_GLOBAL_VAR])){
        unset($_SESSION[USER_GLOBAL_VAR]);
        session_destroy();
    }

    header('location: ../login/');

?>