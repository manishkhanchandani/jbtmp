<!-- src/Jobs/WebBundle/Resources/views/Empoyer/post.html.php -->
<?php $view->extend('JobsWebBundle::layout.html.php') ?>

<script src="<?php echo $view['assets']->getUrl('scripts/myJobs.js') ?>"></script>
<div>
    <h1>Manage Jobs</h1><hr>
    <p>Below is the summary of all your jobs. To act on a job, check the box next to the job(s) and click the desired action .</p>
</div>
<div class="row" ng-app="getJobs" ng-controller="getJobsController">

    <div class="col-md-2">
        <select ng-model="jobList.job_status">
            <option value="">All Jobs</option>
            <option ng-repeat="job in jobs" value="{{job.value}}">{{job.name}}</option>
        </select>
        <div>
            <a href="javascript:void(0);" ng-click="activeJobs()">Repost</a><br>
            <a href="javascript:void(0);" ng-click="inActiveJobs()">Inactivate</a><br>
            <a href="javascript:void(0);" ng-click="deleteJobs()">Delete</a><br>
        </div>
    </div>

    <div class="rightCol col-md-10">
        <form name="job-form" id="job-form">
            <table class="jobsContainer">
                <thead>
                    <tr>
                        <td>Number</td>
                        <td>Title</td>
                        <td>Status</td>
                        <td>Edit Date</td>
                        <td>Actions</td>
                    </tr>
                </thead>
                <tbody>
                <!--<input type='search' ng-model="jobList.job_status" />-->
                    <tr ng-repeat="job in myJob| filter:jobList" ng-class="(job.job_status == 1)?'active':'inActive'";>
                        <td><input type="checkbox" ng-model="selectedJobs[job.job_id]" value="job.job_status" name="job.job_id" ng-change="updateSelectedJobs(job.job_id)" /> </td>
                        <td>{{job.title}}</td>
                        <td ng-if="job.job_status == 0">Inactive</td>
                        <td ng-if="job.job_status == 1">Active</td>
                        <td>{{job.job_created_dt}}</td>
                        <td>
                            <a>Edit</a>
                            <a>Preview</a>
                            <a>Applications</a>
                        </td>
                    </tr>
                </tbody>
            </table>
            {{selectedJobs}}
        </form>
    </div>
</div>