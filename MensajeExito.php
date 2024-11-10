<?php
        if (isset($_SESSION['success'])) {
            $alertClass = $_SESSION['success'] === true ? 'alert-success' : 'alert-danger';
            echo '<div id="success-alert" class="alert '.$alertClass.' alert-dismissible fade show" role="alert">
                   '.$_SESSION['msg'].'
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>';
        }
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