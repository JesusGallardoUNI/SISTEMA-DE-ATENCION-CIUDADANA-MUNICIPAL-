<?php
    session_start();
    $url = $_SESSION['url'];
    $_SESSION = [];

    switch ($url) {
        case "/MUNICIPAL/ALCALDE/Portal.php":
            header("Location: ../../ALCALDE/Portal.php");
            exit;
        case "/MUNICIPAL/FUNCIONARIOS/Acceso.php":
            header("Location: ../../FUNCIONARIOS/Acceso.php");
            exit;
        case "/MUNICIPAL/FUNCIONARIOS/AccesoAdministracion.php":
            header("Location: ../../FUNCIONARIOS/AccesoAdministracion.php");
            exit;
    }
?>
