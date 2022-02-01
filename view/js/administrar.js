var administrar = angular.module("myApp", []);

administrar.controller("miControlador", [
  "$scope",
  "$http",
  function ($scope, $http) {
    $http.get("controller/cLoadCentros.php").then(function (response) {
      $scope.lista = response.data.list;
    });
  },
]);

// funcion para mostrar centro
function mostrar(cod_centro) {
  $("#correctoCentro").html("");
  $("#errorCentro").html("");
  if (cod_centro != "nuevo") {
    var url = "controller/cGetCentro.php";
    var data = { cod_centro: cod_centro };
    fetch(url, {
      method: "POST",
      body: JSON.stringify(data),
      headers: { "content-type": "application/json" },
    })
      .then((res) => res.json())
      .then((result) => {
        let centro = result.centro;
        $("#nombreCentro").val(centro.Nombre);
        $("#municipio").val(centro.Municipio);
        if (centro.Lunes > 0) {
          $("#checkLunes").prop("checked", true);
        } else {
          $("#checkLunes").prop("checked", false);
        }
        if (centro.Martes > 0) {
          $("#checkMartes").prop("checked", true);
        } else {
          $("#checkMartes").prop("checked", false);
        }
        if (centro.Miercoles > 0) {
          $("#checkMiercoles").prop("checked", true);
        } else {
          $("#checkMiercoles").prop("checked", false);
        }
        if (centro.Jueves > 0) {
          $("#checkJueves").prop("checked", true);
        } else {
          $("#checkJueves").prop("checked", false);
        }
        if (centro.Viernes > 0) {
          $("#checkViernes").prop("checked", true);
        } else {
          $("#checkViernes").prop("checked", false);
        }
        if (centro.Sabado > 0) {
          $("#checkSabado").prop("checked", true);
        } else {
          $("#checkSabado").prop("checked", false);
        }
        if (centro.Domingo > 0) {
          $("#checkDomingo").prop("checked", true);
        } else {
          $("#checkDomingo").prop("checked", false);
        }
        $("#apertura").val(centro.Hora_apertura);
        $("#cierre").val(centro.Hora_cierre);
      });
  } else {
    $("#nombreCentro").val("");
    $("#municipio").val("");
    $("#checkLunes").prop("checked", false);
    $("#checkMartes").prop("checked", false);
    $("#checkMiercoles").prop("checked", false);
    $("#checkJueves").prop("checked", false);
    $("#checkViernes").prop("checked", false);
    $("#checkSabado").prop("checked", false);
    $("#checkDomingo").prop("checked", false);
    $("#apertura").val("");
    $("#cierre").val("");
  }
}

function confirmar() {
  let selected = $("#centros").val();
  if (selected == "limpiar") {
    $("#errorCentro").html("Seleccione centro");
  } else if (selected == "nuevo") {
    $("#errorCentro").html("");
    crearCentro();
  } else {
    $("#errorCentro").html("");
    editarCentro();
  }
}

// funcion añadir centro
function crearCentro() {
  let nombre = $("#nombreCentro").val();
  let municipio = $("#municipio").val();
  let lunes = $("#checkLunes").prop("checked");
  let martes = $("#checkMartes").prop("checked");
  let miercoles = $("#checkMiercoles").prop("checked");
  let jueves = $("#checkJueves").prop("checked");
  let viernes = $("#checkViernes").prop("checked");
  let sabado = $("#checkSabado").prop("checked");
  let domingo = $("#checkDomingo").prop("checked");
  let apertura = $("#apertura").val();
  let cierre = $("#cierre").val();

  if(nombre.length > 0 && municipio.length > 0 && apertura.length > 0 && cierre.length > 0){
    let url = "controller/cInsertCentro.php";
    let data = {
      nombre: nombre,
      municipio: municipio,
      lunes: lunes,
      martes: martes,
      miercoles: miercoles,
      jueves: jueves,
      viernes: viernes,
      sabado: sabado,
      domingo: domingo,
      apertura: apertura,
      cierre: cierre,
    };
    fetch(url, {
      method: "POST",
      body: JSON.stringify(data),
      headers: { "content-type": "application/json" },
    })
      .then((res) => res.json())
      .then((result) => {
        console.log(result);
        $("#correctoCentro").html("Se ha AÑADIDO correctamente");
        location.reload()
      });
  }else{
    $("#errorCentro").html("Introduce todos los datos que contengan la estrella (*)");
  }
 
}

// funcion editar centro
function editarCentro() {
  let id = $("#centros").val();
  let nombre = $("#nombreCentro").val();
  let municipio = $("#municipio").val();
  let lunes = $("#checkLunes").prop("checked");
  let martes = $("#checkMartes").prop("checked");
  let miercoles = $("#checkMiercoles").prop("checked");
  let jueves = $("#checkJueves").prop("checked");
  let viernes = $("#checkViernes").prop("checked");
  let sabado = $("#checkSabado").prop("checked");
  let domingo = $("#checkDomingo").prop("checked");
  let apertura = $("#apertura").val();
  let cierre = $("#cierre").val();

  let url = "controller/cEditCentro.php";
  let data = {
    id: id,
    nombre: nombre,
    municipio: municipio,
    lunes: lunes,
    martes: martes,
    miercoles: miercoles,
    jueves: jueves,
    viernes: viernes,
    sabado: sabado,
    domingo: domingo,
    apertura: apertura,
    cierre: cierre,
  };
  fetch(url, {
    method: "POST",
    body: JSON.stringify(data),
    headers: { "content-type": "application/json" },
  })
    .then((res) => res.json())
    .then((result) => {
      console.log(result);
      $("#correctoCentro").html("Se ha EDITADO correctamente");
    });
}

// funcion eliminar centro
function deleteCentro() {
  let id = $("#centros").val();

  let url = "controller/cDeleteCentro.php";
  let data = {
    cod_centro: id,
  };
  fetch(url, {
    method: "POST",
    body: JSON.stringify(data),
    headers: { "content-type": "application/json" },
  })
    .then((res) => res.json())
    .then((result) => {
      console.log(result.error);

      console.log(result);
      $("#correctoCentro").html("Se ha ELIMINADO correctamente");
      location.reload()
    });
}

function refrescar() {
  location.reload();
}