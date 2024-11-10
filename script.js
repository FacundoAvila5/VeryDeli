window.addEventListener('load', () => {
    buoy = document.getElementById('buoy')
    active = buoy.getAttribute('data-value')
        if(active)
           txt = document.querySelectorAll('.sel-txtExtra')
            txt.forEach(element => {
                element.classList.add('txtExtraInfo')
            });
});

var c = document.getElementById("comentarios");
var p = document.getElementById("postulaciones");
var d = document.getElementById("linkBtnPostu");
var iduser = document.getElementById("idDeUser").value;
var iduserpost = document.getElementById("idUserPost").value;

if(iduser == iduserpost){
    document.getElementById("btnComments").onclick = function() {
        if(c.classList.contains("d-none") && !p.classList.contains("d-none")){
            p.classList.add('d-none');
            c.classList.remove("d-none");
        }
    };
    document.getElementById("btnPostu").onclick = function() {
        if(p.classList.contains("d-none") && !(d.classList.contains("disabled")) && !c.classList.contains("d-none")){
            c.classList.add('d-none');
            p.classList.remove("d-none");
        }
    }
}

//mostrar y ocultar interfaz de respuesta
function Responder(boton){
    const idMensaje = boton.value
    rta = document.getElementById(idMensaje);
    rta.classList.toggle("d-none");
}