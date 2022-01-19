$(document).ready(sessionVarsView);

function sessionVarsView() {
    var url = "controller/cSessionVarsView.php";
    fetch(url, {
        method: 'GET',
        headers: { 'Content-Type': 'application/json' }
    }).then(res => res.json()).then(result => {
        $("#btnBanca").css('display', 'none');

        if (result.error == "no error") {
            $("#btnProductos").css('display', 'block');
            $("#btnEditar").css('display', 'none');
            $("#btnInsertar").css('display', 'none');
            $("#ddLg").css('display', 'none');
            $("#ddReg").css('display', 'none');
            $("#ddLo").css('display', 'block');
            if(window.location.href.includes("index")){
                $('#nomUsu').attr('data-bs-target', '#userModal');
            }  else{
                $('#nomUsu').removeAttr('data-bs-target');

            }     
            $("#nomUsu").text(result.usuario.nombre);
            $('#nameUser').val(result.usuario.nombre);
            $('#emailUser').val(result.usuario.email)

            if (result.usuario.admin == 1) {
                $("#btnBanca").css('display', 'block');
                $("#btnEliminar").css('display', 'block');
                $("#btnEditar").css('display', 'block');
                $("#btnInsertar").css('display', 'block');

            }
        }else{
            if(!window.location.href.includes("index")){
                window.location.href = "index.html";
            }        
        }
      
    })
}

//En el formulario al darle a enter que pase al siguiente input
jQuery.extend(jQuery.expr[':'], {
    focusable: function (el, index, selector) {
        return $(el).is(':input');
    }
});
$(document).on('keydown', ':focusable', function (e) {
    if (e.which == 13) {
        e.preventDefault();
        // Get all focusable elements on the page
        var $canfocus = $(':focusable');
        var index = $canfocus.index(this) + 1;
        if (index >= $canfocus.length) index = 0;
        $canfocus.eq(index).focus();
    }
});


//Login Paciente
function login() {
    var tis = $("#insertTis").val();
    var fecha = $("#insertFecha").val();
    console.log('values', tis, fecha)
    var url = "controller/cLogin.php";
    var data = { 'email': email, 'contrasenia': contrasenia }
    fetch(url, {
        method: 'POST',
        body: JSON.stringify(data),
        headers: { 'content-type': 'application/json' }
    }).then(res => res.json()).then(result => {

        switch (result.error) {
            case "no error":
                $("#btnProductos").css('display', 'block');
                $("#errorLogin").text("");
                $("#ddLg").css('display', 'none');
                $("#ddReg").css('display', 'none');
                $("#ddLo").css('display', 'block');
                $('#login').modal('toggle');
                if(!window.location.href.includes("index")){
                    $('#nomUsu').attr('data-bs-target', '#userModal');
                }else{
                    $('#nomUsu').removeAttr('data-bs-target');

                }
                $("#nomUsu").text(result.usuario.nombre);

                $('#nameUser').val(result.usuario.nombre);
                $('#emailUser').val(result.usuario.email)

                if (result.usuario.admin == 1) {
                    $("#btnBanca").css('display', 'block');
                }
                break;
            case "incorrect user":
                $("#errorLogin").html("El correo o contraseña introducido es incorrecto.</br> <a class='text-dark' onclick='forgotPassword()'>He olvidado la contraseña.</a>");
                break;
            default:
                $("#errorLogin").text("Inserte datos en todos los campos por favor.");
        }
    })
}

//LOGOUT
function logout() {
    
    var url = "controller/cLogout.php";
    fetch(url, {
        method: 'GET',
        headers: { 'Content-Type': 'application/json' }
    }).then(res => res.json()).then(result => {
        console.log(result);
        if (result.error == "no error") {
            $("#errorLogin").text("");
            $("#btnBanca").css('display', 'none');
            $("#btnProductos").css('display', 'none');
            $("#ddLg").css('display', 'block');
            $("#ddReg").css('display', 'block');
            $("#ddLo").css('display', 'none');
            $("#nomUsu").text("Login");
            $('#nomUsu').attr('data-bs-target', '#login');
            $("#email").val("");
            $("#contrasenia").val("");
        }
        if(!window.location.href.includes("index.html")){
            window.location.href = "index.html";
        }
    })


    /*EDITAR PERFIL ANGULAR JS*/
    // var MyApp = angular.module('myApp', []);

    // MyApp.controller('controlador',['$scope','$http', function($scope,$http){

    //     $scope.habilitarEdit = function() {
    //         console.log("hola");
    //     }
    
    // }]);
}