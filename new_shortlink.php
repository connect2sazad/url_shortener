<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= SITE_NAME ?></title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css" integrity="sha384-b6lVK+yci+bfDmaY1u0zE8YYJt0TZxLEAFyYSLHId4xoVvsrQu3INevFKo+Xir8e" crossorigin="anonymous">
</head>

<body>
    <div class="wrapper">
        <h1><?= SITE_NAME ?></h1>
        <p>Paste the URL to be shortened</p>
        <form method="post" id="shorten" action="./in/create-short-url">
            <div class="input-field">
                <input type="url" name="full_url" id="full_url" required>
            </div>
            <input type="submit" class="btn btn1" value="Shorten">
            <input type="reset" class="btn btn2" value="Reset">
        </form>
        <div class="shortened-urls">
            <ul id="shortened_url_lists">

            </ul>
        </div>

    </div>
    <div class="footer">
        <span>Copyright &copy; <?= SITE_NAME ?></span>
        <span>Crafted with <i class="bi bi-heart"></i> by <a href="http://www.shopweb.com" target="_blank">Shopweb</a></span>
    </div>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="script.js"></script>
</body>

</html>