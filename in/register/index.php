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
    <title>Sign Up - <?=SITE_NAME?></title>
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
                            <h1 class="auth-title">Sign up.</h1>

                            <form action="./signup.php" method="POST" onsubmit="return validate_signup()">
                                <input type="hidden" name="r" value="<?= $r ?>">
                                <div class="form-group position-relative has-icon-left mb-4">
                                    <input type="text" class="form-control form-control-xl" placeholder="Name" name="name" required id="name">
                                    <div class="form-control-icon">
                                        <i class="bi bi-person"></i>
                                    </div>
                                </div>
                                <div class="form-group position-relative has-icon-left mb-4">
                                    <input type="text" class="form-control form-control-xl" placeholder="Username" name="username" required id="username">
                                    <div class="form-control-icon">
                                        <i class="bi bi-person"></i>
                                    </div>
                                </div>
                                <div class="form-group position-relative has-icon-left mb-4">
                                    <input type="email" class="form-control form-control-xl" placeholder="Email" name="email" required id="email">
                                    <div class="form-control-icon">
                                        <i class="bi bi-envelope"></i>
                                    </div>
                                </div>
                                <div class="form-group position-relative has-icon-left mb-4">
                                    <input type="tel" class="form-control form-control-xl" placeholder="Phone" name="phone" required id="phone">
                                    <div class="form-control-icon">
                                        <i class="bi bi-phone"></i>
                                    </div>
                                </div>
                                <div class="form-group position-relative has-icon-left mb-4">
                                    <input type="password" class="form-control form-control-xl" placeholder="Password" name="password" required id="password">
                                    <div class="form-control-icon">
                                        <i class="bi bi-shield-lock"></i>
                                    </div>
                                </div>
                                <div class="form-group position-relative has-icon-left mb-4">
                                    <input type="password" class="form-control form-control-xl" placeholder="Confirm Password" name="cpassword" required id="cpassword">
                                    <div class="form-control-icon">
                                        <i class="bi bi-shield-lock"></i>
                                    </div>
                                </div>
                                <button class="btn btn-primary btn-block btn-lg shadow-lg mt-5">Sign Up</button>
                            </form>
                            <p class="mt-3">
                                Already have an account? <a href="../login/?r=<?= $r ?>">Log In</a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="../assets/js/pages/addon.js"></script>
</body>

</html>