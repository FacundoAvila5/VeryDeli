var c = document.getElementById("comentarios");
var p = document.getElementById("postulaciones");

document.getElementById("btnComments").onclick = function() {
    if(c.classList.contains("d-none") && !p.classList.contains("d-none")){
        p.classList.add('d-none');
        c.classList.remove("d-none");
    }
};

document.getElementById("btnPostu").onclick = function() {
    if(p.classList.contains("d-none") && !c.classList.contains("d-none")){
        c.classList.add('d-none');
        p.classList.remove("d-none");
    }
};

function Responder(boton){
    const idMensaje = boton.value
    console.log("id: " + idMensaje)

    rta = document.getElementById(idMensaje);
    rta.classList.toggle("d-none");
}