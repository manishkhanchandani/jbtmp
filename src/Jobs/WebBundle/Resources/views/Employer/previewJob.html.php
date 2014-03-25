<!-- src/Jobs/WebBundle/Resources/views/Empoyer/post.html.php -->
<?php $view->extend('JobsWebBundle::layout.html.php') ?>

<script src="<?php echo $view['assets']->getUrl('scripts/previewJob.js') ?>"></script>
<div class="container" ng-app="previewJob" ng-controller="previewJobController">
    <div class="row">
        <div class="col-md-3">
            <div style="margin: 40px 0 5px;">
                <a href="myjobs">search Jobs</a>
            </div>
            <hr style="border:#999 solid 1px; margin: 0px;">
            <div>Company Logo</div>
        </div>
        <div class="col-md-8">
            <div id="previewJob">
                <h2>{{job.title}}</h2>
                <div class="row action-btns">
                    <a href="saveJob">Save Job</a> &nbsp;
                    <a href="shareJob">Share Job</a> &nbsp;
                    <a class="btn btn-default" href="applyNow" style="margin-left: 365px;">Apply Now</a> &nbsp;
                </div><br>
                <div class="row">
                    <div>
                        <label class="title">Location: </label>
                        <span>{{job.city}}, {{job.state}}</span><br>
                        <label class="title">Area code: </label>
                        <span>{{job.area_code}}</span><br>
                        <label class="title">Skills: </label>
                        <span>{{job.title}} with {{job.skills}}</span><br>
                        <label class="title">Pay Rate: </label><span> Open</span><br>
                        <label class="title">Tax Term:</label>
                        <span>{{job.position_type}} (update value with description)</span><br>
                        <label>Length: </label><br>
                        <label class="title">Date Posted: </label>
                        <span>{{job.created}}</span>
                    </div>
                    <hr style="border:#999 solid 1px;">
                    <div>{{job.description}}</div><br>
                    <hr>
                    <div>
                        <span ng-if="job.show_name">{{job.user.name}}</span><br>
                        <span ng-if="job.show_address">{{job.user.address}} {{job.user.address2}}</span><br>
                        <span ng-if="job.show_city">{{job.user.city}}</span><br>
                        <span ng-if="job.show_state">{{job.user.state}}</span><br>
                        <span ng-if="job.show_zip">{{job.user.zip}}</span><br>
                        <span ng-if="job.show_phone">{{job.user.phone}}</span><br>
                        <span ng-if="job.show_email">{{job.user.email}}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>