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

getJobsModule.controller('getJobsController', function($scope, $http, myJobsService) {

    $scope.myJob = {};

    myJobsService.getjobDetails().success(function(response) {
        $scope.myJob = response.data;
    });
    console.log($scope.myJob);
});
