document.addEventListener('DOMContentLoaded', () => {
    var colPubli = document.getElementById("conteni");
    var colNotifs = document.getElementById("colNotificaciones");
    let btnNotif = document.getElementById("btnNotif");

    function toggleNotifs() {
        let screenWidth = screen.width;
        let windowWidth = window.innerWidth;

        if (screenWidth < 992 || windowWidth < 992) {
            console.log('Toggling notifications');
            // if(!colPubli.classList.contains("d-none"))
            //     colPubli.classList.add("d-none");

            if(colPubli != null) // && !colPubli.classList.contains("d-none")
                colPubli.classList.add("d-none");
            
            if(colNotifs != null)
            colNotifs.style.visibility = 'visible'
        }
    }

    (btnNotif != null) ? btnNotif.addEventListener('click', toggleNotifs) : "";
});

