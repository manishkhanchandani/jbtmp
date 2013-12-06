<!doctype html>
<html>
    <head>

        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title><?php $view['slots']->output('title', 'Jobs Application') ?></title>

        <!--Latest compiled and minified bootstrap CSS -->
        <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.0.2/css/bootstrap.min.css">

        <!--Custom css-->
        <link href="<?php echo $view['assets']->getUrl('css/style.css') ?>" rel="stylesheet" type="text/css" />

        <!-- LOAD JQUERY -->
        <script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
        <!-- LOAD Angular -->
        <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/angularjs/1.2.3/angular.min.js"></script>
        <!--Latest compiled and minified JavaScript -->
        <script src="//netdna.bootstrapcdn.com/bootstrap/3.0.2/js/bootstrap.min.js"></script>

        <!--custom script-->
         <script>
        var globals = {
            'host_url': '<?php echo $view->container->parameters['host_url']; ?>',
            'base_path': '<?php echo $view->container->parameters['base_path']; ?>',
            'path': '<?php echo $view->container->parameters['host_url'].$view->container->parameters['base_path']; ?>'
        };
        </script>
        <script src="<?php echo $view['assets']->getUrl('scripts/app.js') ?>"></script>
    </head>
    <body>
        <div class="container">
            <?php echo $view->render('::header.html.php') ?>

            <div class="starter-template" style="margin-top: 65px;margin-bottom: 40px; min-height: 450px;">
                <?php $view['slots']->output('_content') ?>
            </div>

            <?php echo $view->render('::footer.html.php') ?>
        </div>
    </body>
</html>