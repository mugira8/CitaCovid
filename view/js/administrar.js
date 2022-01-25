var administrar = angular.module("myApp", []);

administrar.controller('miControlador', ['$scope', '$http', function ($scope, $http) {
    $http.get('controller/cLoadCentros.php').then(function (response) {
        $scope.lista = response.data.list;
    });
}]);

function mostrar(cod_centro) {
    if (cod_centro != "nuevo") {
        var url = "controller/cGetCentro.php";
        var data = { 'cod_centro': cod_centro }
        fetch(url, {
            method: 'POST',
            body: JSON.stringify(data),
            headers: { 'content-type': 'application/json' }
        }).then(res => res.json()).then(result => {
            let centro = result.centro
            $('#nombreCentro').val(centro.Nombre);
            $('#municipio').val(centro.Municipio);
            if (centro.Lunes > 0) {
                $('#checkLunes').prop('checked', true)
            } else {
                $('#checkLunes').prop('checked', false)
            }
            if (centro.Martes > 0) {
                $('#checkMartes').prop('checked', true)
            } else {
                $('#checkMartes').prop('checked', false)
            }
            if (centro.Miercoles > 0) {
                $('#checkMiercoles').prop('checked', true)
            } else {
                $('#checkMiercoles').prop('checked', false)
            }
            if (centro.Jueves > 0) {
                $('#checkJueves').prop('checked', true)
            } else {
                $('#checkJueves').prop('checked', false)
            }
            if (centro.Viernes > 0) {
                $('#checkViernes').prop('checked', true)
            } else {
                $('#checkViernes').prop('checked', false)
            }
            if (centro.Sabado > 0) {
                $('#checkSabado').prop('checked', true)
            } else {
                $('#checkSabado').prop('checked', false)
            }
            if (centro.Domingo > 0) {
                $('#checkDomingo').prop('checked', true)
            } else {
                $('#checkDomingo').prop('checked', false)
            }
            $('#apertura').val(centro.Hora_apertura);
            $('#cierre').val(centro.Hora_cierre);
        })
    }
}

function confirmar() {
    let selected = $('#centros').val();
    if (selected == 'limpiar') {
        $('#errorCentro').html('Seleccione centro')
    } else if (selected == 'nuevo') {
        $('#errorCentro').html('')
        crearCentro()
    } else {
        $('#errorCentro').html('')
        editarCentro()
    }
}

function crearCentro() {
    let nombre = $('#nombreCentro').val()
    let municipio = $('#municipio').val()
    let lunes = $('#checkLunes').prop('checked');
    let martes = $('#checkMartes').prop('checked');
    let miercoles = $('#checkMiercoles').prop('checked');
    let jueves = $('#checkJueves').prop('checked');
    let viernes = $('#checkViernes').prop('checked');
    let sabado = $('#checkSabado').prop('checked');
    let domingo = $('#checkDomingo').prop('checked');
    let apertura = $('#apertura').val();
    let cierre = $('#cierre').val();

    let url = 'controller/cInsertCentro.php';
    let data = {
        'nombre': nombre, 'municipio': municipio, 'lunes': lunes, 'martes': martes,
        'miercoles': miercoles, 'jueves': jueves, 'viernes': viernes, 'sabado': sabado,
        'domingo': domingo, 'apertura': apertura, 'cierre': cierre
    }
    fetch(url, {
        method: 'POST',
        body: JSON.stringify(data),
        headers: { 'content-type': 'application/json' }
    }).then(res => res.json()).then(result => {
        console.log(result)
        $('#correctoCentro').html('Se ha AÑADIDO correctamente')
    })
}

function editarCentro() {
    let id = $('#centros').val();
    let nombre = $('#nombreCentro').val()
    let municipio = $('#municipio').val()
    let lunes = $('#checkLunes').prop('checked');
    let martes = $('#checkMartes').prop('checked');
    let miercoles = $('#checkMiercoles').prop('checked');
    let jueves = $('#checkJueves').prop('checked');
    let viernes = $('#checkViernes').prop('checked');
    let sabado = $('#checkSabado').prop('checked');
    let domingo = $('#checkDomingo').prop('checked');
    let apertura = $('#apertura').val();
    let cierre = $('#cierre').val();

    let url = 'controller/cEditCentro.php';
    let data = {
        'id': id,'nombre': nombre, 'municipio': municipio, 'lunes': lunes, 'martes': martes,
        'miercoles': miercoles, 'jueves': jueves, 'viernes': viernes, 'sabado': sabado,
        'domingo': domingo, 'apertura': apertura, 'cierre': cierre
    }
    fetch(url, {
        method: 'POST',
        body: JSON.stringify(data),
        headers: { 'content-type': 'application/json' }
    }).then(res => res.json()).then(result => {
        console.log(result)
        $('#correctoCentro').html('Se ha EDITADO correctamente')
    })
}

function deleteCentro() {

}
