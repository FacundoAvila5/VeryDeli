<script>
    const idsNotificacionesMostradas = new Set();

    function fetchNotificaciones() {
        fetch('notificaciones.php')
            .then(response => response.json())
            .then(data => {
                const output = document.getElementById('notificaciones');
                data.forEach(noti => {
                    if (!idsNotificacionesMostradas.has(noti.IdNotificacion) && noti.TipoNotificacion === "Normal") {
                        output.innerHTML += `<div class="notif bg-white rounded text-center border" id="busqueda" style="border-color: aqua; cursor: pointer;"
                                                 onclick="marcarComoVisto(${noti.IdNotificacion}, '${noti.IdPublicacion}')">
                                                 <p>${noti.Mensaje} - ${noti.FechaDeNotificacion}</p>
                                             </div>`;
                    }
                    if (!idsNotificacionesMostradas.has(noti.IdNotificacion) && noti.TipoNotificacion === "Envio") {
                        output.innerHTML += `<div class="notif bg-white rounded text-center border" id="busqueda" style="border-color: aqua; cursor: pointer;">
                                                 <p>${noti.Mensaje} - ${noti.FechaDeNotificacion}</p>
                                             </div>`;
                    }
                    idsNotificacionesMostradas.add(noti.IdNotificacion);
                });
            })
            .catch(error => console.error('Error al obtener notificaciones:', error));
    }

    function marcarComoVisto(idNotificacion, idPublicacion) {
    const formData = new FormData();
    formData.append('IdNotificacion', idNotificacion);
    
    // Enviar solicitud para cambiar el estado de la notificación
    fetch('notificacion_leida.php', {
        method: 'POST',
        body: formData 
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            window.location.href = `post.php?id=${idPublicacion}`;
        } else {
            console.error('Error al marcar la notificación como vista:', data.message);
        }
    })
    .catch(error => console.error('Error al marcar la notificación como vista:', error));
}


    setInterval(fetchNotificaciones, 1000);
</script>

<p class="txt">Notificaciones</p>

<div class="row m-0">
    <div class="notificaciones col rounded" style="padding: 5px;">
        <div id="notificaciones">
        </div> 
    </div>
</div>
