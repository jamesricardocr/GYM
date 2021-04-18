<?php
    session_start();

    $autenticacion = $_SESSION['login'];
    if (!$autenticacion) {
        echo '<script type="text/javascript">
        window.location.assign("./");
        </script>';
    }

    require('./includes/head.php');
    require ('./includes/conexion.php');
    

    // VALIDANDO LA URL
    //conexion a la base de datos
    $db = conectarDB();
    // Obtener la variable id por GET para seleccionar el usuario a editar o actualizar


       if (isset($_GET['id'])) {

           $id = $_GET['id'];
           // filtar la variable para evitar malas consultas por la url usando filter_var
           $id = filter_var($id, FILTER_VALIDATE_INT);
           // esta condicion hace que si el valor de GET no es un id valido o un entero redirige al usuario
    

       }else{
        //    echo '<script type="text/javascript">
        //    window.location.assign("./");
        //    </script>';
       }


   
    


    // Obtener los datos del usuario
    $consultaUsuario = "SELECT * FROM usuarios WHERE id = ${id}";
    $resultadoConsultaUsuario = mysqli_query($db, $consultaUsuario);
    $usuario = mysqli_fetch_assoc($resultadoConsultaUsuario);


    //consultar para obtener los planes
    $consulta = "SELECT * FROM planes";
    $planesResultado = mysqli_query($db, $consulta);
    

    // variables 

    $nombres = $usuario['nombres'];
    $apellidos = $usuario['apellidos'];
    $cedula = $usuario['cedula'];
    $email = $usuario['email'];
    $telefono = $usuario['telefono'];
    $planes = $usuario['plan'];
    // $foto = '';
    
    //esta funcion muestra los resultados de la consulta a mysql
    // mysqli_fetch_assoc();

    //arreglo donde se van agregando los errores
    $errores = [];
    
    //validando los datos por POST
    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        
        // echo "<pre>";
        // var_dump($_POST);
        // echo "</pre>";
        
        // echo "<pre>";
        // var_dump($_FILES);
        // echo "</pre>";

        $nombres = mysqli_real_escape_string($db, $_POST['nombres']);
        $apellidos = mysqli_real_escape_string($db, $_POST['apellidos']); 
        $cedula = mysqli_real_escape_string($db,  $_POST['cedula']);
        $email = mysqli_real_escape_string($db, $_POST['email']) ;
        $telefono = mysqli_real_escape_string($db, $_POST['telefono']);
        $planes = mysqli_real_escape_string($db, $_POST['planes']);
        $creado = date('Y/m/d');

        $foto = $_FILES['foto'];
        
       
        //validaciones de los campos

        if(!$nombres){
            $errores[] = "Nombres";
        };

        if(!$apellidos){
            $errores[] = "Apellidos";
        };

        if(!$cedula){
            $errores[] = "Cedula";
        };

        if(!$email){
            $errores[] = "Email";
        };

        if(!$telefono){
            $errores[] = "Telefono";
        };

        if(!$planes){
            $errores[] = "Planes";
        };



        //tranformando los datos del arreglo en un string unico separado 
        $mensajeError = implode ( " <br>", $errores );
        

        //Verificando que no haya ningun error el en arreglo de errores

        if(empty($errores)){
                        
            // Crear carpeta
            $fotosUsuarios = './fotosUsuarios/';

            // Validando si existe la carpeta
            if (!is_dir($fotosUsuarios)) {
            
                mkdir($fotosUsuarios);
            }

            $nombreFotosUsuarios = '';

            /* SUBIDA DE FOTOS EN CASO DE CAMBIO */
            // Validar su hay una imagen nueva y borrar la imagen previa
            if ($foto['name']) {
                echo 'si hay una nueva imagen';

                // borrar la imagen anterior usando la funcion unlink();
                unlink($fotosUsuarios . $usuario['foto']);
                // forma para que las imagenes no tengan el mismo nombre 
                // md5 encripta y da el nombre, uniqid genera un unico id y rand genera un numero aleatorio, imposible de repetir y que se duplique
                $nombreFotosUsuarios = md5( uniqid( rand(), true ) ) . '.jpg';
                // var_dump($nombreFotosUsuarios);
                // selecciona la url temporaltmp_name, luego se pasa la carpeta seguido del nombre con le formato
                move_uploaded_file($foto['tmp_name'], $fotosUsuarios . $nombreFotosUsuarios);

            }else{
                $nombreFotosUsuarios = $usuario['foto']; 
            }




            //actualizar en la base de datos
            $query = "UPDATE usuarios SET nombres = '${nombres}', `apellidos` = '${apellidos}', `cedula` = '${cedula}', `email` = '${email}', `telefono` = '${telefono}', `plan` = '${planes}' , `foto` = '${nombreFotosUsuarios}'  WHERE id = ${id}";
            // Siempre comrobar el query o la consulta siempre
            // echo $query;

        //    echo $query;
            //primer valor que se pasa es la conexion seguido de la consulta o el query
            $resultado = mysqli_query($db, $query);   

            if($resultado){

                echo
                "<script>
                Swal.fire({
                    title: 'Registro Exitoso',
                    text: '',
                    icon: 'success',
                    confirmButtonText: 'Continuar'
                })
                </script>";

                echo '<script type="text/javascript">
                window.location.assign("./adminpanel.php?contador=2");
                </script>';

                }else{

                }
        
            }else {
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

    require('./includes/actualizarContainer.php');
    require('./includes/footer.php');
?>

