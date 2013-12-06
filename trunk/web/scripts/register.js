angular.module('App', []);

function Controller($scope, $http) {
    
    $scope.user = {};

    $scope.submit = function() {
        $http({
            method: 'POST',
            url: globals.path + 'api/user/add',
            data: $.param($scope.user), // pass in data as strings
            headers: {'Content-Type': 'application/x-www-form-urlencoded'}  // set the headers so angular passing info as form data (not request payload)
        })
        .success(function(data) {
            console.log(data);

            if (!data.success) {
                // if not successful, bind errors to error variables
                $scope.message = data.message;
            } else {
                // if successful, bind success message to message
                $scope.message = data.message;
            }
        });
    }
}

function countriesController($scope) {
    $scope.countries = [{
            "name": "USA",
            "id": 1
        }, {
            "name": "Canada",
            "id": 2
        }];
    $scope.states = [{
            "name": "Alabama",
            "id": 1,
            "countryId": 1
        }, {
            "name": "Alaska",
            "id": 2,
            "countryId": 1
        }, {
            "name": "Arizona",
            "id": 3,
            "countryId": 1
        }, {
            "name": "Alberta",
            "id": 4,
            "countryId": 2
        }, {
            "name": "British columbia",
            "id": 5,
            "countryId": 2
        }];

    $scope.updateCountry = function() {
        $scope.availableStates = [];

        angular.forEach($scope.states, function(value) {
            if (value.countryId == $scope.user.country.id) {
                $scope.availableStates.push(value);
            }
        });
    }
}