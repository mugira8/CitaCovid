//Edad del paciente
var edadPaciente;
//Fecha de pcr positiva
var FechaPcrPositiva;
//Cantidad citas
var cantidadCitas = 0;
var mesesDesdeAnteriorCita;
var mesesHastaSiguienteCita;
var tiempoNecesarioEntreCitas = true;
document.addEventListener("DOMContentLoaded", function (event) {
    //Pantalla de carga hasta que todos los datos esten cargados
    document.getElementById("mainContainer").style.display = "none"
    carga = '<div style="font-size:50px;">Hola! La página esta cargando, un segundín</div>'
    document.getElementById("carga").innerHTML = carga

    
    sessionVarsView()
    //Comprobar la cantidad de citas
    var cantidadCitas;
    loadAllCitas();
    $(window).on("load", function () {

        document.getElementById("mainContainer").style.display = "block"
        document.getElementById("carga").style.display = "none"

        var botonesCitas = document.getElementsByClassName("btnMostrarCita");
        for (var i = 0; i < botonesCitas.length; i++) {
            botonesCitas[i].addEventListener('click', loadCitas);
        }
    });
    //Limpia el input de hora en el formulario de solicitud
    document.getElementById("SolicitarHoras").value = ""
    //Boton que abre modal con formulario
    document.getElementById("botonSolicitarCita").addEventListener("click", anadirCita);
    //Boton que realiza la solicitud con datos del formulario
    document.getElementById("botonRealizarSolicitud").addEventListener("click", realizarSolicitud);
    //Boton que abre modal que muestra todas las citas
    //document.getElementById("botonMostrarCitas").addEventListener("click", mostrarTodasCitas);



})


function loadAllCitas() {
    var url = "controller/cLoadAllCitas.php";
    fetch(url, {
        method: 'POST',
    }).then(res => res.json()).then(result => {
        cantidadCitas = result.list.length

        citaMasReciente = new Date(0)
        todasCitas = result
        var mesesHastaSiguienteCita = new Array
        var mesesDesdeAnteriorCita = new Array


        for (let i = 0; i < todasCitas.list.length; i++) {
            fechaAnteriorComprobar = new Date(fechaSeleccionada)
            fechaComprobar = new Date(todasCitas.list[i].Fecha)
            hoy = new Date()

            //Comprueba la cantidad de meses entre citas
            console.log("ITERACION ", i, " ", todasCitas.list)

            a = Math.max(
                (fechaAnteriorComprobar.getFullYear() - fechaComprobar.getFullYear()) * 12 +
                fechaAnteriorComprobar.getMonth() -
                fechaComprobar.getMonth(),
                0);
            mesesDesdeAnteriorCita.push(a)

            e = Math.max(
                (fechaComprobar.getFullYear() - fechaAnteriorComprobar.getFullYear()) * 12 +
                fechaComprobar.getMonth() -
                fechaAnteriorComprobar.getMonth(),
                0);
            mesesHastaSiguienteCita.push(e)
        }
        for (let i = 0; i < mesesDesdeAnteriorCita.length; i++) {
            if (mesesDesdeAnteriorCita[i] >= 6 || mesesHastaSiguienteCita[i] >= 6) {
                tiempoNecesarioEntreCitas = true
            } else {
                tiempoNecesarioEntreCitas = false
                break;
            }
        }
    })
}
function mostrarTodasCitas(){

    loadAllCitas()
    if (cantidadCitas > 0) {
        
        for (let i = 0; i < todasCitas.list.length; i++) {
            console.log("TODAS CITAS: ", todasCitas)
            
            var newRow =+ `
            <h4>º`+(i+1)+` Cita</h4>
            <div class="row">
              <div class="col-12 col-xl-11 campo"><input type="text" class="form-control todasFechas" placeholder="Fecha: `+ todasCitas.list[i].Fecha + `" disabled></div>
              <div class="col-12 col-xl-11 campo"><input type="text" class="form-control todasHoras" placeholder="Hora: `+ todasCitas.list[i].Horas.substring(0, 5) + `" disabled></div>
            </div>
            <div class="row">
              <div class="col-12 col-xl-11 campo"><input type="text" class="form-control todosCentros" placeholder="`+ todasCitas.centrosVacunas[i].objCentros.Nombre + `" disabled></div>
            </div>
            <div class="row">
              <h5>Vacuna a administrar</h5>
              <div class="col-12 col-xl-11 campo"><input type="text" class="form-control todasVacunas" placeholder=`+ todasCitas.centrosVacunas[i].objVacunas.Tipo_vacuna + ` disabled></div>
            </div>
            `
        }

    } else {
        var newRow = `<h2>No tiene ninguna cita concertada</h2>`
    }
    document.getElementById("formTodasCitas").innerHTML = newRow;
}

var codCita //Esta variable se pasa al boton de eliminar
function loadCitas(event, fechaSeleccionada) {
    var data
    var Fecha = fechaSeleccionada;
    var TIS = objPaciente.paciente.tis;
    data = { "TIS": TIS, "Fecha": Fecha}
    var url = "controller/cLoadCitas.php";

    //CARGAR CITAS POR TIS Y FECHA
    fetch(url, {
        method: 'POST',
        body: JSON.stringify(data), // data can be `string` or {object}!
        headers: { 'Content-Type': 'application/json' }  //input data
    })
        .then(res => res.json()).then(result => {

            var citas = result.citas;
            var newRow = "";

            //Formatea la fecha de nacimiento y comprueba la edad
            var nacimientoPaciente = objPaciente.paciente.fecha.split(["-"])
            var diaNacimiento = nacimientoPaciente[2];
            var mesNacimiento = nacimientoPaciente[1];
            var anioNacimiento = nacimientoPaciente[0];

            var nacimientoFormateado = new Date(anioNacimiento, mesNacimiento, diaNacimiento)
            calcularFechaNaciemiento(nacimientoFormateado)


            hoy = new Date();
            var comprobarCitaAnterior = new Date(fechaSeleccionada)
            console.log("CITAS: ", citas)
            if (citas.objCentros != null) { //Comprueba si hay cita el dia seleccionado
                document.getElementById("botonSolicitarCita").style.display = "none";
                document.getElementById("botonCancelarCita").style.display = "inline-block";
                newRow =
                    `<div class="row">
                <div class="col-12 col-xl-5 campo"><h4>Nombre paciente</h4> <input type="text" class="form-control" id="NombrePaciente" disabled placeholder="`+ objPaciente.paciente.nombre + `"></div>
                <div class="col-12 col-xl-5 campo"><h4>TIS</h4><input type="text" class="form-control" id="TIS" disabled placeholder="`+ objPaciente.paciente.tis + `"></div>
                </div>
                <h2>Cita Actual</h2>
                <div class="row">
                <div class="col-12 col-xl-5 campo"><input type="text" class="form-control" id="Fecha" disabled placeholder="Fecha: `+ citas.Fecha + `"></div>
                <div class="col-12 col-xl-5 campo"><input type="text" class="form-control" id="Horas" disabled placeholder="Hora: `+ citas.Horas.substring(0, 5) + `"></div>
                </div>
                <div class="row">
                <div class="col-12 col-xl-11 campo"><input type="text" class="form-control" id="cod_centro" disabled placeholder="`+ citas.objCentros.Nombre + `"></div>
                </div>
                <div class="row">
                <h4>Vacuna a administrar</h4>
                <div class="col-12 col-xl-11 campo"><input type="text" class="form-control" id="cod_vacuna" disabled placeholder=`+ citas.objVacunas.Tipo_vacuna + `></div>
                </div>
                <div><button type="button" class="btn btn-danger coso" id="botonCancelarCita">Cancelar cita</button>
                </div>`
                codCita = citas.cod_cita
                document.getElementById("formCitas").innerHTML = newRow
            } else {
                newRow =
                    `<div class="row">
                <div class="col-12 col-xl-5 campo"><h4>Nombre paciente</h4> <input type="text" class="form-control" id="NombrePaciente" disabled placeholder="`+ objPaciente.paciente.nombre + `"></div>
                <div class="col-12 col-xl-5 campo"><h4>TIS</h4><input type="text" class="form-control" id="TIS" disabled placeholder="`+ objPaciente.paciente.tis + `"></div>
                </div>
                <h2>Cita Actual</h2>
                <div class="row">
                <div class="col-12 col-xl-5 campo"><input type="text" class="form-control" id="Fecha" disabled placeholder=""></div>
                <div class="col-12 col-xl-5 campo"><input type="text" class="form-control" id="Horas" disabled placeholder=""></div>
                </div>
                <div class="row">
                <div class="col-12 col-xl-11 campo"><input type="text" class="form-control" id="cod_centro" disabled placeholder=""></div>
                </div>
                <div class="row">
                <h4>Vacuna a administrar</h4>
                <div class="col-12 col-xl-11 campo"><input type="text" class="form-control" id="cod_vacuna" disabled placeholder=""></div>
                </div>
                <div><button type="button" class="btn btn-danger coso" id="botonCancelarCita">Cancelar cita</button></div>`
                
                document.getElementById("botonSolicitarCita").style.display = "inline-block";
                document.getElementById("formCitas").innerHTML = newRow
                document.getElementById("botonCancelarCita").style.display = "none";
            }
            if (comprobarCitaAnterior < hoy) {
                document.getElementById("botonSolicitarCita").style.display = "none";
                document.getElementById("botonCancelarCita").style.display = "none";
            } else if (comprobarCitaAnterior > hoy && citas.objCentros == null) {
                document.getElementById("botonSolicitarCita").style.display = "inline-block";
            }
            //Substring() limita la cantidad de caracteres se muestran
            
            document.getElementById("botonCancelarCita").addEventListener("click", cancelarCita);

            
        }).catch(error => console.error('Error status:', error));
}

function cargarPaciente() {
    var data
    var TIS = objPaciente.paciente.tis;
    var url = "controller/cLoadPacientes.php";
    data = { "TIS": TIS }
    fetch(url, {
        method: 'POST',
        body: JSON.stringify(data), // data can be `string` or {object}!
        headers: { 'Content-Type': 'application/json' }  //input data
    })
        .then(res => res.json()).then(result => {
            FechaPcrPositiva = result.list[0].Fecha_PCR_pos

            fechaComprobar = new Date(fechaSeleccionada);
            FechaPcrPositiva = new Date(FechaPcrPositiva)
            mesesDesdePcrPos = Math.max(
                (fechaComprobar.getFullYear() - FechaPcrPositiva.getFullYear()) * 12 +
                fechaComprobar.getMonth() -
                FechaPcrPositiva.getMonth(),
                0)
        })
}

function calcularFechaNaciemiento(nacimientoFormateado) {
    var ageDifMs = Date.now() - nacimientoFormateado.getTime();
    var ageDate = new Date(ageDifMs);
    return edadPaciente = Math.abs(ageDate.getUTCFullYear() - 1970);
}


function insertar(fechaInsertar, horaInsertar, centroInsertar, vacunaInsertar) {

    //Comprueba si todos los campos estan rellenados
    if (document.getElementById("SolicitarHoras").value && document.getElementById("SolicitarCod_centro").value && document.getElementById("SolicitarCod_vacuna").value) {
        //Comprueba las condiciones basando en edad
        if ((edadPaciente > 11 && cantidadCitas < 3) || (edadPaciente <= 11 && cantidadCitas == 0)) {
            //Comprueba que han pasado 6 meses entre dosis o PCR
            if (mesesDesdePcrPos >= 6 && tiempoNecesarioEntreCitas == true) {

                var url = "controller/cInsertCitas.php";

                var data = { "Fecha": fechaInsertar, "Horas": horaInsertar, "cod_centro": centroInsertar, "TIS": objPaciente.paciente.tis, "cod_vacuna": vacunaInsertar };

                fetch(url, {
                    method: 'POST',
                    body: JSON.stringify(data),
                    headers: { 'Content-Type': 'application/json' }
                })
                    .then(res => res.json()).then(result => {
                        alert("La cita se ha insertado con éxito");
                        insertarHistorial(fechaInsertar, vacunaInsertar)
                    })
            } else {
                alert("Deben pasar 6 meses desde su ultima dosis o PCR positiva")
            }
        } else {//Edad
            alert("Ha alcanzado el numero máximo de citas. Citas pendientes: " + cantidadCitas + ".")
        }
    } else {//Campos
        alert("No has rellenado todos los campos")
    }
}
var fechaSeleccionada
function mostrarDiaSeleccionado() {
    console.log("SESION ACTUAL: ", objPaciente) //Variable de sesion recibida desde general.js
    document.getElementById("Fecha").value = " ";
    document.getElementById("Horas").value = " ";
    document.getElementById("cod_centro").value = " ";
    document.getElementById("TIS").value = " ";
    document.getElementById("cod_vacuna").value = " ";


    var dia = document.getElementsByClassName("table-date active-date");
    if (dia[0].innerHTML.length == 1) {
        diaConvertido = "0" + dia[0].innerHTML;
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

    fechaSeleccionada = anio[0].innerHTML + "-" + mesConvertido + "-" + diaConvertido;
    cargarPaciente()
    loadCitas(event, fechaSeleccionada);
    if (cantidadCitas > 0) {
        loadAllCitas()
    }
}

function anadirCita() {
    //cargar desplegable centros
    var url = "controller/cLoadCentros.php"
    var url2 = "controller/cVacunas.php"
    fetch(url, {
        method: 'GET',
    })
        .then(res => res.json()).then(result => {
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

    fetch(url2, {
        method: 'GET',
    })
        .then(res => res.json()).then(result => {
            var vacuna = result.list;
            var newRow = "";
            newRow += "<option value=''selected disabled hidden>▼</option>";
            for (let i = 0; i < vacuna.length; i++) {
                newRow += "<option value='" + vacuna[i].cod_vacuna + "'>" + vacuna[i].Tipo_Vacuna + "</option>";
            }
            document.getElementById("SolicitarCod_vacuna").innerHTML = newRow;
        })
        .catch(error => console.error('Error status:', error));
    //<div class="col-12 campo2">Tipo de vacuna<select class="form-control" id="SolicitarCod_vacuna" placeholder=""></select></div>

}

function realizarSolicitud() {
    var horaSeleccionada = document.getElementById("SolicitarHoras").value;
    var centroSeleccionado = document.getElementById("SolicitarCod_centro").value;
    var vacunaSeleccionada = document.getElementById("SolicitarCod_vacuna").value;

    insertar(fechaSeleccionada, horaSeleccionada, centroSeleccionado, vacunaSeleccionada);
}

function cancelarCita() {
    let confirmacion = confirm("Estas seguro de que quieres cancelar esta cita?")
    if (confirmacion) {
        var url = "controller/cCancelarCita.php";
        var data = { "cod_cita": codCita }

        fetch(url, {
            method: 'POST', // or 'POST'
            body: JSON.stringify(data), // data can be `string` or {object}!
            headers: { 'Content-Type': 'application/json' }  // input data
        })
            .then(res => res.json()).then(result => {
                alert("Cita cancelada con exito");
                location.reload()
            })
            .catch(error => console.error('Error status:', error));
    } else {

    }

}

function insertarHistorial(fecha, vacuna) {
    let nombreVacuna = "";
    var info = { "cod_vacuna": vacuna }
    fetch("controller/cGetVacuna.php", {
        method: 'POST',
        body: JSON.stringify(info),
        headers: { 'Content-Type': 'application/json' }
    })
        .then(res => res.json()).then(result => {
            nombreVacuna = result.vacuna.Tipo_Vacuna
            var tis = objPaciente.paciente.tis;
            var url = "controller/cInsertHistorial.php";
            var data = { "TIS": tis, "Num_Dosis": cantidadCitas + 1, "Fecha": fecha, "Tipo_vacuna": nombreVacuna };
            console.log('data', data)
            fetch(url, {
                method: 'POST',
                body: JSON.stringify(data),
                headers: { 'Content-Type': 'application/json' }
            })
                .then(res => res.json()).then(result => {
                    console.log("mensaje error", result.error);
                    location.reload();
                })
        }) 
}