
//"use strict";

/* Declare app level module which depends on filters, and services */
var app = angular.module('searchApp', []);

app.config(['$locationProvider', function($locationProvider) {
     $locationProvider.html5Mode(true);
}]);

/* Controllers */
app.controller('searchController', function($scope, $http, $location) {
    
    $scope.search = {};
    $scope.search.keyword = '';
    $scope.search.location = '';
    $scope.search.areaCode = '';
    $scope.search.jobTitle = '';
    $scope.search.jobType = '';
    $scope.search.location = '';
    $scope.search.jobPosted = '';
    
    $scope.jobService = function(param){
        $http({
            method: 'GET',
            url: globals.host_url + '/custom/home.php?'+param
        }).success(function(response) {
                    
            if(response.totalRows_rsView > '0')
            {
                $scope.hasJobData = true;
            }
            else
            {
                $scope.hasJobData = false;
            }
            
            $scope.jobList = response.data;
        });
    };
    
    if(angular.isDefined($location.search()['q'])){
        $scope.search.keyword = $location.search()['q'];
    }
    if(angular.isDefined($location.search()['location'])){
        $scope.search.location = $location.search()['location'];
    }
    
    var param = 'q='+$scope.search.keyword+'&location='+$scope.search.location;    
    $scope.jobService(param);
    
    $scope.getJobInfo = function(search) {
        var param = 'q='+$scope.search.keyword+'&location='+$scope.search.location+'&areaCode='+$scope.search.areaCode+'&jobTitle='+$scope.search.jobTitle+'&jobType='+$scope.search.jobType+'&jobPosted='+$scope.search.jobPosted;
        $scope.jobService(param);
    };
});
