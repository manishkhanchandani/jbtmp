<!-- app/Resources/views/base.html.php -->
<!DOCTYPE html>
<html ng-app>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title><?php $view['slots']->output('title', 'Jobs Application') ?></title>
        <!-- LOAD JQUERY -->
        <script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
        <!-- LOAD ANGULAR -->
        <script src="//ajax.googleapis.com/ajax/libs/angularjs/1.2.0/angular.min.js"></script>
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.0.2/css/bootstrap.min.css">
        <!-- Optional theme -->
        <!--<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.0.2/css/bootstrap-theme.min.css">
        <link href="<?php echo $view['assets']->getUrl('css/style.css') ?>" rel="stylesheet" type="text/css" />
        <!-- Latest compiled and minified JavaScript -->
        <script src="//netdna.bootstrapcdn.com/bootstrap/3.0.2/js/bootstrap.min.js"></script>
    </head>
    <body>
        <div class="container">
            <?php $view->extend('::header.html.php') ?>

            <!--<header class="navbar navbar header-outer" role="banner">-->
                <!--<div class="container form-inline">-->
                    <!--<a class="logo"><img src="http://dummyimage.com/44x20/000/fff&amp;text=logo" width="160" height="100px"></a>-->
                     <!--<div class="pull-right padding-top">-->
                          <!--<div>Employers: <a>Post Jobs</a> | <a>Search Resumes</a></div>-->
                          <!--<div>Job Seekers: <a>Post Resume</a> | <a>Find Jobs</a></div>-->
                    <!--</div>-->
                <!--</div>-->
            <!--</header>-->

            <!--<nav class="navbar navbar-default" role="navigation">-->
                <!--&lt;!&ndash; Brand and toggle get grouped for better mobile display &ndash;&gt;-->
                <!--<div class="navbar-header">-->
                    <!--<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">-->
                        <!--<span class="sr-only">Toggle navigation</span>-->
                        <!--<span class="icon-bar"></span>-->
                        <!--<span class="icon-bar"></span>-->
                        <!--<span class="icon-bar"></span>-->
                    <!--</button>-->
                    <!--<a class="navbar-brand" href="#">Nav Place Holder</a>-->
                <!--</div>-->

                <!--<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">-->
                    <!--<ul class="nav navbar-nav">-->
                        <!--<li class="active"><a href="#">Home</a></li>-->
                        <!--<li><a href="#">About</a></li>-->
                    <!--</ul>-->

                    <!--<ul class="nav navbar-nav navbar-right">-->
                        <!--<li><a href="#">Contact</a></li>-->
                    <!--</ul>-->
                <!--</div>&lt;!&ndash; /.navbar-collapse &ndash;&gt;-->
            <!--</nav>-->

          <div class="starter-template" style="margin-top: 65px;margin-bottom: 40px; min-height: 450px;">
            <?php $view['slots']->output('_content') ?>
          </div>

          <footer>
               <div>Copyright ©2014. All rights reserved. </div>
          </footer>

        </div>
    </body>
</html>