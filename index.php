<?php

require_once "config.php";

$short_code = str_replace('/url_shortener/','',$_SERVER['REQUEST_URI']);

if ($short_code != "") {
    $query = "SELECT * FROM `redirects` WHERE `redirects`.`short_url_code` = '$short_code'";
    $run_query = mysqli_query($conn, $query);
    if (mysqli_num_rows($run_query) > 0) {
        $fetch = mysqli_fetch_assoc($run_query);
        header("location: " . $fetch['full_url']);
    } else {
        $actual_link = (empty($_SERVER['HTTPS']) ? 'http' : 'https') . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
        $actual_link = strtok($actual_link, '?');
        header("location: " . $actual_link);
    }
} else {

?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
        <link rel="stylesheet" href="style.css">
    </head>

    <body>
        <div class="wrapper">
            <h1>Shorten URL</h1>
            <form action="shorten.php" method="post">
                <div class="input-field">
                    <input type="url" name="full_url">
                </div>
                <input type="submit" value="Shorten">
            </form>
            <div class="shortened-urls">
                <ul>
                    <?php

                    $query = "SELECT * FROM `redirects`;";
                    $run_query = mysqli_query($conn, $query);

                    if(mysqli_num_rows($run_query)){
                        while($row = mysqli_fetch_assoc($run_query)){
                            echo '
                            <li>
                                <a target="_blank" href="#">'.$row['full_url'].'</a>
                                <div class="arrow">&rarr;</div>
                                <a target="_blank" href="#">http://127.0.0.1/url_shortener/'.$row['short_url_code'].'</a>
                            </li>
                            ';
                        }
                    }

                    ?>
                </ul>
            </div>
        </div>
    </body>

    </html>
<?php
}
// https://nomadphp.com/blog/64/creating-a-url-shortener-application-in-php-mysql
?>