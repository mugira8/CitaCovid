var MyApp = angular.module("myApp", []);



MyApp.controller('miControlador',['$scope','$http', async function($scope,$http){
    sessionVarsView()
    async function sessionVarsView() {
        var url = "controller/cSessionVarsView.php";
        fetch(url, {
            method: 'GET',
            headers: { 'Content-Type': 'application/json' }
        }).then(res => res.json()).then(result => {
            console.log('session result', result)
            console.log(window.location.href)
            objPaciente = result;
            
            url= 'controller/cHistorial.php';
            var data = {"TIS": result.paciente.tis};
            fetch(url, {
                method: 'POST',
                body: JSON.stringify(data),
                headers: { 'Content-Type': 'application/json' }
            }).then(res => res.json()).then(result => {
                console.log('session result', result)
                console.log(window.location.href)
                objPaciente = result;
                
                console.log(result)
                $scope.lista = result.list;
    
            });
        });

        var url = "controller/cSessionVarsView.php";
        fetch(url, {
            method: 'GET',
            headers: { 'Content-Type': 'application/json' }
        }).then(res => res.json()).then(result => {
            console.log('session result', result)
            console.log(window.location.href)
            objPaciente = result;
            
            url= 'controller/cLoadPacientes.php';
            var data = {"TIS": result.paciente.tis};
            fetch(url, {
                method: 'POST',
                body: JSON.stringify(data),
                headers: { 'Content-Type': 'application/json' }
            }).then(res => res.json()).then(result => {
                console.log('session result', result)
                console.log(window.location.href)
                objPaciente = result;
                
                console.log(result)
                $scope.lista = result.list;
    
            });
        });
    }


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
