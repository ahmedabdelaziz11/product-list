<!DOCTYPE html>
<html lang="ar">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js"></script>
    <title><?= isset($pageTitle) ? $pageTitle : 'ScandiWeb' ?></title>
    <style>
.footer {
    position: fixed;
    bottom: 0;
    left: 0;
    right: 0;
    text-align: center;
}
</style>
</head>

<body>
    <?php 
        if (isset($content)) {
            echo $content; 
        }
    ?>
    <?php  require_once(APP . 'views/layout/footer.php'); ?>
</body>

</html>