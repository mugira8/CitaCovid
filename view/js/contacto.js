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

    


    
}//cierre contacto