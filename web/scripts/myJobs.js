'use strict';

var getJobsModule = angular.module('getJobs', ['shared', 'ngSanitize']);

getJobsModule.factory('myJobsService', function($http) {

    var jobInfo = {};
    jobInfo.getjobDetails = function() {
        return $http({
            method: 'GET',
            url: globals.path + 'api/myjobs',
            headers: {'Content-Type': 'application/x-www-form-urlencoded'}
        });
    };
    return jobInfo;
});

getJobsModule.controller('getJobsController', function($scope, $http, $filter, $window, myJobsService) {

    $scope.jobs = [ {name : "Active jobs", value:"1"},
                    {name:"Inactive jobs", value:"0"} ];
    $scope.myJob = {};
    $scope.jobStatusInactive = '1';
    $scope.jobStatusActive = '1';
    
    myJobsService.getjobDetails().success(function(response) {
        $scope.myJob = response.data;
    });


    $scope.selectedJobs = [];
    $scope.updateSelectedJobs = function toggleSelection(jobId) {
        var idx = $scope.selectedJobs.indexOf(jobId);

        // is currently selected
        if (idx > -1) {
            $scope.selectedJobs.splice(idx, 1);
        }

        // is newly selected
        else {
            $scope.selectedJobs.push(jobId);
        }
    };



    $scope.deleteJobs = function(){
        var deleteJob = $http({
            method: 'POST',
            data: "status="+$scope.selectedJobs,
            url: globals.path + 'api/employer/delete',
            headers: {'Content-Type': 'application/x-www-form-urlencoded'}
        });

        deleteJob.success(function(response){
           $scope.jobDelete = {};
           angular.forEach($scope.selectedJobs, function(value, key) {
               $scope.jobDelete['job_'+value] = '1';
            });
        });
    };

    $scope.activeJobs = function(){
        var activeJob = $http({
            method: 'POST',
            data: "status="+$scope.selectedJobs,
            url: globals.path + 'api/employer/active',
            headers: {'Content-Type': 'application/x-www-form-urlencoded'}
        });
        
        activeJob.success(function(response){
            $window.location.reload();
            /*$scope.jobStatusInactive = '0';
            $scope.jobStatus = {};
            angular.forEach($scope.selectedJobs, function(value, key) {
               $scope.jobStatus['job_'+value] = 'Active';
            });*/
        });
    };

    $scope.inActiveJobs = function(){
        var inActiveJob = $http({
            method: 'POST',
            data: "status="+$scope.selectedJobs,
            url: globals.path + 'api/employer/inactive',
            headers: {'Content-Type': 'application/x-www-form-urlencoded'}
        });

        inActiveJob.success(function(response){
            $window.location.reload();
            /*$scope.jobStatusActive = '0';
            $scope.jobStatus = {};
            angular.forEach($scope.selectedJobs, function(value, key) {
               $scope.jobStatus['job_'+value] = 'Inactive';
            });*/
        });
    };
});
