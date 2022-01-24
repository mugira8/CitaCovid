imagenesCarrusel = [
  "https://www.osakidetza.euskadi.eus/images/ab84-osakidetza-como-actuo-covid-es.jpg",
  "https://www.osakidetza.euskadi.eus/images/ab84-osakidetza-taller-online-tabaco.png",
  "https://www.osakidetza.euskadi.eus/images/ab84-banner-vac-infantil-covid.jpg",
];
var myApp = angular.module("myApp", []);
myApp.controller("mainController", [
  "$scope",
  "$http",
  function ($scope, $http) {
    $http.get("view/js/articulos.json").then(function (response) {
      $scope.articulo = response.data;
      $scope.imagen = imagenesCarrusel;
    });
  },
]);

myApp.controller("editPerfil", [
  "$scope",
  "$http",
  function ($scope, $http) {
    $http.get("controller/").then(function (response) {
      $scope.lista = response.data.list;
    });

    $scope.confirmarEditar = function () {
      var listaModificacion = {
        TIS: $scope.item.Tis,
        nombre: $scope.item.Nombre,
        apellido: $scope.item.Apellido,
      };
      console.log(listaModificacion);
      $http({
        url: "controlador/cPacienteUpdate.php",
        method: "GET",
        params: { value: listaModificar },
      }).then(function (response) {
        window.location.reload();
      });
    };
  },
]);

myApp.controller("administrar", [
  "$scope",
  "$http",
  function ($scope, $http) {
    $http.get("controller/").then(function (response) {
      $scope.lista = response.data.list;
    });

    $scope.confirmar = function () {
      var lista = {
        Nombre: $scope.item.nombre,
        Municipio: $scope.item.municipio,
        Lunes: $scope.item.lunes,
        Martes: $scope.item.martes,
        Miercoles: $scope.item.miercoles,
        Jueves: $scope.item.jueves,
        Sabado: $scope.item.sabado,
        Domingo: $scope.item.domingo,
        Hora_apertura: $scope.item.hora_apertura,
        Hora_cierre: $scope.item.hora_cierre,
      };
      console.log(lista);
      $http({
        url: "controlador/cAdministrar.php",
        method: "GET",
        params: { value: lista },
      }).then(function (response) {
        window.location.reload();
      });
    };
  },
]);
