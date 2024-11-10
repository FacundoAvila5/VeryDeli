<style>
    @media (max-width: 991px) {
    #colNotificaciones {
        visibility: hidden;

        /* #notificaciones{
            max-height: 1rem;
        } */
        /* body {
            display: flex;
            flex-direction: column; */
            min-height: 100vh;
            margin: 0;
            overflow-x: hidden;
        /* } */

        /* El contenedor principal debe expandirse */
        .contenedor {
            flex: 1;
        }
    }

    #titleNotif{
        text-align: center;
        padding-top: 20px;
    }
}
</style>

<div class="col-lg-3 col-md-12 d-lg-block" id="colNotificaciones">
    <p class="txt" id="titleNotif">Notificaciones</p>

    <div class="row m-0">
        <div class="notificaciones col rounded" style="padding: 5px;">
            <div id="notificaciones">
            </div> 
        </div>
    </div>
</div>

<script>
    const idsNotificacionesMostradas = new Set();

    function fetchNotificaciones() {
        fetch('notificaciones.php')
            .then(response => response.json())
            .then(data => {
                const output = document.getElementById('notificaciones');
                data.forEach(noti => {
                    if (!idsNotificacionesMostradas.has(noti.IdNotificacion)) {
                        output.innerHTML += `<div class="notif bg-white rounded border d-flex flex-column justify-content-center p-2" id="busqueda" style="border-color: aqua; cursor: pointer;"
                                                onclick="marcarComoVisto(${noti.IdNotificacion}, '${noti.IdPublicacion}')">
                                                <span class="fecha d-flex justify-content-start">${noti.FechaDeNotificacion}</span>    
                                                <span>${noti.Mensaje}</span>
                                            </div>`;
                                            //  <div class="notif bg-white rounded text-center border" id="busqueda" style="border-color: aqua; cursor: pointer;"
                                            //      onclick="marcarComoVisto(${noti.IdNotificacion}, '${noti.IdPublicacion}')">
                                            //      <p>${noti.Mensaje} - ${noti.FechaDeNotificacion}</p>
                                            //  </div>
                        idsNotificacionesMostradas.add(noti.IdNotificacion);
                    }
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
            window.location.href = `post.php?id=${idPublicacion}&show=true`;
        } else {
            console.error('Error al marcar la notificación como vista:', data.message);
        }
    })
    .catch(error => console.error('Error al marcar la notificación como vista:', error));
}

    setInterval(fetchNotificaciones, 1000);

</script>