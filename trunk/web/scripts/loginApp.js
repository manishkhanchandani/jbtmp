
//"use strict";

/* Declare app level module which depends on filters, and services */
var app = angular.module('jobApp', []);

app.directive('autofillable', ['$timeout', function ($timeout) {
    return {
        require: 'ngModel',
        scope: {},
        link: function (scope, elem, attrs, ctrl) {
            scope.check = function(){
                var val = elem[0].value;
                if(ctrl.$viewValue !== val){
                    //var isPristine = false;
                    //if(ctrl.$pristine) isPristine = true;
                    ctrl.$setViewValue(val);
                    //if the form control was originally pristine, set it back to pristine
                   	//ctrl.$pristine = isPristine;
                }
                $timeout(scope.check, 300);
            };
            scope.check();
        }
    };
}]);

/* Controllers */
app.controller('LoginController', function($scope, $http) {

    $scope.session = {};
    $scope.login = function() {
        //$scope.session.email = 'swathi.paipalle@yahoo.com'

        $http({
            method: 'POST',
            url: globals.path + 'api/user/login',
            data: $.param($scope.session), // pass in data as strings
            headers: {'Content-Type': 'application/x-www-form-urlencoded'}  // set the headers so angular passing info as form data (not request payload)
        }).success(function(data) {
            //console.log(data);

            if (!data.success) {
                // if not successful, bind errors to error variables
                $scope.message = data.message;
            } else {
                // if successful, bind success message to message
                $scope.message = data.message;
                if (data.redirectUrl) {
                    window.location.href = data.redirectUrl;
                }
            }
        });
    };
});

app.controller('jobController', function($scope, $http) {
    $http({
            method: 'GET',
            url: globals.host_url + '/custom/home.php'
            //headers: {'Content-Type': 'application/x-www-form-urlencoded'}  // set the headers so angular passing info as form data (not request payload)
        }).success(function(response) {
            console.log(response);

            if (response.success) {
//                $scope.city = response.data.city;
//                $scope.state = response.data.state;
//                $scope.country = response.data.country;
//                $scope.description = response.data.description;
                $scope.recentJobs = response.data;
            }
        });
});