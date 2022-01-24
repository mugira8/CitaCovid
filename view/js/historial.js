var MyApp = angular.module("myApp", []);

MyApp.controller('miControlador',['$scope','$http', function($scope,$http){

    
    $http.get('controller/cHistorial.php').then(function (response){
        $scope.lista = response.data.list;
        
    });

}]);
