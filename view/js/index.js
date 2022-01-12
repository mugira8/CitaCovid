imagenesCarrusel = [
    "https://www.osakidetza.euskadi.eus/images/ab84-osakidetza-como-actuo-covid-es.jpg",
    "https://www.osakidetza.euskadi.eus/images/ab84-osakidetza-taller-online-tabaco.png",
    "https://www.osakidetza.euskadi.eus/images/ab84-banner-vac-infantil-covid.jpg"
]

var estado = "active";
for (let i = 0; i < imagenesCarrusel.length; i++) {
if (i>0) { //Pone la clase active solo en el primer item del carrusel
    estado = ""
}
    document.getElementById("myCarouselInner").innerHTML +=`
    <div class="carousel-item `+ estado +`">
        <div class="carousel-img"
            style="background-image: url(`+ imagenesCarrusel[i] +`);">
        </div>
    </div>`;
}

var esNuevo = `<span class="badge bg-danger ">New</span>`;
fetch("view/js/articulos.json").then(Response => Response.json()).then(data =>{
 
    console.log("Articulos", data);
    for (let i = 0; i < data.length; i++) {
    if (i>0) {
        esNuevo="";
    }
        document.getElementById("cardGroup").innerHTML += `
        <div class="card mb-3 my-4">
        <div class="row g-0">
            <div class="col-md-3"
                style="background-image: url(`+ data[i].imagen +`); background-position:left; background-size: contain; background-repeat: no-repeat;">
            </div>
            <div class="col-md-6">
                <div class="card-body">
                    <h5 class="card-title">`+ data[i].titulo +` `+ esNuevo +`</h5>
                    <p class="card-text"><b>`+ data[i].subtitulo +`</b> </p>
                    <p class="card-text"> `+ data[i].descripcion + ` </p>
                </div>
            </div>
        </div>
    </div>`;
    }

})