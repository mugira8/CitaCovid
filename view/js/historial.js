var MyApp = angular.module("myApp", []);

MyApp.controller('miControlador', ['$scope', '$http', function ($scope, $http) {

    $http.get('controller/cSessionVarsView.php').then(function (response) {

        objPaciente = response.data;

        $scope.paciente = objPaciente.paciente;
    });

    sessionVarsView()
    function sessionVarsView() {
        var url = "controller/cSessionVarsView.php";
        fetch(url, {
            method: 'GET',
            headers: { 'Content-Type': 'application/json' }
        }).then(res => res.json()).then(result => {
            objPaciente = result;

            url = 'controller/cHistorial.php';
            var data = { "TIS": result.paciente.tis };
            fetch(url, {
                method: 'POST',
                body: JSON.stringify(data),
                headers: { 'Content-Type': 'application/json' }
            }).then(res => res.json()).then(result => {
                objPaciente = result;
                $scope.lista = result.list;
            });
        });
    }

    $scope.verHistorial = function () {
        $scope.ver = "si";
    }

}]);

var savedFileBase64;
var filename = '';
var filesize;
var sesion;

$("#fotoInsertar").on('change', function () {
    changeFitx("update");
});

function changeFitx(action) {
    console.log(event.currentTarget.files[0])
    var file = event.currentTarget.files[0];
    var reader = new FileReader();
    filename = file.name;
    filesize = file.size;
    if (!new RegExp("(.*?).(jpg|jpeg|png|gif|JPG|JPEG|PNG|GIF)$").test(filename)) {
        alert("Solo se aceptan imágenes JPG, PNG y GIF");
        $("#fotoInsertar").val() = "";
        $("#btnEnviar").val() = "";
    } else {
        reader.onloadend = function () {
            savedFileBase64 = reader.result;     // Almacenar en variable global para uso posterior	  
        }
        if (file) {
            reader.readAsDataURL(file);
        } else {
            if (action == "update") {
                $("filmPhotoUpdateOld").attr("src", "");
                $("filmPhotoUpdateNew").attr("src", "");
            }
        }

    }
}

function execUpdate() {

    var url = "controller/cSessionVarsView.php";
    fetch(url, {
        method: 'GET',
        headers: { 'Content-Type': 'application/json' }
    }).then(res => res.json()).then(result => {
        sesion = result;
        if ($("#nombre").val() == "") {
            var nombre = $("#nombre").attr('placeholder');

        } else {
            var nombre = $("#nombre").val();
        }
        if ($("#apellido").val() == "") {
            var apellido = $("#apellido").attr('placeholder');

        } else {
            var apellido = $("#apellido").val();
        }
        if (filename == '') {
            filename = sesion.paciente.foto
        }
        var tis = sesion.paciente.tis;
        var url = "controller/cPacienteUpdate.php";
        var data = { 'TIS': tis, 'Nombre': nombre, 'Apellido': apellido, 'filename': filename, 'savedFileBase64': savedFileBase64 };
        fetch(url, {
            method: 'POST',
            body: JSON.stringify(data),
            headers: { 'Content-Type': 'application/json' }
        })
            .then(res => res.json()).then(result => {
                switch (result.error) {
                    case 1:
                        alert("Perfil editado correctamente");
                        break;
                    case 0:
                        alert("Ha ocurrido un error a la hora de editar");
                        break;
                }
                var tis = sesion.paciente.tis;
                var fecha = sesion.paciente.fecha;
                var url = "controller/cLoginPaciente.php";
                var data = { 'tis': tis, 'fecha': fecha }
                fetch(url, {
                    method: 'POST',
                    body: JSON.stringify(data),
                    headers: { 'content-type': 'application/json' }
                }).then(res => res.json()).then(result => {
                    switch (result.error) {
                        case "no error":
                            $("#errorLogin").text("");
                            $("#iniciarSesion").css('display', 'none');
                            $("#cerrarSesion").css('display', 'block');
                            $("#btnEditarPerfil").css('display', 'block');
                            $("#btnAdministrar").css('display', 'none');
                            $("#btnCita").css('display', 'block');
                            $("#btnHistorial").css('display', 'block');
                            $("#iniciarSesion").css('display', 'none');
                            $("#cerrarSesion").css('display', 'block');
                            $('#login').modal('toggle');
                            $("#navbarIcon").css('display', 'none');
                            $("#navbarFoto").css('display', 'block');
                            $('#usuario').removeAttr('data-bs-target');
                            $('#administrar').removeAttr('data-bs-target');
                            $("#usuario").text(result.nombre);
                            $("#navbarFoto").attr("src", "uploads/" + result.foto)
                            $('#fotoPerfil').attr("src", "uploads/" + result.foto)
                            break;
                    }
                })

                var inputs = document.querySelectorAll("#btnEnviar");
                for (let i = 0; i < inputs.length; i++) {
                    inputs[i].value = "";
                }
                var imgs = document.querySelectorAll("#fotoPerfil");
                for (let i = 0; i < imgs.length; i++) {
                    imgs[i].setAttribute('src', '');
                }

                document.getElementById("usuario").innerHTML = result.nombre;
                document.getElementById("navbarFoto").setAttribute('src', result.foto);

            })
    });
}