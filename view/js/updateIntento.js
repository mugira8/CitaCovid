var savedFileBase64;
var filename;
var filesize;

document.addEventListener("DOMContentLoaded", function (event) {
	
	loadPacientes();
	
		
	document.getElementById("selectUpdate").addEventListener('change',
			
			()=>showData("update"));
	
	document.getElementById("btnExecUpdate").addEventListener('click', execUpdate);	

});//cierre DOM

function loadPacientes(){	
	
	var url = "controller/cIndex.php";

	fetch(url, {
	  method: 'GET', // or 'POST'
	})
	.then(res => res.json()).then(result => {
		
			console.log('Success:', result.list);
			
			var pacientes = result.list;

       		var newRow ="<h2>Pacientes</h2>";
  			newRow +="<table > ";
			newRow +="<tr><th>ID</th><th>TITULO</th><th>ANIO</th><th>DIRECTOR</th><th>CARTEL</th></tr>";
       		
			for (let i = 0; i < pacientes.length; i++) {
					
				newRow += "<tr>" +"<td>"+pacientes[i].TIS+"</td>"
									+"<td>"+pacientes[i].Fecha_PCR_pos+"</td>"
									+"<td>"+pacientes[i].Fecha_Nacimiento+"</td>"
									+"<td>"+pacientes[i].Nombre+"</td>"
									+"<td>"+pacientes[i].Apellido+"</td>"
									+"<td>"+pacientes[i].Edad+"</td>"
									+"<td><img src='uploads/"+pacientes[i].Perfil+"'/></td>"
								+"</tr>";	
			}
       		newRow +="</table>";   
       		document.getElementById("tablaPaciente").innerHTML = newRow; // add
       		
       		var lista=loadSelect(pacientes);;
       		//document.getElementById("selectUpdate").innerHTML=lista;
       		
       		
	})
	.catch(error => console.error('Error status:', error));	
};


//esto se tiene que mirar con el tis del login
function loadSelect(pacientes)
{
	var newRow ="<option>--Select--></option>";
	for (let i = 0; i < pacientes.length; i++) 
	{
		var datuak = pacientes[i].TIS +"-"+ pacientes[i].Fecha_PCR_pos +"-"+ pacientes[i].Fecha_Nacimiento +"-"+ pacientes[i].Nombre +"-"+ pacientes[i].Apellido +"-"+ pacientes[i].Edad +"-"+ pacientes[i].Perfil;
		
		newRow +="<option value='"+pacientes[i].TIS+"'>"+datuak+"</option>"; 
	}
	return newRow;
}




// function execUpdate(){
	
// 	var idPelicula=document.querySelector("#update .idPelicula").value;
	
// 	var TituloPelicula=document.querySelector("#update .TituloPelicula").value;
// 	var Anio=document.querySelector("#update .Anio").value;
// 	var Director=document.querySelector("#update .SelectDirector").value ;
	
// 	var url = "controller/cPeliculaUpdate.php";
// 	var data = { 'idPelicula':idPelicula,'TituloPelicula':TituloPelicula,
// 			'Anio':Anio,'Director':Director,'filename':filename,
// 			'savedFileBase64': savedFileBase64};

// 	fetch(url, {
// 	  method: 'POST', // or 'POST'
// 	  body: JSON.stringify(data), // data can be `string` or {object}!
// 	  headers:{'Content-Type': 'application/json'}  // input data
// 	  })
// 	.then(res => res.json()).then(result => {
	
//        		console.log(result.error);
//        		alert(result.error);
//        		loadFilms();
// 			document.getElementById("update").style.display="none";
			
// 			var inputs = document.querySelectorAll("#update input");
// 			for (let i = 0; i < inputs.length; i++) {
// 				inputs[i].value = "";
// 			}
// 			var imgs=document.querySelectorAll("#update img");
// 			for (let i = 0; i < imgs.length; i++) {
// 				imgs[i].setAttribute('src','');
// 			}
//        	}
//     )
// 	.catch(error => console.error('Error status:', error));
// };