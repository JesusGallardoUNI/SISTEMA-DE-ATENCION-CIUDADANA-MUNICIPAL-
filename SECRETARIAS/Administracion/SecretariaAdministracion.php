<?php
    include "../../Recursos/Partes/Partes.php";
    $Bloqueo = Seguridad();
    if(!$Bloqueo){
        header('Location: ../SecretariaAdministracion.php');
    }
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Atención Ciudadana - Inicio de Sesión</title>
    <link rel="stylesheet" href="../../Recursos/CSS/General.css">
</head>
<body>
    <?php Banner(true, "../../Recursos/Imagenes/icono.png","Municipio de Guadalupe","Panel de administracion de control de usuarios", true,"../../Recursos/SVG/Cerrar.svg","../../Recursos/Partes/Salir.php"); ?>

    <div class="Cuerpo">
        <nav>
            <div class="opcion Titulo_opcion" id="ScrollNavBar">
                <h2>Menu de opciones</h2>
                <img src="../../Recursos/SVG/menu.svg" loading="lazy">
            </div>
            <div class="opcion">
                <img src="../../Recursos/SVG/Altas.svg" alt="">
                <a href="Altas.php">Generar altas</a>
            </div>
            <div class="opcion">
                <img src="../../Recursos/SVG/Cambios.svg" alt="">
                <a href="ListaCambios.php">Solicitud de cambios</a>
            </div>
            <div class="opcion">
                <img src="../../Recursos/SVG/Activo.svg" alt="">
                <a href="Activos.php">Activos</a>
            </div>
            <div class="opcion">
                <img src="../../Recursos/SVG/Eliminar.svg" alt="">
                <a href="Bajas.php">Generar bajas</a>
            </div>
        </nav>
        <main>
        </main>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script><!--Este sirve para mostrar alertas-->
    <script src="../../Recursos/JS/General.js"></script>
</body>
</html>