<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="Basic layout page to get started">
        <meta name="author" content="Codesleeve Platform">
        <link rel="shortcut icon" href="img/favicon.ico">

        <title><?= isset($title) ? $title : 'Codesleeve Platform' ?></title>
        <link href='http://fonts.googleapis.com/css?family=Lato:100,300,400' rel='stylesheet' type='text/css'>

        <?= stylesheet_link_tag() ?>
        <?= javascript_include_tag() ?>
    </head>
    <body>
        <div class="container">
            <?= $content ?>
        </div>
    </body>
</html>