<?php

    include '../../constants.php';

    session_start();

    if(isset($_SESSION[USER_GLOBAL_VAR])){
        header('location: ../');
    }

    $r = isset($_GET['r']) ? $_GET['r'] : '';
    
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - <?=SITE_NAME?></title>
    <link rel="stylesheet" href="../assets/css/main/app.css">
    <link rel="stylesheet" href="../assets/css/pages/auth.css">
    <link rel="shortcut icon" href="../assets/images/logo/favicon.png">
</head>

<body>
    <div id="auth">

        <div class="row h-100">
            <div class="col-lg-12 col-12 d-flex align-items-center justify-content-center">
                <div class="row">
                    <div class="col-md-12">
                        <div id="auth-left">
                            <div class="auth-logo mb-5">
                                <a href="./"><img src="../assets/images/logo/logo.png" alt="Logo"></a>
                            </div>
                            <h1 class="auth-title">Log in.</h1>

                            <form action="./auth.php" method="POST">
                                <input type="hidden" name="r" value="<?= $r ?>">
                                <div class="form-group position-relative has-icon-left mb-4">
                                    <input type="text" class="form-control form-control-xl" placeholder="Username" name="username">
                                    <div class="form-control-icon">
                                        <i class="bi bi-person"></i>
                                    </div>
                                </div>
                                <div class="form-group position-relative has-icon-left mb-4">
                                    <input type="password" class="form-control form-control-xl" placeholder="Password" name="password">
                                    <div class="form-control-icon">
                                        <i class="bi bi-shield-lock"></i>
                                    </div>
                                </div>
                                <button class="btn btn-primary btn-block btn-lg shadow-lg mt-5">Log in</button>
                            </form>
                            <p class="mt-3">
                                New here? <a href="../register/?r=<?= $r ?>">Sign Up</a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</body>

</html>