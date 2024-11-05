<!DOCTYPE html>
<html lang="ar">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js"></script>
    <title><?= isset($title) ? $title : 'ScandiWeb' ?></title>
</head>

<body>
    <?php  require_once(APP . 'views/layout/navbar.php'); ?>
    <section class="pt-4">
        <div class="container px-lg-5">
        <?php 
            if (isset($content)) {
                echo $content; 
            }
        ?>
        </div>
    </section>
    <?php  require_once(APP . 'views/layout/footer.php'); ?>
</body>

</html>