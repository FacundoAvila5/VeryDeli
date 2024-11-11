<?php
        if (isset($_SESSION['success'])) {
            $alertClass = $_SESSION['success'] == true ? 'alert-success' : 'alert-danger';
            $mensaje = isset($_SESSION['msg']) ? $_SESSION['msg'] : (isset($_SESSION['mensg']) ? $_SESSION['mensg'] : '');
            if ($mensaje) {
                echo '<div id="success-alert" class="alert '.$alertClass.' alert-dismissible fade show" role="alert">
                    '.$mensaje.'
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>';
            }
        }
    unset($_SESSION['mensg']);

    ?>
     <script>
        setTimeout(function() {
                let alert = document.getElementById('success-alert');
                if (alert) {
                    alert.classList.remove('show'); 
                    setTimeout(function() {
                        alert.style.display = 'none'; 
                    }, 150); 
                }
            }, 3000); 
    </script>