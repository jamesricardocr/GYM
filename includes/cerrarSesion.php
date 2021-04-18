<?php
session_start();

if ($_SESSION) {

    // mejor que destruir una sesion es cambiarle los valores.
    $_SESSION= [];
    
    header('location: ../');
}else{
    header('location: ../');

}




?>