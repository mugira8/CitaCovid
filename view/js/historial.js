var MyApp = angular.module("myApp", []);

MyApp.controller('miControlador',['$scope','$http',  function($scope,$http){

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

$("#btnEnviar").on('click', execUpdate);

function execUpdate() {
    
    var nombre = $("#nombre").val();
    var apellido = $("#apellido").val();

    var url = "controller/cPacienteUpdate.php";
    var data = {'nombre': nombre, 'apellido': apellido, 'filename': filename, 'savedFileBase64': savedFileBase64};

    fetch(url, {
        method: 'POST',
        body: JSON.stringify(data), 
        headers:{'Content-Type': 'application/json'} 
        })
        .then(res => res.json()).then(result => {
	
            console.log(result.error);
            alert(result.error);
            $("#update").style.display="none";
         
         var inputs = document.querySelectorAll("#update input");
         for (let i = 0; i < inputs.length; i++) {
             inputs[i].value = "";
         }
         var imgs=document.querySelectorAll("#update img");
         for (let i = 0; i < imgs.length; i++) {
             imgs[i].setAttribute('src','');
         }
        }
 )
 .catch(error => console.error('Error status:', error));
}