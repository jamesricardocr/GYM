<?php 

session_start();
    if (isset($_SESSION['login'])) {
        $autenticacion = $_SESSION['login'];
        if ($autenticacion) {

            echo '<script type="text/javascript">
            window.location.assign("./adminpanel.php");
            </script>';
        }
    }

require('./includes/head.php');
require('./includes/conexion.php');

$db = conectarDB();

/* CREAR USUARIO ADMINISTRADOR EN LA DB */
// // importar la conexion 
// require './includes/conexion.php';

// $db = conectarDB();

// //Crear un email y un password
// $email = 'jamesricardocr@gmail.com';
// $password = '12345';

// //hasheando el password
// $passwordHash = password_hash($password, PASSWORD_DEFAULT);

// //crear la consulta
// $query = "INSERT INTO `gymproject`.`administradores` (`email`, `password`) VALUES ('${email}', '${passwordHash}')";

// //pasar la consulta
// $resultado = mysqli_query($db, $query);

// if ($resultado) {
//     echo'exitosoo..';
// }else{
//     echo 'pailas..';
// }

$errores = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // echo "<pre>";
    // var_dump($_POST);
    // echo "</pre>";

    // Sanitizando y filtrando el login
    $email =    mysqli_real_escape_string($db, filter_var($_POST['email'], FILTER_VALIDATE_EMAIL));
    $password = mysqli_real_escape_string($db, filter_var($_POST['password']));


    if (!$email) {
        $errores[] = 'Email';
    }
    if (!$password) {
        $errores[] = 'Password';
    }

    $mensajeError = implode(" <br>", $errores);

    if (empty($errores)) {

        $query = "SELECT * FROM administradores WHERE email = '${email}'";
        $resultado = mysqli_query($db, $query);



        // para validar se usa num_rows per como es un objeto se accede por medio de fleca
        if ($resultado-> num_rows) {

            // Revisar si el password es correcto
            $usuario = mysqli_fetch_assoc($resultado);

            // Verifica el password
            $autenticacion = password_verify($password, $usuario['password']);
            
            if ($autenticacion) {

                // EL USUARIO ESTA AUTENTICADO
                session_start();

                // LLENAR EL ARREGLO DE LA SESION simplemente se carga un valor a la super global sesion
                // $_SESSION['usuario'] = $usuario['email'];
                // $_SESSION['rango'] = 'admin';
                $_SESSION['login'] = true;

                
                echo '<script type="text/javascript">
                window.location.assign("./adminpanel.php?contador=4");
                </script>';

            }else{
                echo
                "<script>
                Swal.fire({
                    title: 'Error',
                    text: 'Login incorrecto',
                    icon: 'error',
                    confirmButtonText: 'Continuar'
                })
                </script>";
            }

        }else{
            echo
            "<script>
            Swal.fire({
                title: 'Error de registro',
                text: 'No se pudo registrar en la base de datos',
                icon: 'error',
                confirmButtonText: 'Continuar'
            })
            </script>";
        }



    } else {
        echo
        "<script>
                Swal.fire({
                    title: '$mensajeError',
                    text: 'Estos campos son requeridos',
                    icon: 'warning',
                    confirmButtonText: 'Continuar'
                })
        </script>";
    
    }
}

require('./includes/adminLoginContainer.php');
require('./includes/footer.php');
?>