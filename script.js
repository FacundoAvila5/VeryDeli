var c = document.getElementById("comentarios");
var p = document.getElementById("postulaciones");
var iduser = document.getElementById("idUser").value;
var iduserpost = document.getElementById("idUserPost").value;

if(iduser == iduserpost){
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
    }
}


postDelete = document.getElementById("deleteP");
if(postDelete != null){
    postDelete.onclick = function() {
        if (confirm("¿Eliminar publicacion?")){
            return true;
        }else{
            e.preventDefault();
        }
    }
}


linkDelete = document.querySelectorAll(".deleteC");
linkDelete.forEach((element)=>{ element.addEventListener('click', (e)=>{ 
    console.log('borra?')
        if (confirm("¿Eliminar comentario?")){
            return true;
        }else{
            e.preventDefault();
        }
    })
});


function Responder(boton){
    const idMensaje = boton.value
    rta = document.getElementById(idMensaje);
    rta.classList.remove("d-none");
}