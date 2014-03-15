'use strict';

var getJobsModule = angular.module('getJobs', ['shared']);

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

getJobsModule.controller('getJobsController', function($scope, $http, $filter, myJobsService) {

    $scope.jobs = [ {name : "Active jobs", value:"1"},
                    {name:"Inactive jobs", value:"0"} ];
    $scope.myJob = {};

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
        console.log($scope.selectedJobs);

        var deleteJob = $http({
            method: 'POST',
            data: "status="+$scope.selectedJobs,
            url: globals.path + 'api/employer/delete',
            headers: {'Content-Type': 'application/x-www-form-urlencoded'}
        });

        deleteJob.success(function(response){
           console.log(response);
        });
    };

    $scope.activeJobs = function(){
        console.log($scope.selectedJobs);

        var activeJob = $http({
            method: 'POST',
            data: "status="+$scope.selectedJobs,
            url: globals.path + 'api/employer/active',
            headers: {'Content-Type': 'application/x-www-form-urlencoded'}
        });

        activeJob.success(function(response){
            console.log(response);
        });
    };

    $scope.inActiveJobs = function(){
        console.log($scope.selectedJobs);

        var inActiveJob = $http({
            method: 'POST',
            data: "status="+$scope.selectedJobs,
            url: globals.path + 'api/employer/inactive',
            headers: {'Content-Type': 'application/x-www-form-urlencoded'}
        });

        inActiveJob.success(function(response){
            console.log(response);
        });
    };
});
