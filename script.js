let screenWidth = screen.width;
let windowWidth = window.innerWidth;

function limpiaDivParaBusqueda(){
    window.onload = function() {
        document.getElementById('conteni').innerHTML = ''; 
    };
}

// window.addEventListener('load', () => {
//     if (screenWidth < 992 || windowWidth < 992) {
//         console.log("yoo")
//         colNotifs.classList.add("invisible")
//     }
// })

// window.addEventListener('resize', () => {
//     var colNotifs = document.getElementById("colNotificaciones");

//     if (screenWidth < 992 || windowWidth < 992) {
//         console.log("heyo")
//         colNotifs.classList.add("invisible")
//     }else{
//         colNotifs.classList.remove("invisible")
//     }
// })

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

//  AGREGAR ESTE EVENTO onclick A LA NOTIFICACION <<TE HAN ELEGIDO PARA REALIZAR ESTE ENVIO>>:
//  value="<?php echo $aquiVaElIdPostDePostulacion; ?>" onclick="mostrarInfoExtra(this)"

// function mostrarInfoExtra(post){

// }