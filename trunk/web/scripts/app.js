var sharedModule=angular.module('shared',[]);

sharedModule.factory('countryApiService', function($http) {

    var addressApi = {};

    addressApi.getCountry = function() {
        return $http({
            method: 'POST',
            url: globals.path + 'api/geo/countries',
            headers: {'Content-Type': 'application/x-www-form-urlencoded'}
        });
    };

    addressApi.getStates = function(id) {
        return $http({
            method: 'POST',
            url: globals.path + 'api/geo/states?id=' + id,
            headers: {'Content-Type': 'application/x-www-form-urlencoded'}
        });
    };

    addressApi.getCities = function(id) {
        return $http({
            method: 'POST',
            url: globals.path + 'api/geo/cities?id=' + id,
            headers: {'Content-Type': 'application/x-www-form-urlencoded'}
        });
    };
    return addressApi;
});

sharedModule.controller('countriesController', function($scope, countryApiService) {

    $scope.countries = [];
    $scope.states = [];
    $scope.cities = [];

    countryApiService.getCountry().success(function(response) {
        $scope.countries = response.data;
    });

    $scope.updateState = function(id) {
        countryApiService.getStates(id).success(function(response) {
            $scope.states = response.data;
        });
    };

    $scope.updateCity = function(id) {
        countryApiService.getCities(id).success(function(response) {
            $scope.cities = response.data;
        });
    };
});
