<!-- src/Jobs/WebBundle/Resources/views/Empoyer/post.html.php -->
<?php $view->extend('JobsWebBundle::layout.html.php') ?>

<script src="<?php echo $view['assets']->getUrl('scripts/myJobs.js') ?>"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/angular.js/1.2.10/angular-sanitize.min.js"></script>
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
                        <td><input type="checkbox" ng-model="master"/> Number</td>
                        <td>Title</td>
                        <td>Status</td>
                        <td>Edit Date</td>
                        <td>Actions</td>
                    </tr>
                </thead>
                <tbody>
                    <tr ng-repeat="job in myJob| filter:jobList" ng-class="(job.job_status == 1)?'active':'inActive'" ng-hide='jobDelete["job_"+this.job.job_id]'>
                        <td>
                            <input type="checkbox"  ng-checked="master" 
                                   ng-model="selectedJobs[job.job_id]" 
                                   value="job.job_status" name="job.job_id" 
                                   ng-change="updateSelectedJobs(job.job_id)"/> <a href="preview?jobId={{job.job_id}}">{{job.number}}</a>
                        </td>
                        <td>{{job.title}} {{jobStatusInactive}}</td>
                        <td ng-if="job.job_status === 0 && jobStatusInactive === '1'">Inactive</td>
                        <td ng-if="job.job_status === 1 && jobStatusActive === '1'">Active</td>
                        <td ng-if="jobStatusActive === '0' || jobStatusInactive === '0'" ng-bind-html='jobStatus["job_"+this.job.job_id]'></td>
                        <td>{{job.job_created_dt}}</td>
                        <td>
                            <a href="post?jobId={{job.job_id}}"><img src="/images/edit.jpg" width="20" alt="Edit" title="Edit"/> </a>
                            <a href="preview?jobId={{job.job_id}}"><img src="/images/preview.jpg" width="20" alt="Preview" title="Preview"/></a>
                            <a href="" title="Applications"><span class="appTotal">0</span></a>
                        </td>
                    </tr>
                </tbody>
            </table>
        </form>
    </div>
</div>