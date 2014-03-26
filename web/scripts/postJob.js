'use strict';

var jobPostModule = angular.module('postJob', ['shared'], function($locationProvider) {
    $locationProvider.html5Mode(true);
});

jobPostModule.factory('userService', function($http) {

    var userInfo = {};

    userInfo.getUserDetails = function() {
        return $http({
            method: 'POST',
            url: globals.path + 'api/user/details',
            headers: {'Content-Type': 'application/x-www-form-urlencoded'}
        });
    };

    userInfo.updateJobDetails = function(jobId) {
        return $http({
            method: 'GET',
            url: globals.path + 'api/employer/preview?jobId='+jobId,
            headers: {'Content-Type': 'application/x-www-form-urlencoded'}
        });
    };

    return userInfo;
});

jobPostModule.controller('PostJobController', function($scope, $rootScope, $http, $templateCache, userService, $location, countryApiService) {

    $scope.jobPosition = [{
            "position": "Full-time",
            "id": 1
        }, {
            "position": "Part-time",
            "id": 2
        }, {
            "position": "Contract - corp-to-corp",
            "id": 3
        }, {
            "position": "Contract - Independent",
            "id": 4
        }, {
            "position": "Contract - W2",
            "id": 5
        }, {
            "position": "Contract to hire - corp-to-corp",
            "id": 6
        }, {
            "position": "Contract to hire - Independent",
            "id": 7
        }];

    $scope.job = {};
    $scope.job.apply = 'email';
    $scope.job.status = '1'; // active job
    $scope.userDetails = [];
    
    $rootScope.showpreviewbtns = 'no';

    $scope.jobId = $location.search()['jobId'];
    $scope.jobUpdate = angular.isDefined($location.search()['jobId']);

    if($scope.jobUpdate){
        userService.updateJobDetails($scope.jobId).success(function(response) {

            $scope.job = response.data;
            $scope.job.expiryDate = response.data.modified;
            $scope.job.status = response.data.job_status;
            $scope.job.position = [response.data.position_type];
            $scope.job.apply = response.data.application_method;
            $scope.job.email = response.data.application_email;
            $scope.job.CCemail = response.data.application_email_cc;
            $scope.job.url = response.data.application_url;
            $scope.job.url = response.data.application_url;

            $scope.job.countryName = response.data.country;
            $scope.job.country = response.data.countryId;

            $scope.job.stateName = response.data.state;
            $scope.job.state = response.data.stateId;
            countryApiService.getStates($scope.job.country).success(function(response) {
                $scope.state_info = response.data;
            });
            
            $scope.job.cityName = response.data.city;
            $scope.job.city = response.data.cityId;
            countryApiService.getCities($scope.job.state).success(function(response) {
                $scope.city_info = response.data;
            });

            $scope.job.areaCode = response.data.area_code;
            $scope.job.postalCode = response.data.zip_code;
            $scope.job.skills = response.data.skills;
            $scope.job.description = response.data.description;
            $scope.job.contact_name = response.data.show_name;
            $scope.job.contact_address1 = response.data.show_address1;
            $scope.job.contact_address2 = response.data.show_address2;
            $scope.job.contact_city = response.data.get_show_city;
            $scope.job.contact_state = response.data.show_state;
            $scope.job.contact_zip = response.data.show_zipcode;
            $scope.job.contact_phone = response.data.show_phone;
            $scope.job.contact_email = response.data.show_email;
        });
    }
    userService.getUserDetails().success(function(response) {
        $scope.userDetails = response.data;
    });

    $scope.submitJob = function() {

        if ($scope.jobForm.$valid) {
            $http({
                method: 'POST',
                url: globals.path + 'api/employer/post',
                data: $.param($scope.job), /* pass in data as strings*/
                headers: {'Content-Type': 'application/x-www-form-urlencoded'}  /* set the headers so angular passing info as form data (not request payload)*/
            })
                    .success(function(data) {
                        console.log(data);

                        if (!data.success) {
                            // if not successful, bind errors to error variables
                            $scope.message = data.message;
                        } else {
                            // if successful, bind success message to message
                            $scope.message = data.message;
                            window.location.href = globals.path + 'employer/post/confirm';
                        }
                    });
        } else {
            $scope.message = "There are required fields to complete";
        }
    };
    
    $scope.submitJobasInactive = function() {
        $scope.job.status = '0'; // inActive job
        $scope.submitJob();
    };

    $scope.updateJob = function(jobId) {

        if ($scope.jobForm.$valid) {
            $http({
                method: 'POST',
                url: globals.path + 'api/employer/update?jobId='+jobId,
                data: $.param($scope.job), /* pass in data as strings*/
                headers: {'Content-Type': 'application/x-www-form-urlencoded'}  /* set the headers so angular passing info as form data (not request payload)*/
            })
                .success(function(data) {
                    console.log(data);

                    if (!data.success) {
                        // if not successful, bind errors to error variables
                        $scope.message = data.message;
                    } else {
                        // if successful, bind success message to message
                        $scope.message = data.message;
                        window.location.href = globals.path + 'employer/post/confirm';
                    }
                });
        } else {
            $scope.message = "There are required fields to complete";
        }
    };
    
    
    //popup
    $scope.externalPopopen = function(popupid) {
        console.log("external Controller");
        var templateCacheId = 'example1-template';
        var html = $templateCache.get(templateCacheId);
        if (!html) {
            $http.get('jobPreview.html.php').success(function(html) {
                loadDidComplete(html);
            });
        }
        else {
            loadDidComplete(html);
        }
    };
    $scope.loadDidComplete = function(html) {
        $templateCache.put(templateCacheId, html);
        $scope.$broadcast('open_ngpopup', {id: popupid, template: templateCacheId});
    };

    $scope.internalPopOpen = function(popupid, templateId) {
        $scope.$broadcast('open_ngpopup', {id: popupid, template: templateId});
    };
    
    
});


