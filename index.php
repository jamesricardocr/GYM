<?php
    require('./includes/head.php');

    if (isset($_GET['error'])) {
        $error = (int)$_GET['error'];

        if ($error === 1) {
            echo
            "<script>
            Swal.fire({
                title: 'Error de autenticación',
                text: 'El usuario no se encuentra registrado en la base de datos',
                icon: 'warning',
                confirmButtonText: 'Continuar'
            })
            </script>";
        }

    }

    require('./includes/principal.php');
    require('./includes/footer.php');
?>



