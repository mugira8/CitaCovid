var MyApp = angular.module('miApp', []);

MyApp.controller('miControlador',['$scope','$http', function($scope,$http){

    $http.get('').then(function (response){
        $scope.lista = response.data;
    });

}]);
