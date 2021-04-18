<?php
    session_start();

    $autenticacion = $_SESSION['login'];
    if (!$autenticacion) {
        header('location: ./');
    }

    require('./includes/head.php');
    require ('./includes/conexion.php');
    
    //conexion a la base de datos
    $db = conectarDB();

    //consultar para obtener los planes

    $consulta = "SELECT * FROM planes";
    $planesResultado = mysqli_query($db, $consulta);
    

    // variables 

    $nombres = '';
    $apellidos = '';
    $cedula = '';
    $email = '';
    $telefono = '';
    $planes = '';
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
        
        //foto
        $foto = $_FILES['foto'];
        
        // echo "<pre>";
        // var_dump($foto);
        // echo "</pre>";
        
        
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

        // validar imagen por tamaño PHP limita a 2mb por archivo y la key es error
        if(!$foto['name'] || $foto['error']){
            $errores[] = 'Foto';
        }

        //validar imagen por tamaño personalizado
        // $fotoPeso = 1000 * 1000;
        // if($foto['size'] > $fotoPeso){
        //     $errores[] = 'La Foto es muy pesada';
        // }
        

        //tranformando los datos del arreglo en un string unico separado 
        $mensajeError = implode ( " <br>", $errores );
        

        //Verificando que no haya ningun error el en arreglo de errores

        if(empty($errores)){
                        
            /* SUBIDA DE ARCHIVOS */
            
            // Crear carpeta
            
            $fotosUsuarios = './fotosUsuarios/';

            // Validando si existe la carpeta
            if (!is_dir($fotosUsuarios)) {
            
                mkdir($fotosUsuarios);
            }

            //Subir la imagen

            // forma para que las imagenes no tengan el mismo nombre 
            // md5 encripta y da el nombre, uniqid genera un unico id y rand genera un numero aleatorio, imposible de repetir y que se duplique
            $nombreFotosUsuarios = md5( uniqid( rand(), true ) ) . '.jpg';
            // var_dump($nombreFotosUsuarios);
            // selecciona la url temporaltmp_name, luego se pasa la carpeta seguido del nombre con le formato
            move_uploaded_file($foto['tmp_name'], $fotosUsuarios . $nombreFotosUsuarios);



            //insertar en la base de datos
            $query = "INSERT INTO usuarios (`nombres`, `apellidos`, `cedula`, `email`, `telefono`,`plan`, `foto`, `tipo`, `creado` ) VALUES ('$nombres ', '$apellidos', '$cedula', '$email', '$telefono', '$planes', '$nombreFotosUsuarios' , null , '$creado')";
            
            //primer valor que se pasa es la conexion seguido de la consulta o el query
            $resultado = mysqli_query($db, $query);   
        
            if($resultado){

                echo '<script type="text/javascript">
                window.location.assign("./adminpanel.php?contador=1");
                </script>';

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

    require('./includes/registroContainer.php');
    require('./includes/footer.php');
?>

