<!-- src/Jobs/WebBundle/Resources/views/JobSeeker/preview.html.php -->
<?php $view->extend('JobsWebBundle::layout.html.php') ?>
<script language="javascript">
    var pageData = {
        id: '<?php echo $id; ?>'
    };
</script>
<script src="<?php echo $view['assets']->getUrl('scripts/resumePreview.js') ?>"></script>

<div ng-app="resumePreview" id="resumePreview">
	<div class="myClass"></div>
</div>
    <!--<h2>Resume Preview</h2>
    <div class="row-fluid show-grid">
        <div class="col-md-2">{{resume.title}}</div><br>
        <div class="col-md-2">{{resume.contactNumber}}</div><br>
        <div class="col-md-2">{{resume.startDate}}</div><br>
        <div class="col-md-2">{{resume.workAuthorization}}</div><br>
        <div class="col-md-2">{{resume.education}}</div><br>
        <div class="col-md-2">{{resume.school}}</div><br>
        <div class="col-md-2">{{resume.major}}</div><br>
        <div class="col-md-2">{{resume.workExperience}}</div><br>
        <div class="col-md-2">{{resume.skillSet}}</div><br>
        <div class="col-md-2">{{resume.location}}</div><br>
    </div>-->

