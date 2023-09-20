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
                                    <!-- <li>
                                        <div class="theme-toggle d-flex gap-2  align-items-center mt-2 dropdown-item">
                                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" aria-hidden="true" role="img" class="iconify iconify--system-uicons" width="20" height="20" preserveAspectRatio="xMidYMid meet" viewBox="0 0 21 21">
                                                <g fill="none" fill-rule="evenodd" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round">
                                                    <path d="M10.5 14.5c2.219 0 4-1.763 4-3.982a4.003 4.003 0 0 0-4-4.018c-2.219 0-4 1.781-4 4c0 2.219 1.781 4 4 4zM4.136 4.136L5.55 5.55m9.9 9.9l1.414 1.414M1.5 10.5h2m14 0h2M4.135 16.863L5.55 15.45m9.899-9.9l1.414-1.415M10.5 19.5v-2m0-14v-2" opacity=".3"></path>
                                                    <g transform="translate(-210 -1)">
                                                        <path d="M220.5 2.5v2m6.5.5l-1.5 1.5"></path>
                                                        <circle cx="220.5" cy="11.5" r="4"></circle>
                                                        <path d="m214 5l1.5 1.5m5 14v-2m6.5-.5l-1.5-1.5M214 18l1.5-1.5m-4-5h2m14 0h2"></path>
                                                    </g>
                                                </g>
                                            </svg>
                                            <div class="form-check form-switch fs-6">
                                                <input class="form-check-input  me-0" type="checkbox" id="toggle-dark">
                                                <label class="form-check-label"></label>
                                            </div>
                                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" aria-hidden="true" role="img" class="iconify iconify--mdi" width="20" height="20" preserveAspectRatio="xMidYMid meet" viewBox="0 0 24 24">
                                                <path fill="currentColor" d="m17.75 4.09l-2.53 1.94l.91 3.06l-2.63-1.81l-2.63 1.81l.91-3.06l-2.53-1.94L12.44 4l1.06-3l1.06 3l3.19.09m3.5 6.91l-1.64 1.25l.59 1.98l-1.7-1.17l-1.7 1.17l.59-1.98L15.75 11l2.06-.05L18.5 9l.69 1.95l2.06.05m-2.28 4.95c.83-.08 1.72 1.1 1.19 1.85c-.32.45-.66.87-1.08 1.27C15.17 23 8.84 23 4.94 19.07c-3.91-3.9-3.91-10.24 0-14.14c.4-.4.82-.76 1.27-1.08c.75-.53 1.93.36 1.85 1.19c-.27 2.86.69 5.83 2.89 8.02a9.96 9.96 0 0 0 8.02 2.89m-1.64 2.02a12.08 12.08 0 0 1-7.8-3.47c-2.17-2.19-3.33-5-3.49-7.82c-2.81 3.14-2.7 7.96.31 10.98c3.02 3.01 7.84 3.12 10.98.31Z"></path>
                                            </svg>
                                        </div>
                                    </li> -->
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
                                <a href="./create-short-url" class='menu-link'>
                                    <i class="bi bi-plus"></i>
                                    <span>Create Short URL</span>
                                </a>
                            </li>
                            <li class="menu-item">
                                <a href="./shortened-urls" class='menu-link'>
                                    <i class="bi bi-link-45deg"></i>
                                    <span>My Short URLs</span>
                                </a>
                            </li>
                            <li class="menu-item">
                                <a href="./create-qr" class='menu-link'>
                                    <i class="bi bi-plus"></i>
                                    <span>Create QR</span>
                                </a>
                            </li>
                            <li class="menu-item">
                                <a href="./created-qrs" class='menu-link'>
                                    <i class="bi bi-qr-code"></i>
                                    <span>My QRs</span>
                                </a>
                            </li>
                            <?php
                            if ($is_admin) {
                            ?>
                                <li class="menu-item">
                                    <a href="./users" class='menu-link'>
                                        <i class="bi bi-person"></i>
                                        <span>Users</span>
                                    </a>
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

    <!-- <img id="logo" style="opacity: 0;" src="./assets/images/logo/favicon.png" style="z-index:0;" alt="Company Logo"> -->
    <img id="logo" src="./assets/images/logo/favicon.png" alt="Company Logo">

    <script src="./assets/js/bootstrap.js"></script>
    <script src="./assets/js/app.min.js"></script>
    <script src="./assets/js/pages/horizontal-layout.js"></script>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/v/bs5/dt-1.12.1/datatables.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.5.0-beta4/html2canvas.min.js"></script>
    <script src="./assets/extensions/qrcode/qrcode.min.js"></script>
    <script src="./assets/js/pages/datatables.js"></script>
    <script src="./assets/js/pages/addon.js"></script>

</body>

</html>