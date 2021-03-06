var appModule = angular.module('App', []);

appModule.controller('Controller', function($scope, $http){
    $scope.user = {};

    $scope.submit = function() {
        $http({
            method: 'POST',
            url: globals.path + 'api/user/forgot',
            data: $.param($scope.user), /* pass in data as strings*/
            headers: {'Content-Type': 'application/x-www-form-urlencoded'}  /* set the headers so angular passing info as form data (not request payload)*/
        })
        .success(function(data) {
            console.log(data);

            if (!data.success) {
                // if not successful, display an error message
                $scope.message = "Invalid e-mail address.";
            } else {
                // if successful, display the following message
                $scope.message = "Your password has been sent to your e-mail address.";
                $scope.user.email = "";
                //alert("Your password has been sent to your e-mail.")
            }
        });
    }
});
