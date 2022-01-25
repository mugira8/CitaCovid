var MyApp = angular.module("myApp", []);

MyApp.controller('miControlador',['$scope','$http', function($scope,$http){

    
    $http.get('controller/cHistorial.php').then(function (response){
        $scope.lista = response.data.list;
        
    });

    /* NS DE QUE CONTROLADOR COGER PARA MOSTRAR PACIENTES
    $http.get('controller/').then(function (response){
        $scope.lista = response.data.list; 
    });
    */

    $scope.confirmarEditar = function() {
        var listaModificacion = {TIS: $scope.item.Tis , nombre: $scope.item.Nombre , apellido: $scope.item.Apellido};
        console.log(listaModificacion)
        $http({url: "controlador/cPacienteUpdate.php",
        method: "GET",
        params: {value: listaModificar}
    }).then(function(response) {
        window.location.reload();
    })
    }

    $scope.verHistorial = function() {
        $scope.ver = "si";
    }

}]);
