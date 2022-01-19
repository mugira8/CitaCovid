$(document).ready(sessionVarsView);

function sessionVarsView() {
    var url = "controller/cSessionVarsView.php";
    fetch(url, {
        method: 'GET',
        headers: { 'Content-Type': 'application/json' }
    }).then(res => res.json()).then(result => {
        console.log('session result', result)
        if (result.error == "no error" && result.paciente) {
            $("#iniciarSesion").css('display', 'none');
            $("#cerrarSesion").css('display', 'block');
            $("#btnEditarPerfil").css('display', 'block');
            $("#btnAdministrar").css('display', 'none');
            if(window.location.href.includes("index")){
                $('#usuario').attr('data-bs-target', '#loginModal');
            }else{
                $('#usuario').removeAttr('data-bs-target');
            }     
            $("#usuario").text(result.paciente.tis);

            if (result.error == "no error" && result.usuario) {
                $("#iniciarSesion").css('display', 'none');
                $("#cerrarSesion").css('display', 'block');
                $("#btnEditarPerfil").css('display', 'block');
                $("#btnAdministrar").css('display', 'none');
                if(window.location.href.includes("index")){
                    $('#usuario').attr('data-bs-target', '#userModal');
                }else{
                    $('#usuario').removeAttr('data-bs-target');
                }     
                $("#usuario").text(result.usuario.correo);
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
function loginPaciente() {
    var tis = $("#insertTis").val();
    var fecha = $("#insertFecha").val();
    console.log('values', tis, fecha)
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
                $('#login').modal('toggle');
                if(!window.location.href.includes("index")){
                    $('#usuario').attr('data-bs-target', '#loginModal');
                }else{
                    $('#usuario').removeAttr('data-bs-target');
                }
                $("#usuario").text(result.paciente.tis);
                break;
            case "incorrect user":
                $("#errorLogin").html("El correo o contraseña introducido es incorrecto.</br> <a class='text-dark' onclick='forgotPassword()'>He olvidado la contraseña.</a>");
                break;
            default:
                $("#errorLogin").text("Inserte datos en todos los campos por favor.");
        }
    })
}

//Login usuario
function loginUsuario(){
    var tis = $("#insertTis").val();
    var fecha = $("#insertFecha").val();
    console.log('values', tis, fecha)
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
                $('#login').modal('toggle');
                if(!window.location.href.includes("index")){
                    $('#usuario').attr('data-bs-target', '#userModal');
                }else{
                    $('#usuario').removeAttr('data-bs-target');
                }
                $("#usuario").text(result.usuario.correo);
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
            $("#iniciarSesion").css('display', 'block');
            $("#cerrarSesion").css('display', 'none');
            $("#btnEditarPerfil").css('display', 'none');
            $("#btnAdministrar").css('display', 'block');
        }
        if(!window.location.href.includes("index.html")){
            window.location.href = "index.html";
        }
    })

}