<?php $view->extend('JobsWebBundle::layout.html.php') ?>

<script src="<?php echo $view['assets']->getUrl('scripts/search.js') ?>"></script>

<div class="container" ng-app="searchApp" ng-controller="searchController">
    <h3>Advanced Job Search</h3>
    <div class="row advancedSearch">
        <form>
            <label>Keyword</label>
            <input type="text" ng-model="search.keyword" /><br>
            <label>Location</label>
            <input type="text" ng-model="search.location" /><br>
            <label>Area Code</label>
            <input type="text" ng-model="search.areaCode" /><br>
            <label>Job Title</label>
            <input type="text" ng-model="search.jobTitle" /><br>
            <label>Job Type</label>
            <select ng-model="search.jobType">
                <option value="1">Contract</option>
                <option value="2">Full Time</option>
            </select><br>
            <label>Job Posted</label>
            <select ng-model="search.jobPosted">
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="7">7</option>
                <option value="30">30</option>
                <option value="0">All</option>
            </select><br>
            <button type="button" class="findJob" ng-click="getJobInfo(search)">Find Jobs</button>
        </form>
    </div>
    <div ng-if="hasJobData">
        <div class="row" ng-repeat="job in jobList">
            <a href="preview?jobId={{job.job_id}}" target="_blank"><h5>{{job.title}}</h5></a>
            <div>{{job.description}}</div>
        </div>
    </div>
     <div ng-if="!hasJobData">
        Jobs not available. Please try again.
    </div>
</div>

