var MyApp = angular.module("myApp", []);

MyApp.controller('miControlador',['$scope','$http',  function($scope,$http){
    sessionVarsView()
     function sessionVarsView() {
        var url = "controller/cSessionVarsView.php";
        fetch(url, {
            method: 'GET',
            headers: { 'Content-Type': 'application/json' }
        }).then(res => res.json()).then(result => {
            console.log('session result', result)
            console.log(window.location.href)
            objPaciente = result;
            
            url= 'controller/cHistorial.php';
            var data = {"TIS": result.paciente.tis};
            fetch(url, {
                method: 'POST',
                body: JSON.stringify(data),
                headers: { 'Content-Type': 'application/json' }
            }).then(res => res.json()).then(result => {
                console.log('session result', result)
                console.log(window.location.href)
                objPaciente = result;
                
                console.log(result)
                $scope.lista = result.list;
    
            });

            url= 'controller/cLoadPacientes.php';
            data = {"TIS": result.paciente.tis};
            fetch(url, {
                method: 'POST',
                body: JSON.stringify(data),
                headers: { 'Content-Type': 'application/json' }
            }).then(res => res.json()).then(result => {
                console.log('session result', result)
                console.log(window.location.href)
                objPaciente = result;
                
                console.log(result)
                $scope.lista2 = result.list;
    
            });
        });
    }


    // $scope.confirmarEditar = function() {
    //     console.log($scope.pacienteNombre )
    //     console.log($scope.pacienteApellido)
    //     var listaModificacion = {nombre: $scope.pacienteNombre , apellido: $scope.pacienteApellido};
    //     console.log(listaModificacion)
    //     $http({url: "controller/cPacienteUpdate.php",
    //     method: "POST",
    //     params: {value: listaModificacion}
    // }).then(function(response) {
        
    // })
    // }

    $scope.verHistorial = function() {
        $scope.ver = "si";
    }

}]);

var savedFileBase64;
var filename;
var filesize;

$("#btnEnviar").on('change',function ()
	{
		changeFitx("update");
	});	

function changeFitx(action) {
    var file=event.currentTarget.files[0];
    var reader = new FileReader();

    filename = file.name;
    filesize = file.size;

    if (!   new RegExp("(.*?).(jpg|jpeg|png|gif|JPG|JPEG|PNG|GIF)$").test(filename)) {
		  	  
	    alert("Solo se aceptan imágenes JPG, PNG y GIF");
	    $("#fotoInsertar").val()="";
	    $("#btnEnviar").val()="";
	    
	  } else{
	  
		  reader.onloadend = function () {
				  savedFileBase64 = reader.result;     // Almacenar en variable global para uso posterior	  
				  
				  if (action== "update"){
					  $("fotoPerfil").attr("src",savedFileBase64); 
					  $("btnEnviar").removeAttr("disabled");
				  }			  
		  }	
		  if (file) {
		    reader.readAsDataURL(file);
		    
		  } else {
			  if (action== "update"){
				  $("filmPhotoUpdateOld").attr("src",""); 
				  $("filmPhotoUpdateNew").attr("src",""); 
			  }  
		  }
	}
}