document.addEventListener("DOMContentLoaded", function (event) {
    //Pantalla de carga hasta que todos los datos esten cargados
    document.getElementById("mainContainer").style.display ="none"
    carga = '<div style="font-size:50px;">Hola! La página esta cargando, un segundín</div>'
    document.getElementById("carga").innerHTML = carga
    
    $(sessionVarsView()).ready(function() {
        console.log("ventana: ", document)
        
        document.getElementById("mainContainer").style.display ="block"
        document.getElementById("carga").style.display="none"
        mostrarDiaSeleccionado();
    });
    var botonesCitas = document.getElementsByClassName("btnMostrarCita");
    for (var i = 0; i < botonesCitas.length; i++) {
        botonesCitas[i].addEventListener('click', loadCitas);
    }
    
    //Boton que abre modal con formulario
    document.getElementById("botonSolicitarCita").addEventListener("click", añadirCita);
    //Boton que realiza la solicitud con datos del formulario
    document.getElementById("botonRealizarSolicitud").addEventListener("click", realizarSolicitud);
    
    
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

function loadCitas(event, fechaSeleccionada) {

    var data
    //Recoge las citas por TIS
    // if (fechaSeleccionada == null) {
    //     console.log("MENU DE PRUEBA CLICADO")
    //     var TIS = event.target.id;
    //     data = { 'TIS': TIS };
    // } else {
    //     console.log("CALENDARIO CLICADO")
    //     var Fecha = fechaSeleccionada;
    //     data = {'Fecha': Fecha}
    // }
    var Fecha = fechaSeleccionada;
    var TIS = objPaciente.paciente.tis;
    data = {"Fecha": Fecha, "TIS": TIS}
    var url = "controller/cLoadCitas.php";
    console.log("DATA ", data);
    fetch(url, {
        method: 'POST',
        body: JSON.stringify(data), // data can be `string` or {object}!
        headers: { 'Content-Type': 'application/json' }  //input data
    })
    .then(res => res.json()).then(result => {
            // if (fechaSeleccionada == null) {
            //     var citas = result.citas;
            // } else{
            //     var citas = result.citasFecha;
            // }
            var citas = result.citas;
            var newRow = "";

                document.getElementById("botonSolicitarCita").style.display="none";
                newRow = `<h2>Cita Actual</h2>
                <div class="row">
                  <div class="col-12 col-xl-5 campo"><input type="text" class="form-control" id="Fecha" disabled placeholder="Fecha: `+ citas.Fecha + `"></div>
                  <div class="col-12 col-xl-5 campo"><input type="text" class="form-control" id="Horas" disabled placeholder="Hora: `+ citas.Horas.substring(0, 5) + `"></div>
                </div>
                <div class="row">
                  <div class="col-12 col-xl-5 campo"><input type="text" class="form-control" id="cod_centro" disabled placeholder="`+ citas.objCentros.Nombre + `"></div>
                  <div class="col-12 col-xl-5 campo"><input type="text" class="form-control" id="TIS" disabled placeholder="TIS: `+ objPaciente.paciente.tis + `"></div>
                </div>
                <div><button type="button" class="btn btn-danger coso" id="">Cancelar cita</button></div>`
    
                document.getElementById("formCitas").innerHTML = newRow;

            //Substring() limita la cantidad de caracteres se muestran

        }).catch(error => console.error('Error status:', error));
}

function insertar(fechaInsertar, horaInsertar, centroInsertar) {
    // var Fecha = document.getElementById("Fecha").value;
    // var Horas = document.getElementById("Horas").value;
    // var cod_centro = document.getElementById("cod_centro").value;
    // var TIS = document.getElementById("TIS").value;

    var url = "controller/cInsertCitas.php";

    var data = { "Fecha": fechaInsertar, "Horas": horaInsertar, "cod_centro": centroInsertar, "TIS": objPaciente.paciente.tis };

    fetch(url, {
        method: 'POST',
        body: JSON.stringify(data),
        headers: { 'Content-Type': 'application/json' }
    })
        .then(res => res.json()).then(result => {
            console.log("mensaje error", result.error);
            alert("La cita se ha insertado con exito");
            location.reload()
        })
}
var fechaSeleccionada
function mostrarDiaSeleccionado() {
    console.log("SESION ACTUAL: ",objPaciente) //Variable de sesion recibida desde general.js
    document.getElementById("Fecha").value = " ";
    document.getElementById("Horas").value = " ";
    document.getElementById("cod_centro").value = " ";
    document.getElementById("TIS").value = " ";


    var dia = document.getElementsByClassName("table-date active-date");
    if (dia[0].innerHTML.length==1) {
        diaConvertido = "0"+dia[0].innerHTML;
    } else {
        diaConvertido = dia[0].innerHTML;
    }
    var mes = document.getElementsByClassName("month active-month");
    var anio = document.getElementsByClassName("year");

    switch (mes[0].innerHTML) {
        case "ENE":
            var mesConvertido = "01";
            break;
        case "FEB":
            var mesConvertido = "02";
            break;
        case "MAR":
            var mesConvertido = "03";
            break;
        case "ABR":
            var mesConvertido = "04";
            break;
        case "MAY":
            var mesConvertido = "05";
            break;
        case "JUN":
            var mesConvertido = "06";
            break;
        case "JUL":
            var mesConvertido = "07";
            break;
        case "AGO":
            var mesConvertido = "08";
            break;
        case "SEP":
            var mesConvertido = "09";
            break;
        case "OCT":
            var mesConvertido = "10";
            break;
        case "NOV":
            var mesConvertido = "11";
            break;
        case "DIC":
            var mesConvertido = "12";
            break;
        default:
            break;
    }

    fechaSeleccionada = anio[0].innerHTML+"-"+mesConvertido+"-"+diaConvertido;
    console.log("Fecha formateada", fechaSeleccionada)
    loadCitas(event, fechaSeleccionada);
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

            fechaSeleccionada;
            document.getElementById("SolicitarFecha").value = fechaSeleccionada;
            document.getElementById("SolicitarTIS").value = objPaciente.paciente.tis
        })
        .catch(error => console.error('Error status:', error));


    var dia = document.getElementsByClassName("table-date active-date");
    var mes = document.getElementsByClassName("month active-month");
    var anio = document.getElementsByClassName("year");
    console.log("Dia seleccionado: ", dia[0].innerHTML);
    console.log("Mes seleccionado: ", mes[0].innerHTML);
    console.log("Año seleccionado: ", anio[0].innerHTML);

}

function realizarSolicitud() {
    console.log(fechaSeleccionada)
    var horaSeleccionada = document.getElementById("SolicitarHoras").value;
    var centroSeleccionado = document.getElementById("SolicitarCod_centro").value;
    var tisSeleccionado = document.getElementById("SolicitarTIS").value;

    console.log("Fecha form: ", fechaSeleccionada);
    console.log("Hora form: ", horaSeleccionada);
    console.log("Centro form: ", centroSeleccionado);
    console.log("Tis form: ", tisSeleccionado);

    insertar(fechaSeleccionada, horaSeleccionada, centroSeleccionado);
}