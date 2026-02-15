<?php
    session_start();
    
    $tipo = $_SESSION['usuario_tipo'];


    echo $url;

    switch ($tipo) {
        case "alcalde":
            header("Location: /MUNICIPAL/ALCALDE/ALCALDE.php");
            session_unset();
            session_destroy();
            break;
        case "administracion":
            header("Location: /MUNICIPAL/FUNCIONARIOS/AccesoAdministracion.php");
            session_unset();
            session_destroy();
            break;
        case "servidor":
            header("Location: /MUNICIPAL/FUNCIONARIOS/Acceso.php");
            session_unset();
            session_destroy();
            break;
    }  
?>