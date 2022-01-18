var MyApp = angular.module('miApp', []);

MyApp.controller('miControlador',['$scope','$http', function($scope,$http){

    $http.get('controller/').then(function (response){

        // $scope.lista = response.data.list;
        
    });


    $scope.habilitarEdit=function() {

       alert("Hola")

    }
    
}]);