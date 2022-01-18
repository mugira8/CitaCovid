document.addEventListener("DOMContentLoaded", function(){
    

//botone de ingresar y retirar
var options = document.querySelectorAll(".li");

options.forEach(element =>{
    element.addEventListener("click",opcion)
})
function opcion() { 
    options.forEach(element =>{
        var i=event.target.value;

        if (i == "conoce") {
            element.addEventListener("click", conoce(i));
        }if (i == "actualidad") {
            element.addEventListener("click", actualidad(i));
        }else if(i == "contacto") {
            element.addEventListener("click", contacto(i));
        }
    })//cierre foreach
   
}
});//cierre DOM

//conoce
function conoce() {
    document.getElementById("actualidad").style.display = "none";
    document.getElementById("contacto").style.display = "none";
    document.getElementById("conoce").style.display = "block";


    
    
}//cierre conoce

//actualidad
function actualidad() {
    document.getElementById("conoce").style.display = "none";
    document.getElementById("contacto").style.display = "none";
    document.getElementById("actualidad").style.display = "block"



    
}//cierre actualidad

//contacto
function contacto() {
    document.getElementById("actualidad").style.display = "none";
    document.getElementById("conoce").style.display = "none";
    document.getElementById("contacto").style.display = "block"

            
        //MOSTRAR DIV MOTIVO CUANDO CLICKAS EN 'OTRO...'
        function mostrar() {

            var valor = document.getElementById("MotivoS").value;

            if (valor == "Otro") {
                document.getElementById("motivo").style.display = 'block';
                document.getElementById("MasMotivo2").required = true;
            } else {
                document.getElementById("motivo").style.display = 'none';
            }
        }

        //RELLENAR FORMULARIO
        function formRelleno() {
                event.preventDefault()
                var nombre = $('#Nombre').val();
                var correo = $('#Correo').val();
                var motivoC = $('#MotivoS').val();
                var masMotivo = $('#MasMotivo2').val();
                var mensaje = $('#Mensaje').val();
                var datos = {'Nombre': nombre, 'Correo': correo, 'MotivoS': motivoC, 'MasMotivo': masMotivo, 'Mensaje': mensaje };
                var datos = JSON.stringify(datos);


                $.ajax({
                    url: "../../controller/cForm.php",
                    method: "POST",
                    data: {
                        'datos': datos,
                    },
                    success: function (result) {
                        enviarFormulario();
                    },
                    error: function (xhr, textStatus, error) {
                        console.log(xhr.statusText);
                        console.log(textStatus);
                        console.log(error);
                    }
                })

        }

        //ENVIAR FORMULARIO Y LIMPIAR
        function enviarFormulario() {
            window.alert("FORMULARIO ENVIADO");
            var a = Array.from($('#formulario .form-control'));
            a.forEach(element => {
                if (element.name == 'MotivoS') {
                var valor = document.getElementById("MotivoS");
                valor.selectedIndex = "0";
                }
                else{
                    element.value = '';
                }

            });
        }





    
}//cierre contacto