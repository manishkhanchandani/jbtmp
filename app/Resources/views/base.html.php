<!-- app/Resources/views/base.html.php -->
<!DOCTYPE html>
<html ng-app>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title><?php $view['slots']->output('title', 'Jobs Application') ?></title>

        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.0.2/css/bootstrap.min.css">
        <!-- Optional theme -->
        <!--<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.0.2/css/bootstrap-theme.min.css">
        <link href="<?php echo $view['assets']->getUrl('css/style.css') ?>" rel="stylesheet" type="text/css" />
        
        <!-- LOAD JQUERY -->
        <script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
        <!-- LOAD ANGULAR -->
        <script src="//ajax.googleapis.com/ajax/libs/angularjs/1.2.0/angular.min.js"></script>
        <!-- Latest compiled and minified JavaScript -->
        <script src="//netdna.bootstrapcdn.com/bootstrap/3.0.2/js/bootstrap.min.js"></script>
    </head>
    <body>
        <div class="container">
            <?php  echo $view->render('::header.html.php') ?>

            <div class="starter-template" style="margin-top: 65px;margin-bottom: 40px; min-height: 450px;">
                <?php $view['slots']->output('_content') ?>
            </div>

            <?php  echo $view->render('::footer.html.php') ?>
        </div>
    </body>
</html>