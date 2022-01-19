document.addEventListener("DOMContentLoaded", function (event) {
    //loadCitas();

    //document.getElementById("botonConfirmarCita").addEventListener('click', insertar);
    var botonesCitas = document.getElementsByClassName("btnMostrarCita");

    for (var i = 0; i < botonesCitas.length; i++) {
        botonesCitas[i].addEventListener('click', loadCitas, false);
    }

    document.getElementById("botonSolicitarCita").addEventListener("click", añadirCita);
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

function loadCitas(event) {

    console.log("boton clicado:", event.target.id)



    //Recoge las citas por TIS
    var url = "controller/cLoadCitas.php";
    var TIS = event.target.id;
    var data = { 'TIS': TIS };
    fetch(url, {
        method: 'POST',
        body: JSON.stringify(data), // data can be `string` or {object}!
        headers: { 'Content-Type': 'application/json' }  //input data
    })
        .then(res => res.json()).then(result => {
            console.log("resultado citas", result);
            var citas = result.citas;

            var newRow = "";

            //Substring() limita la cantidad de caracteres se muestran
            newRow = `<h2>Cita Actual</h2>
            <div class="row">
              <div class="col-12 col-xl-5 campo"><input type="text" class="form-control" id="Fecha" disabled placeholder="Fecha: `+ citas.Fecha + `"></div>
              <div class="col-12 col-xl-5 campo"><input type="text" class="form-control" id="Horas" disabled placeholder="Hora: `+ citas.Horas.substring(0, 5) + `"></div>
            </div>
            <div class="row">
              <div class="col-12 col-xl-5 campo"><input type="text" class="form-control" id="cod_centro" disabled placeholder="`+ citas.objCentros.Nombre + `"></div>
              <div class="col-12 col-xl-5 campo"><input type="text" class="form-control" id="TIS" disabled placeholder="TIS: `+ citas.TIS + `"></div>
            </div>
			<div><button type="button" class="btn btn-danger coso" id="">Cancelar cita</button></div>`

            document.getElementById("formCitas").innerHTML = newRow;

        }).catch(error => console.error('Error status:', error));
}

function insertar(diaSeleccionado, mesSeleccionado, añoSeleccionado) {
    var Fecha = document.getElementById("Fecha").value;
    var Horas = document.getElementById("Horas").value;
    var cod_centro = document.getElementById("cod_centro").value;
    var TIS = document.getElementById("TIS").value;

    var url = "controller/cInsertCitas.php";

    var data = { "Fecha": Fecha, "Horas": Horas, "cod_centro": cod_centro, "TIS": TIS };

    fetch(url, {
        method: 'POST',
        body: JSON.stringify(data),
        headers: { 'Content-Type': 'application/json' }
    })
        .then(res => res.json()).then(result => {
            console.log("mensaje error", result.error);
            alert(result.error);
            location.reload()
        })
}

function mostrarDiaSeleccionado() {
    var dia = document.getElementsByClassName("table-date active-date");
    var mes = document.getElementsByClassName("month active-month");
    var año = document.getElementsByClassName("year");
    console.log("Dia seleccionado: ", dia[0].innerHTML);
    console.log("Mes seleccionado: ", mes[0].innerHTML);
    console.log("Año seleccionado: ", año[0].innerHTML);

    switch (mes[0].innerHTML) {
        case "ENE":
            var mesConvertido = 01;
            break;
        case "FEB":
            var mesConvertido = 02;
            break;
        case "MAR":
            var mesConvertido = 03;
            break;
        case "ABR":
            var mesConvertido = 04;
            break;
        case "MAY":
            var mesConvertido = 05;
            break;
        case "JUN":
            var mesConvertido = 06;
            break;
        case "JUL":
            var mesConvertido = 07;
            break;
        case "AGO":
            var mesConvertido = 08;
            break;
        case "SEP":
            var mesConvertido = 09;
            break;
        case "OCT":
            var mesConvertido = 10;
            break;
        case "NOV":
            var mesConvertido = 11;
            break;
        case "DIC":
            var mesConvertido = 12;
            break;
        default:
            break;
    }

    var fechaSeleccionada = año[0].innerHTML+"-"+mesConvertido+"-"+dia[0].innerHTML;
    console.log("Fecha formateada", fechaSeleccionada)

}

function añadirCita() {
    //cargar desplegable centros
    console.log("Cargar centros")
    var url = "controller/cLoadCentros.php"
    fetch(url, {
        method: 'GET',
    })
        .then(res => res.json()).then(result => {
            console.log("resultado citas", result.list);
            var centro = result.list;
            var newRow = "";
            newRow += "<option value=''selected disabled hidden>▼</option>";
            for (let i = 0; i < centro.length; i++) {
                newRow += "<option value='" + centro[i].cod_centro + "'>" + centro[i].Nombre + "</option>";
            }
            document.getElementById("SolicitarCod_centro").innerHTML = newRow;
        })
        .catch(error => console.error('Error status:', error));


    var dia = document.getElementsByClassName("table-date active-date");
    var mes = document.getElementsByClassName("month active-month");
    var año = document.getElementsByClassName("year");
    console.log("Dia seleccionado: ", dia[0].innerHTML);
    console.log("Mes seleccionado: ", mes[0].innerHTML);
    console.log("Año seleccionado: ", año[0].innerHTML);

    //insertar(dia, mes, año);
}