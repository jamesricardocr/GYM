<?php 
    session_start();

    $autenticacion = $_SESSION['login'];
    if (!$autenticacion) {
        echo '<script type="text/javascript">
        window.location.assign("./");
        </script>';
    }


    require './includes/head.php';

    // importar la conexion a la base de datos
    require ('./includes/conexion.php');

    //conexion a la base de datos
    $db = conectarDB();
    
    // escribir el query
    $query = "SELECT * FROM usuarios";

    // Consultar la DB
    $resultadoConsulta = mysqli_query($db, $query);

    
    




    //Alertas de registro y actualizacion

    if (isset($_GET['contador'])) {
            
        $contador = (int)$_GET['contador'];

        if ($contador === 1) {
            echo
            "<script>
            Swal.fire({
                title: 'Registro Exitoso',
                text: 'El usuario se registro en la base de datos',
                icon: 'success',
                confirmButtonText: 'Continuar'
            })
            </script>";
        }elseif($contador === 2){
            echo
            "<script>
            Swal.fire({
                title: 'Actualizacion Exitosa',
                text: 'El usuario se actualizo correctamente',
                icon: 'success',
                confirmButtonText: 'Continuar'
            })
            </script>";
        }elseif ($contador === 3) {
            echo "<script>
            
            Swal.fire({
                title: 'Are you sure?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
              }).then((result) => {
                if (result.isConfirmed) {
                  Swal.fire(
                    'Deleted!',
                    'Your file has been deleted.',
                    'success'
                  )
                  window.location = './delete.php';
                }
              })
            </script>";
        }elseif($contador === 4){
            echo
            "<script>
            Swal.fire({
                title: 'Bienvenido Administrador',
                text: 'El usuario se registro en la base de datos',
                icon: 'success',
                confirmButtonText: 'Continuar'
            })
            </script>";
        }elseif($contador === 5){
            echo
            "<script>
            Swal.fire({
                title: 'Usuario Eliminado',
                text: 'El usuario ha sido eliminado de la base de datos',
                icon: 'info',
                confirmButtonText: 'Continuar'
            })
            </script>";
        }
    
        
    }
    
    // Valuidar que los datos por POST esten llegando
     if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $id = $_POST['id'];
        $id = filter_var($id, FILTER_VALIDATE_INT);

        if ($id) {

            //borrar foto
            $queryFoto = "SELECT foto FROM usuarios WHERE id = ${id}";

            $seleccionarFoto = mysqli_query($db, $queryFoto);
            $borrarFoto= mysqli_fetch_assoc($seleccionarFoto);

            unlink('./fotosUsuarios/' . $borrarFoto['foto']);
            

            //borrando
            $queryUsuario = "DELETE FROM usuarios WHERE id = ${id}";
            $resultado = mysqli_query($db, $queryUsuario);

            if ($resultado) {
                echo '<script type="text/javascript">
                window.location.assign("./adminpanel.php?contador=5");
                </script>';
            }
        }
        
    }
    
    //cerrar conexion
    mysqli_close($db);
    require './includes/adminPanelContainer.php';
    require './includes/footer.php'; 
 
 ?>