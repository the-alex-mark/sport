<!DOCTYPE html>
<html lang="ru">
    <head>
        <title>Document</title>

        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1, maximum-scale=1, user-scalable=no">
        <meta name="robots" content="index, nofollow">
        <meta name="keywords" content="">
        <meta name="description" content="">

        <!-- Подключение шрифтов -->
        <link rel="stylesheet" href="assets/fonts/fontello/stylesheet.css">
        <link rel="stylesheet" href="assets/fonts/peacesans/stylesheet.css">
        <link rel="stylesheet" href="assets/fonts/probapro/stylesheet.css">

        <!-- Подключение плагинов -->
        <!-- <link rel="stylesheet" href="assets/plugins/bootstrap/bootstrap-grid.min.css"> -->

        <!-- Подключение стилей -->
        <link rel="stylesheet" href="assets/styles/config.css">
        <link rel="stylesheet" href="assets/styles/style.css">
        <link rel="stylesheet" href="assets/styles/main.css">
        <link rel="stylesheet" href="assets/styles/adaptive.css">
    </head>
    <body>
        
        <?php require 'header.php'; ?>

        <main class="main-wrapper">
            <div class="container">
                <div class="main">
                    <?php /* require 'sidebar.php';  */?>

                    <article class="content">
                        <?php require 'cart.php'; ?>
                    </article>
                </div>
            </div>
        </main>

        <?php require 'footer.php'; ?>
        
        <!-- Подключение скриптов -->
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
        <script src="assets/scripts/main.js"></script>
    </body>
</html>