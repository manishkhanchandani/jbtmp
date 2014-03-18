'use strict';

var previewJobsModule = angular.module('previewJob', ['shared'], function($locationProvider) {
    $locationProvider.html5Mode(true);
});

previewJobsModule.controller('previewJobController', function($scope, $http, $location) {

    var jobId = $location.search()['jobId'];
console.log(jobId);
    var previewJob = $http({
        method: 'GET',
        url: globals.path + 'api/employer/preview?jobId='+jobId,
        headers: {'Content-Type': 'application/x-www-form-urlencoded'}
    });

    previewJob.success(function(response){
        $scope.job = response.data;
        console.log($scope.job);
    });
});
