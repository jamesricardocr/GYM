<?php
require './includes/head.php';
// llamar la conexion
require './includes/conexion.php';
$db = conectarDB();

    if (isset($_POST)) {
        $cedula = $_POST['cedula'];

        //haciendo la query o la consulta
        $query = "SELECT * FROM usuarios WHERE cedula = '$cedula'";
        
        //pasando la consulta
        $resultado = mysqli_query($db, $query);
        $usuario = mysqli_fetch_assoc($resultado);
        
        if ($usuario['cedula']=== $cedula) {

        }else{
            echo '<script type="text/javascript">
            window.location.assign("./?error=1");
            </script>';
        }
        

    }else{
        echo '<script type="text/javascript">
        window.location.assign("./?error=1");
        </script>';
    }




require './includes/identificarContainer.php';
require './includes/footer.php';
?>