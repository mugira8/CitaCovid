document.addEventListener("DOMContentLoaded", function (event) {
    loadCitas();

    document.getElementById("botonConfirmarCita").addEventListener('click', insertar);

})

//Hace que el input solo admita numeros
function validate(evt) {
    var theEvent = evt || window.event;
    if (theEvent.type === 'paste') {
        key = event.clipboardData.getData('text/plain');
    } else {
        var key = theEvent.keyCode || theEvent.which;
        key = String.fromCharCode(key);
    }
    var regex = /[0-9]/;
    if (!regex.test(key)) {
        theEvent.returnValue = false;
        if (theEvent.preventDefault) theEvent.preventDefault();
    }
}

function loadCitas() {

    var url = "controller/cLoadCentros.php"

    fetch(url, {
        method: 'GET',
    })
        .then(res => res.json()).then(result => {

            console.log("resultado citas", result.list);

            var centro = result.list;

            var newRow = "";

            newRow += "<option value=''selected disabled hidden>Selecciona centro </option>";

            for (let i = 0; i < centro.length; i++) {

                newRow += "<option value='" + centro[i].cod_centro + "'>" + centro[i].Nombre + "</option>";
            }
            document.getElementById("cod_centro").innerHTML = newRow;
        })
        .catch(error => console.error('Error status:', error));
}

function insertar(){
    var Fecha = document.getElementById("Fecha").value;
    var Horas = document.getElementById("Horas").value;
    var cod_centro = document.getElementById("cod_centro").value;
    var TIS = document.getElementById("TIS").value;

    var url = "controller/cInsertCitas.php";

    var data = {"Fecha":Fecha, "Horas":Horas, "cod_centro":cod_centro, "TIS":TIS};

    fetch(url,{
        method: 'POST', 
	  body: JSON.stringify(data),
	  headers:{'Content-Type': 'application/json'}
    })
    .then(res => res.json()).then(result =>{
        console.log("mensaje error", result.error);
        alert(result.error);
        location.reload()
    })
}