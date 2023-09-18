<?php

session_start();

require_once '../constants.php';
require_once ___ABS_PATH___ . 'config.php';
require_once ___ABS_PATH___ . 'functions.php';

if (!isset($_SESSION[USER_GLOBAL_VAR])) {
    header('location: ./login/');
}

// $page = isset($_GET['page']) ? $_GET['page'] : 'dashboard';
$page_name = str_replace('/' . DIRNAME . 'in/', '', $_SERVER['REQUEST_URI']);
$page_name = ($page_name != '') ? $page_name : 'dashboard';
$page_location = './pages/' . $page_name . '.php';

$error_page_location = './pages/404.php';


$specialChars = array("@", "#", "!", "^");
$cleanString = str_replace($specialChars, ' ', $page_name);
$page_title = ucwords($cleanString);

$is_admin = is_admin($conn, $_SESSION[USER_GLOBAL_VAR]);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> <?= $page_title ?> - <?= SITE_NAME ?></title>

    <link rel="stylesheet" href="./assets/css/main/app.css">
    <link rel="stylesheet" href="./assets/css/main/addon.css">
    <link rel="shortcut icon" href="./assets/images/logo/favicon.png">

    <link rel="stylesheet" href="./assets/css/shared/iconly.css">
    <link rel="stylesheet" href="./assets/css/pages/fontawesome.css">
    <link rel="stylesheet" href="./assets/extensions/datatables.net-bs5/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="./assets/css/pages/datatables.css">
</head>

<body>
    <div id="app">
        <div id="main" class="layout-horizontal">
            <header class="mb-5">
                <div class="header-top">
                    <div class="container">
                        <div class="logo">
                            <a href="./"><img src="./assets/images/logo/logo.png" alt="Logo"></a>
                        </div>
                        <div class="header-top-right">

                            <div class="dropdown">
                                <a href="#" id="topbarUserDropdown" class="user-dropdown d-flex align-items-center dropend dropdown-toggle " data-bs-toggle="dropdown" aria-expanded="false">
                                    <div class="avatar avatar-md2">
                                        <img src="./assets/images/faces/1.jpg" alt="Avatar">
                                    </div>
                                    <div class="text">
                                        <h6 class="user-dropdown-name"><?= $_SESSION[USER_GLOBAL_VAR] ?></h6>
                                        <p class="user-dropdown-status text-sm text-muted"><?= get_user_type($conn, $_SESSION[USER_GLOBAL_VAR])['type_name'] ?></p>
                                    </div>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end shadow-lg" aria-labelledby="topbarUserDropdown">
                                    <li><a class="dropdown-item" href="./settings">Settings</a></li>
                                    <li><a class="dropdown-item" href="./logout">Logout</a></li>
                                </ul>
                            </div>

                            <!-- Burger button responsive -->
                            <a href="#" class="burger-btn d-block d-xl-none">
                                <i class="bi bi-justify fs-3"></i>
                            </a>
                        </div>
                    </div>
                </div>
                <nav class="main-navbar">
                    <div class="container">
                        <ul>
                            <li class="menu-item">
                                <a href="../" target="_blank" class='menu-link'>
                                    <i class="bi bi-plus"></i>
                                    <span>New Short URL</span>
                                </a>
                            </li>
                            <li class="menu-item">
                                <a href="./shortened-urls" class='menu-link'>
                                    <i class="bi bi-link-45deg"></i>
                                    <span>Shortened URLs</span>
                                </a>
                            </li>
                            <?php
                            if ($is_admin) {
                            ?>
                                <!-- <li class="menu-item">
                                    <a href="./users" class='menu-link'>
                                        <i class="bi bi-person"></i>
                                        <span>Users</span>
                                    </a> -->
                                </li>
                            <?php
                            }
                            ?>
                            <li class="menu-item">
                                <a href="./settings" class='menu-link'>
                                    <i class="bi bi-gear-fill"></i>
                                    <span>Settings</span>
                                </a>
                            </li>
                            <li class="menu-item">
                                <a href="./logout/" class='menu-link'>
                                    <i class="bi bi-box-arrow-right"></i>
                                    <span>Logout</span>
                                </a>
                            </li>


                        </ul>
                    </div>
                </nav>

            </header>

            <div class="content-wrapper container">

                <?php
                if (file_exists($page_location)) {
                    include_once $page_location;
                } else {
                    include_once $error_page_location;
                }
                ?>

            </div>

            <footer>
                <div class="container">
                    <div class="footer clearfix mb-0 text-muted">
                        <div class="float-start">
                            <p>Copyright &copy; <?= date('Y') ?> <?= SITE_NAME ?></p>
                        </div>
                        <div class="float-end">
                            <p>Crafted with <span class="text-danger"><i class="bi bi-heart"></i></span> by <a target="_blank" href="https://www.shopweb.com">Shopweb</a></p>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>
    <script src="./assets/js/bootstrap.js"></script>
    <script src="./assets/js/app.js"></script>
    <script src="./assets/js/pages/horizontal-layout.js"></script>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/v/bs5/dt-1.12.1/datatables.min.js"></script>
    <script src="./assets/js/pages/datatables.js"></script>
    <script src="./assets/js/pages/addon.js"></script>

</body>

</html>