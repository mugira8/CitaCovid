imagenesCarrusel = [
    "https://www.osakidetza.euskadi.eus/images/ab84-osakidetza-como-actuo-covid-es.jpg",
    "https://www.osakidetza.euskadi.eus/images/ab84-osakidetza-taller-online-tabaco.png",
    "https://www.osakidetza.euskadi.eus/images/ab84-banner-vac-infantil-covid.jpg"
]
var myApp = angular.module("myApp", []);
myApp.controller("mainController", ["$scope", "$http", function($scope, $http){

$http.get("view/js/articulos.json").then(function(response){
    $scope.articulo = response.data;
});
}]);

var estado = "active";
for (let i = 0; i < imagenesCarrusel.length; i++) {
if (i>0) { //Pone la clase active solo en el primer item del carrusel
    estado = ""
}
    document.getElementById("myCarouselInner").innerHTML +=`
    <div class="carousel-item `+ estado +`">
        <div class="carousel-img"
            style="background-image: url(`+ imagenesCarrusel[i] +`);">
        </div>
    </div>`;
}
for (let i = 0; i < imagenesCarrusel.length; i++) {
    if(i==0){
        var element = document.getElementById
    }
}

var esNuevo = `<span class="badge bg-danger ">New</span>`;