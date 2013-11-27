<!-- src/Acme/HelloBundle/Resources/views/layout.html.php -->
<?php $view->extend('::base.html.php') ?>

<br><br>
<?php $view['slots']->output('_content') ?>