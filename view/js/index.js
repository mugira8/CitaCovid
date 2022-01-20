imagenesCarrusel = [
  "https://www.osakidetza.euskadi.eus/images/ab84-osakidetza-como-actuo-covid-es.jpg",
  "https://www.osakidetza.euskadi.eus/images/ab84-osakidetza-taller-online-tabaco.png",
  "https://www.osakidetza.euskadi.eus/images/ab84-banner-vac-infantil-covid.jpg",
];
var myApp = angular.module("myApp", []);
myApp.controller("mainController", ["$scope", "$http", function($scope, $http){

$http.get("view/js/articulos.json").then(function(response){
    $scope.articulo = response.data;
    $scope.imagen = imagenesCarrusel;
});

}]);


myApp.controller("prueba", ["$scope", "$http", function($scope, $http){

    $http.get('controller/cHistorial.php').then(function (response){
        $scope.lista = response.data.list;
    });

}]);


//var esNuevo = `<span class="badge bg-danger ">New</span>`;
