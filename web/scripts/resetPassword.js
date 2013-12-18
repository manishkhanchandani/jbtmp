var appModule = angular.module('App', []);

appModule.controller('Controller', function($scope, $http){
    $scope.user = {};

    $scope.submit = function() {
        $http({
            method: 'POST',
            url: globals.path + 'api/user/reset',
            data: $.param($scope.user), /* pass in data as strings*/
            headers: {'Content-Type': 'application/x-www-form-urlencoded'}  /* set the headers so angular passing info as form data (not request payload)*/
        })
        .success(function(data) {
            console.log(data);

            if (!data.success) {
                // if not successful, bind errors to error variables
                $scope.message = "Invalid password";
            } else {
                // if successful, bind success message to message
                $scope.message = "Password updated.";
            }
        });
    }
});


