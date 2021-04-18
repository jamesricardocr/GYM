<?php
//conexion

function conectarDB() :mysqli {
    
    $server = "localhost";
    $username = "root";
    $password = "";
    $database = "gymproject";
    
    $db = mysqli_connect($server, $username, $password, $database);
    
    if(!$db){
        echo 'no se pudo conectatar';
        exit;
    }

    return $db;
};

conectarDB();

?>