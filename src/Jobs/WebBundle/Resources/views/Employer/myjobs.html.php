<!-- src/Jobs/WebBundle/Resources/views/Empoyer/post.html.php -->
<?php $view->extend('JobsWebBundle::layout.html.php') ?>

<script src="<?php echo $view['assets']->getUrl('scripts/myJobs.js') ?>"></script>
<div>
    <h1>Manage Jobs</h1><hr>
    <p>Below is the summary of all your jobs. To act on a job, check the box next to the job(s) and click the desired action .</p>
</div>
<div class="leftCol">
    
</div>
<div class="rightCol" ng-app="getJobs" ng-controller="getJobsController">
    <table class="jobsContainer">
        <thead>
            <tr>
                <td>Number</td>
                <td>Title</td>
                <td>Status</td>
                <td>Edit Date</td>
                <td>Exp. Date</td>
                <td>Actions</td>
            </tr>
        </thead>
        <tbody>
            <tr ng-repeat="job in myJob">
               <td>{{$index + 1}} </td>
               <td>{{job.title}}</td>
               <td>{{job.job_status}}</td>
               <td>{{job.job_created_dt}}</td>
               <td>{{job.job_deleted_dt}}</td>
               <td>
                   <a>Edit</a>
                   <a>Copy</a>
                   <a>Preview</a>
               </td>
            </tr>
        </tbody>
    </table>
</div>
<!--http://jobs.mkgalaxy.com/app_dev.php/api/myjobs-->