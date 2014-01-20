<!-- src/Jobs/WebBundle/Resources/views/JobSeeker/preview.html.php -->
<?php $view->extend('JobsWebBundle::layout.html.php') ?>
<script src="<?php echo $view['assets']->getUrl('scripts/postResume.js') ?>"></script>
<div ng-app="resumePreview" ng-controller="previewController">
    <div id="previewResume" ng-show="showpreview">
        <h2> Resume Preview </h2>
        {{resume.title}}
    </div>
</div>
