<script>
    const idsNotificacionesMostradas = new Set();

    function fetchNotificaciones() {
        fetch('notificaciones.php')
            .then(response => response.json())
            .then(data => {
                const output = document.getElementById('notificaciones');
                data.forEach(noti => {
                    // Verificar si la notificación ya ha sido mostrada
                    if (!idsNotificacionesMostradas.has(noti.IdNotificacion)) {
                        output.innerHTML += `<div class="notif bg-white rounded text-center">
                                                <p>${noti.Mensaje} - ${noti.FechaDeNotificacion}</p>
                                              </div>`;
                        // Agregar el ID de la notificación al conjunto
                        idsNotificacionesMostradas.add(noti.IdNotificacion);
                    }
                });
            })
            .catch(error => console.error('Error fetching notifications:', error));
    }

    // Llamar a la función cada 5 segundos
    setInterval(fetchNotificaciones, 1000);
</script>



<!-- columna: notificaciones -->
<p class="txt">Notificaciones</p>

<div class="row m-0">
    <div class="notificaciones col rounded" style="padding: 5px;">
            <div id="notificaciones">
            </div> 
    </div>
</div>


