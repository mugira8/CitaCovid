
var objPaciente; //Variable global para poder acceder desde citaVacunacion.js u otros archivos

$(document).ready(sessionVarsView);
function sessionVarsView() {
    var url = "controller/cSessionVarsView.php";
    fetch(url, {
        method: 'GET',
        headers: { 'Content-Type': 'application/json' }
    }).then(res => res.json()).then(result => {
        console.log('session result', result)
        console.log(window.location.href)
        //Para citas
        objPaciente = result;
        if (window.location.href.includes("citaVacunacion")){
            mostrarDiaSeleccionado()
        }
        if (result.error == "no error" && result.paciente.tis) {
            $("#iniciarSesion").css('display', 'none');
            $("#cerrarSesion").css('display', 'block');
            $("#btnEditarPerfil").css('display', 'block');
            $("#btnAdministrar").css('display', 'none');
            $("#btnCita").css('display', 'block');
            $("#btnHistorial").css('display', 'block');
            $('#usuario').removeAttr('data-bs-target');
            $('#administrar').removeAttr('data-bs-target');
            $("#usuario").text(result.paciente.nombre);
        } else if (!result.usuario.correo) {
            if (!window.location.href.includes("index")) {
                if (window.location.href.includes('contacto')) {
                    console.log('contacto')
                    window.location.href = "contacto.html"
                } else {
                    console.log('index')
                    window.location.href = "index.html";
                }
            }
        }
        if (result.error == "no error" && result.usuario.correo) {
            $("#iniciarSesion").css('display', 'none');
            $("#cerrarSesion").css('display', 'block');
            $("#btnAdministrar").css('display', 'block');
            $("#btnCita").css('display', 'none');
            $("#btnHistorial").css('display', 'none');
            $('#usuario').removeAttr('data-bs-target');
            $('#administrar').removeAttr('data-bs-target');
            $("#usuario").text(result.usuario.correo);
        } else if (!result.paciente.tis) {
            if (!window.location.href.includes("index")) {
                if (window.location.href.includes('contacto')) {
                    console.log('contacto')
                    window.location.href = "contacto.html"
                } else {
                    console.log('index')
                    window.location.href = "index.html";
                }
            }

        }
    });
}

//En el formulario al darle a enter que pase al siguiente input
jQuery.extend(jQuery.expr[":"], {
    focusable: function (el, index, selector) {
        return $(el).is(":input");
    },
});
$(document).on("keydown", ":focusable", function (e) {
    if (e.which == 13) {
        e.preventDefault();
        // Get all focusable elements on the page
        var $canfocus = $(":focusable");
        var index = $canfocus.index(this) + 1;
        if (index >= $canfocus.length) index = 0;
        $canfocus.eq(index).focus();
    }
});

//Login Paciente
function loginPaciente() {
    var tis = $("#insertTis").val();
    var fecha = $("#insertFecha").val();
    var url = "controller/cLoginPaciente.php";
    var data = { 'tis': tis, 'fecha': fecha }
    fetch(url, {
        method: 'POST',
        body: JSON.stringify(data),
        headers: { 'content-type': 'application/json' }
    }).then(res => res.json()).then(result => {
        console.log(result)
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
                $('#usuario').removeAttr('data-bs-target');
                $('#administrar').removeAttr('data-bs-target');
                $("#usuario").text(result.nombre);
                break;
            case "incorrect user":
                $("#errorLogin").html("El correo o contraseña introducido es incorrecto.</br>");
                break;
            default:
                $("#errorLogin").text("Inserte datos en todos los campos por favor.");
        }
    })
}

//Login usuario
function loginUsuario() {
    var correo = $("#insertEmail").val();
    var contrasena = $("#insertContrasena").val();
    console.log('values', correo, contrasena)
    var url = "controller/cLoginUsuario.php";
    var data = { 'correo': correo, 'contrasena': contrasena }
    fetch(url, {
        method: 'POST',
        body: JSON.stringify(data),
        headers: { 'content-type': 'application/json' }
    }).then(res => res.json()).then(result => {
        console.log('result usuario', result);
        switch (result.error) {
            case "no error":
                $("#errorLogin").text("");
                $("#iniciarSesion").css('display', 'none');
                $("#cerrarSesion").css('display', 'block');
                $("#btnEditarPerfil").css('display', 'block');
                $("#btnAdministrar").css('display', 'block');
                $("#btnCita").css('display', 'none');
                $("#btnHistorial").css('display', 'none');
                $('#login').modal('toggle');
                $('#usuario').removeAttr('data-bs-target');
                $('#administrar').removeAttr('data-bs-target');
                $("#usuario").text(result.usuario.correo);
                break;
            case "incorrect user":
                $("#errorLogin").html("El correo o contraseña introducido es incorrecto.</br>");
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
            $("#iniciarSesion").css('display', 'block');
            $("#cerrarSesion").css('display', 'none');
            $("#btnEditarPerfil").css('display', 'none');
            $("#btnAdministrar").css('display', 'none');
            $("#btnCita").css('display', 'none');
            $("#btnHistorial").css('display', 'none');
            $("#usuario").text('Login');
            window.location.href = "index.html";
        }
    })
}

//Funciones para el boton del scrollup
mybutton = document.getElementById("myBtn");

window.onscroll = function () { scrollFunction() };

function scrollFunction() {
    if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
        mybutton.style.display = "block";
    } else {
        mybutton.style.display = "none";
    }
}

function topFunction() {
    document.body.scrollTop = 0; // For Safari
    document.documentElement.scrollTop = 0; // For Chrome, Firefox, IE and Opera
}
